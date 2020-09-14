<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Documents\OutgoingDocument\OutgoingDocumentRequest;
use App\Http\Requests\IssueDocumentRequest;
use App\Models\DigitizedDocument;
use App\Models\DocumentComment;
use App\Models\DocumentTag;
use App\Models\DocumentTrack;
use App\Models\EmailLog;
use App\Models\Institution;
use App\Models\OutgoingDocument;
use App\Models\Reminder;
use App\Models\Template;
use App\Repository\CalendarRepository;
use App\Repository\Configuration\DocumentCategoryRepository;
use App\Repository\Configuration\FiscalYearRepository;
use App\Repository\Configuration\TagRepository;
use App\Repository\Configuration\TemplateRepository;
use App\Repository\Documents\DocumentCommentRepository;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\UserRepository;
use App\Traits\DocumentTrackTrait;
use App\Traits\EmailLogTrait;
use App\Traits\NotificationTrait;
use App\User;
use Faker\Provider\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Documents\OutgoingDocumentRepository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use LaravelQRCode\Facades\QRCode;
use Mockery\CountValidator\Exception;
use App\Http\Controllers\CollectiveFunctionController;
use App\Repository\DocumentTimelineRepository;
use DateTime;
use App\Http\Controllers\Documents\ReplaceVariableController;
use File;
use QR_Code\Types\QR_Url;


class OutgoingDocumentController extends BaseController
{
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var DocumentCategoryRepository
     */
    private $documentCategoryRepository;
    /**
     * @var TemplateRepository
     */
    private $templateRepository;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var CollectiveFunctionController
     */
    private $collectiveFunction;
    /**
     * @var CollectiveFunctionController
     */
    private $collectiveFunctionController;
    /**
     * @var DocumentCommentRepository
     */
    private $documentCommentRepository;
    /**
     * @var \DocumentTimelineRepository
     */
    private $documentTimelineRepository;
    /**
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var DocumentTag
     */
    private $documentTag;
    /**
     * @var CalendarRepository
     */
    private $calendarRepository;
    /**
     * @var \App\Http\Controllers\Documents\ReplaceVariableController
     */
    private $replaceVariableController;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * OutgoingDocumentController constructor.
     * @param OutgoingDocumentRepository $outgoingDocumentRepository
     * @param DocumentCategoryRepository $documentCategoryRepository
     * @param TemplateRepository $templateRepository
     * @param InstitutionRepository $institutionRepository
     */
    public function __construct(
        OutgoingDocumentRepository $outgoingDocumentRepository,
        DocumentCategoryRepository $documentCategoryRepository,
        TemplateRepository $templateRepository,
        InstitutionRepository $institutionRepository,
        UserRepository $userRepository,
        DocumentCommentRepository $documentCommentRepository,
        CollectiveFunctionController $collectiveFunctionController,
        DocumentTimelineRepository $documentTimelineRepository,
        TagRepository $tagRepository,
        DocumentTag $documentTag,
        CalendarRepository $calendarRepository,
        ReplaceVariableController $replaceVariableController,
        FiscalYearRepository $fiscalYearRepository
    )
    {

        parent::__construct();
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->documentCategoryRepository = $documentCategoryRepository;
        $this->templateRepository = $templateRepository;
        $this->institutionRepository = $institutionRepository;
        $this->userRepository = $userRepository;
        $this->collectiveFunctionController = $collectiveFunctionController;
        $this->documentCommentRepository = $documentCommentRepository;
        $this->documentTimelineRepository = $documentTimelineRepository;
        $this->tagRepository = $tagRepository;
        $this->documentTag = $documentTag;
        $this->calendarRepository = $calendarRepository;
        $this->replaceVariableController = $replaceVariableController;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function index(Request $request)
    {


        //while changing this change in dashboard too
        $signatures = $this->userRepository->signatureAllowOtherList();
//        $outgoingDocuments = $this->outgoingDocumentRepository->all($request)->skip(($page - 1) * $perPage)
//            ->take($perPage)->get();
        $outgoingDocuments = $this->outgoingDocumentRepository->all($request)->get();

//        $slice = array_slice($outgoingDocuments->toArray(), $paginate * ($page - 1), $paginate);
//        $result = Paginator::make($slice, count($items), $paginate);

        $outgoingDocuments = $this->collectiveFunctionController->documentPagination($outgoingDocuments, 20);
       
        $institutions = $this->institutionRepository->lists();
        return view('documents.outgoingDocument.index', compact('outgoingDocuments', 'signatures', 'institutions'));

    }

    public function create()
    {

        $documentCategoryRepo = $this->templateRepository;
        $institutionList = $this->institutionRepository->lists();
        $signatures = $this->userRepository->signatureAllowOtherList();

        return view('documents.outgoingDocument.add', compact('documentCategoryRepo', 'institutionList', 'signatures'));
    }

    public function show($id)
    {
  
        $id = (int)$id;
//        try {
        $document = $this->outgoingDocumentRepository->find($id);

        if ($document == null) {
            session()->flash('error', 'PRIVACY ERROR ' . "Sorry you do not have authority to view this document");
            return redirect('documents/outgoingDocument');

        }
        $tags = DocumentTag::where('document_tag_type', '=', 'outgoing')->where('document_id', '=', $id)->get();

        $timelineDate = $this->documentTimelineRepository->getDocumentDate($id, 'outgoing');
        $user_id = Auth::user()->id;
        DocumentTrackTrait::createDocumentTrack($user_id, 'outgoing', $id, 'view', date('Y-m-d'));
        $reminders = Reminder::where('document_type', '=', 'outgoing')->where('document_id', '=', $id)->where('reminder_user_id', '=', Auth::user()->id)->get();
        $documentCategoryRepo = $this->templateRepository;
        $institutionList = $this->institutionRepository->lists();
        $documentComments = $this->documentCommentRepository->getOutgoingDocumentCommentsById($id);
        $signatures = $this->userRepository->signatureAllowOtherList();
        //store in pdf
        $path = storage_path() . '/app/public/uploads/documents/outgoingDocuments';


        $this->collectiveFunctionController->generatePDF($document->id . '-' . $document->outgoing_document_subject, 'save', $path, 'outgoing', 0, $document->id);

        $pdfPath = storage_path() . '/app/public/uploads/documents/outgoingDocuments' . $document->id . '-' . $document->outgoing_document_subject . '.pdf';
        $filePath = 'storage/uploads/documents/outgoingDocuments/' . $document->id . '-' . $document->outgoing_document_subject . '.pdf';


        //dd($document->outgoing_document_content);
        $documentContentNew = $this->replaceVariableController->replaceVariable($document->outgoing_document_content, 'outgoing', $document->id);
  

        return view('documents.outgoingDocument.show', compact('signatures', 'tags', 'filePath', 'document', 'documentCategoryRepo', 'institutionList', 'documentComments', 'reminders', 'settingSeelcted', 'timelineDate', 'documentContentNew'));
//        } catch (\Exception $e) {
//            $exception = $e->getMessage();
//            session()->flash('error', 'EXCEPTION' . $exception);
//            return back();
//        }

    }

    public function editReminder($documentId, $reminderId)
    {
        
        $user_id = Auth::user()->id;

        $document = OutgoingDocument::with('template')->with('user')->with('institution')->find($documentId);
        $reminders = Reminder::where('document_type', '=', 'outgoing')->where('document_id', '=', $documentId)->get();
        $documentCategoryRepo = $this->templateRepository;
        $institutionList = $this->institutionRepository->lists();
        $documentComments = $this->documentCommentRepository->getOutgoingDocumentCommentsById($documentId);
        //get reminder
        $edits = Reminder::find($reminderId);
        return view('documents.outgoingDocument.show', compact('document', 'documentCategoryRepo', 'institutionList', 'documentComments', 'reminders', 'edits'));
    }

    public function edit($id)
    {
        try {

            $edits = $this->outgoingDocumentRepository->find($id);
            if ($edits == null) {
                session()->flash('error', 'PRIVACY ERROR  ' . " Sorry you do not have authority to edit this document");
                return redirect('documents/outgoingDocument');

            }
//            if ($edits->outgoing_issue_status == "issued") {
//                session()->flash('info', 'This Document has been issued');
//                return redirect('documents/outgoingDocument');
//
//            }
            if ($edits->outgoing_document_privacy == 'Confidential') {
                $userLists = DB::table('dms_document_privacy')->where('document_id', $id)->where('document_type', 'outgoing')->select('user_id')->get();
                if (count($userLists) > 0) {
                    foreach ($userLists as $userList) {
                        $user[] = $this->userRepository->findByUser($userList->user_id);
                    }
                    $users = json_encode($user);
                } else {
                    $users = '';
                }
            } else {
                $users = '';
            }
            $tags = $this->documentTag->where('document_id', '=', $edits->id)->where('document_tag_type', '=', 'outgoing')->select('tag_id')->get();
            if (count($tags) > 0) {
                foreach ($tags as $tag) {
                    $tagsInfo[] = $this->tagRepository->findTag($tag->tag_id);
                }
            } else
                $tagsInfo = null;

            $tagIds = json_encode($tagsInfo);
            $documentCategoryRepo = $this->templateRepository;
            $institutionList = $this->institutionRepository->lists();
            $signatures = $this->userRepository->signatureAllowOtherList();
            return view('documents.outgoingDocument.edit', compact('edits', 'documentCategoryRepo', 'institutionList', 'signatures', 'tagIds', 'users'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return redirect('documents/outgoingDocument');
        }

    }

    public function getContent($id)
    {
        $data = Template::find($id);
        return $data->template_content;

    }

    public function getSubject($id)
    {
       
        $data = Template::find($id);
        return $data->template_subject;

    }

    public function store(OutgoingDocumentRequest $request)
    {  
    
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d'));
            dd($fiscalYear);

            $tagIds = $request->get('tag_id');
     
            $tags = explode(',', $tagIds);
            $count = count($tags);
            $request['uploaded_by_user_id'] = Auth::user()->id;

            //codes to store in database
            $request['outgoing_issue_status'] = "draft";
        
            if ($request->issue_letter == "issue_letter_yes") {
               
              
                    $issue = $this->outgoingDocumentRepository->getIssueNumber($request->template_id, $request->outgoing_document_date);

                    if (isset($issue)) {
                   
                        $request['outgoing_issue_number'] = $issue['issue_code'];
                        $request['outgoing_serial_number'] = $issue['next_serial_number'];
                        $request['outgoing_issue_date'] = date('Y-m-d');
                     
                        $request['outgoing_issue_status'] = "issued";
                        $request['issued_by'] = Auth::user()->id;
                        $request['document_qr_code'] = $this->generateQRCode();
                    }
         
            }
            if (!empty($request->file('file_uploads'))) {
        
                $outgoingFile = $request->file('file_uploads');
                $documentExtension = $outgoingFile->getClientOriginalExtension();
                $outgoingFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'doc' . time() . '.' . strtolower($documentExtension);

              
                $request['outgoing_file_uploads'] = $outgoingFileName;
 
                $file_uploads = true;
        
            }
            $request['outgoing_document_content'] = $request->editor1;
  

            $request['created_by_user_id'] = Auth::user()->id;
        
            $create = OutgoingDocument::create($request->all());

       
            if ($create) {
                //replace string variable
                if ($create->outgoing_issue_date != null) {
        
                    $newContent = $request['outgoing_document_content'] = $this->replaceVariableController->replaceVariable($request->editor1, 'outgoing', $create->id);
                    $create->outgoing_document_content = $newContent;
           
                    $create->save();
                
                }

             
                for ($i = 0; $i < $count; $i++) {
                    $tagEntry['document_id'] = $create->id;
                    $tagEntry['tag_id'] = $tags[$i];
                    $tagEntry['document_tag_type'] = 'outgoing';
                    $this->documentTag->create($tagEntry);
                  
                }
                $title = "Outgoing Document Created";

                $content = "<a href=" . url('/documents/outgoingDocument/' . $create->id) . ">$request->outgoing_document_subject</a>";

                $reminder_date = (new DateTime($create->created_at))->format('Y-m-d\TH:i:s\Z');
                // $this->calendarRepository->store($title, $content, $reminder_date);

                if (isset($file_uploads)) {
                 
                $store=    Storage::putFileAs('public/uploads/documents/outgoingDocuments', $outgoingFile, $outgoingFileName);
               
                }
                if ($request->outgoing_document_privacy == "confidential") {
                    $users = $request['confidential-email'];
                    $userIds = explode(',', $users);
                 
                    foreach ($userIds as $user) {
                        $value[] = [
                            'document_id' => $create->id,
                            'document_type' => 'outgoing',
                            'user_id' => $user
                        ];
                    } 
                
                    DB::table('dms_document_privacy')->insert($value);
                }
                session()->flash('success', 'Outgoing Document successfully created');
                //store in notification table
             
                if ($request->outgoing_document_privacy == "general") {
                    $userId = $this->userRepository->getAllUsersId();

                    NotificationTrait::createNotification($userId, 'has Created ' . $create->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $create->id, date('Y-m-d'), Auth::user()->id);

                }
              
                if ($request->outgoing_document_privacy == "departmental" || $request->outgoing_document_privacy == "confidential") {
                    if ($request->outgoing_document_privacy == "departmental") {
                        $userId = $this->userRepository->getAllDepartmentUsersId(Auth::user()->department_id);

                        NotificationTrait::createNotification($userId, 'has Created ' . $create->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $create->id, date('Y-m-d'), Auth::user()->id);

                    }
               
                    if ($request->outgoing_document_privacy == "confidential") {
                        $userId = $request['confidential-email'];
                       

                        NotificationTrait::createNotification($userId, 'has Created ' . $create->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $create->id, date('Y-m-d'), Auth::user()->id);
                    }
                }
                if ($request->save == "save") {
                    return redirect('documents/outgoingDocument');
                } elseif ($request->saveAndAddNew == "saveAndAddNew") {
                    return redirect('documents/outgoingDocument/create');
                } elseif ($request->saveAndSendEmail == "saveAndSendEmail") {


                    $sendMessage = $this->collectiveFunctionController->sendMail($create->id, null, null, 'outgoing', $request);
     
                    if ($sendMessage) {
                        
                        if ($request->emailToInstitution) {
                            $institution_id = $request->institution_id;
                        }
                        session()->flash('success', 'Outgoing Document successfully created and message sent');
                    }
                    session()->flash('success', 'Outgoing Document successfully created!');
                    return redirect('documents/outgoingDocument');
                }

            } else {
                session()->flash('error', 'Outgoing Document could not create ');
                return back()->withInput();
                 }
              
      

    }

    public function update($id, OutgoingDocumentRequest $request)
    {  
        
   
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d'));
            $tagIds = $request->get('tag_id');
            $tags = explode(',', $tagIds);
            $count = count($tags);
            $outgoingDocument = OutgoingDocument::find($id);

            if ($outgoingDocument) {
                
                $user_id = Auth::user()->id;
                DocumentTrackTrait::createDocumentTrack($user_id, 'outgoing', $id, 'edit', date('Y-m-d'));
                DB::table('dms_document_privacy')->where('document_id', '=', $outgoingDocument->id)
                    ->where('document_type', '=', 'outgoing')->delete();
                
                if ($request->outgoing_document_privacy == "confidential") {
                    $users = $request['confidential_email'];
                   
                    $userIds = explode(',', $users);
                    foreach ($userIds as $user) {
                        $data[] = [
                            'document_id' => $id,
                            'document_type' => 'outgoing',
                            'user_id' => $user
                        ];
                    }
                    DB::table('dms_document_privacy')->insert($data);
                }
       
                if ($request->issue_letter == "issue_letter_yes") {
                   

                        $issue = $this->outgoingDocumentRepository->getIssueNumber($outgoingDocument->template_id, $request->outgoing_document_date);

                        if (isset($issue)) {

                            $request['outgoing_issue_number'] = $issue['issue_code'];
                            $request['outgoing_serial_number'] = $issue['next_serial_number'];
                            $request['outgoing_issue_date'] = date('Y-m-d');
                            $request['outgoing_issue_status'] = "issued";
                            $request['issued_by'] = Auth::user()->id;
                        }
                


                }
                $images = $request->file_upload;
      
                if (!empty($images)) {
                   
//                @unlink(storage_path() . '/apppublic/uploads/documents/outgoingDocuments' . $outgoingDocument->outgoing_file_uploads);
//                $outgoingFile = $request->file('file_uploads');
//                $documentExtension = $outgoingFile->getClientOriginalExtension();
//                $outgoingFileName = str_replace('/','-',$fiscalYear->fy_name).'/'.'doc' . time() . '.' . strtolower($documentExtension);
//                $request['outgoing_file_uploads'] = $outgoingFileName;
//                $file_uploads = true;
//            }
//            if ($request-> != NULL) {
                    $oldImages = null;

                    if ($outgoingDocument->outgoing_file_uploads != null) {
                        $oldImages = json_decode($outgoingDocument->outgoing_file_uploads);
                   

                    }
                    if ($oldImages == null && $outgoingDocument->outgoing_file_uploads != null) {
                        $jsonencodefile[] = $outgoingDocument->outgoing_file_uploads;
                    
                    }

                 
                    $jsonencodefile = [];
                 
                    foreach ($images as $file):
                 
                        $documentExtension = $file->getClientOriginalExtension();
                        $outgoingFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'outgoing' . time() . rand_string(6) . '.' . strtolower($documentExtension);
          
                        Storage::putFileAs('public/uploads/documents/outgoingDocuments', $file, $outgoingFileName);
                        $jsonencodefile[] = $outgoingFileName;
                                   
                    endforeach;
          
                    if ($outgoingDocument->outgoing_file_uploads != null && $oldImages != null) {
                        $oldImages = json_decode($outgoingDocument->outgoing_file_uploads);
                        $request['outgoing_file_uploads'] = json_encode(array_merge($oldImages, $jsonencodefile));
                       

                    } else {
                        
                
                        $request['outgoing_file_uploads'] = json_encode($jsonencodefile);

                    

                    }


                }
            
                if($request->editor1 != null)
                {
                    $request['outgoing_document_content'] = $request->editor1;
                }
           
                $request['created_by_user_id'] = Auth::user()->id;

                $create = $outgoingDocument->fill($request->all())->save();

                if ($create) {
                
                    if ($outgoingDocument->outgoing_issue_date != null) {
                 
                        $newContent = $this->replaceVariableController->replaceVariable($outgoingDocument->outgoing_document_content, 'outgoing', $outgoingDocument->id, 'pdf', 'headerWithSignature');
                        $outgoingDocument->outgoing_document_content = $newContent;
                        $outgoingDocument->save();
                    }
                    if ($tagIds != null || $tagIds != '') {
                       
                        DB::table('dms_document_tags')->where('document_id', '=', $outgoingDocument->id)->delete();
                        for ($i = 0; $i < $count; $i++) {
                            $tagEntry['document_id'] = $outgoingDocument->id;
                            $tagEntry['tag_id'] = $tags[$i];
                            $tagEntry['document_tag_type'] = 'outgoing';
                            $this->documentTag->create($tagEntry);
                        }
                    }
                    session()->flash('success', 'Outgoing Document successfully updated');

                    //store in notification table
                    if ($request->outgoing_document_privacy == "general") {
                      
                        $userId = $this->userRepository->getAllUsersId();

                        NotificationTrait::createNotification($userId, 'has Updated ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

                    }
                    if ($request->outgoing_document_privacy == "departmental") {
                        $userId = $this->userRepository->getAllDepartmentUsersId(Auth::user()->department_id);
                       
                        NotificationTrait::createNotification($userId, 'has Updated ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

                    }
                    if ($request->outgoing_document_privacy == "confidential") {
                        $userId = $request['confidential_email'];
                       
                        NotificationTrait::createNotification($userId, 'has Updated ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

                    }
                    if ($request->saveAdditionalFile == "saveAdditionalFile") {
                        return redirect('documents/outgoingDocument/' . $id);
                    }
                    if ($request->save == "save") {
                        return redirect('documents/outgoingDocument');
                    } elseif ($request->saveAndAddNew == "saveAndAddNew") {
                        return redirect('documents/outgoingDocument/create');
                    } elseif ($request->saveAndSendEmail == "saveAndSendEmail") {
                        $sendMessage = $this->collectiveFunctionController->sendMail($outgoingDocument->id, null, null, 'outgoing', $request);
                        
                      
                        if ($sendMessage) {
                        
                            session()->flash('success', 'Outgoing Document successfully updated and message sent');
                        }
                        return redirect('documents/outgoingDocument');

                    }

                } else {


                    session()->flash('error', 'Outgoing Document could not create ');
                    return back()
                        ->withInput();

                }
            } else {
                session()->flash('error', ' Document  not found ');
                return back();

            }

     

    }

    public function getInstitutionEmail($id)
    {
        
        $data = Institution::find($id);
        return $data->institution_email_address;
    }

    public function downloadDocument($letter_id)
    {
       

        $document = $this->outgoingDocumentRepository->find($letter_id);


        if ($document == null) {
            session()->flash('error', 'PRIVACY ERROR ' . "Sorry you do not have authority to download
             
             this document");
            return redirect('documents/outgoingDocument');
        }
        DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'outgoing', $letter_id, 'download', date('Y-m-d'));

        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
   
        $uri_segments = explode('/', $uri_path);

        if ($document->outgoing_file_uploads != null) {
           
            $outgoing = json_decode($document->outgoing_file_uploads);
  
            for ($i=0; $i <count($outgoing) ; $i++) { 

                $path = public_path() . '/uploads/documents/outgoingDocuments/';
                $additional_path = storage_path() . "/app/public/uploads/documents/outgoingDocuments/" . $outgoing[$i];
                if ($uri_segments[3] == "no") {
                    $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'save', $path, 'outgoing', 0, $letter_id);
                } else {
                    $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'save', $path, 'outgoing', 1, $letter_id);
                }
         
                $pdfPath = public_path() . '/uploads/documents/outgoingDocuments/' . $letter_id . '-' . $document->outgoing_document_subject . '.pdf';
                $zippath = [$pdfPath, $additional_path];

                return $this->collectiveFunctionController->downloadZip($zippath, $letter_id . '-' . $document->outgoing_document_subject);
              
            }
          
          
           


        } else {
            if ($uri_segments[3] == "no")
                $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'download', null, 'outgoing', 0, $letter_id);


            $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'download', null, 'outgoing', 1, $letter_id);

        }

    }

    public function printDocument($letter_id)
    {

        DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'outgoing', $letter_id, 'print', date('Y-m-d'));
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        $document = $this->outgoingDocumentRepository->find($letter_id);
        if ($document == null) {
            session()->flash('error', 'PRIVACY ERROR ' . "Sorry you do not have authority to print this document");
            return redirect('documents/outgoingDocument');
        }

        if ($document->outgoing_file_uploads != null) {
            $path = public_path() . '/uploads/documents/outgoingDocuments/';
            $additional_path = storage_path() . "/app/public/uploads/documents/outgoingDocuments" . $document->outgoing_file_uploads;
            if ($uri_segments[3] == "no")
                $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'print', $path, 'outgoing', 0, $letter_id);
            $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'print', $path, 'outgoing', 1, $letter_id);
            $pdfPath = public_path() . '/uploads/documents/outgoingDocuments/' . $letter_id . '-' . $document->outgoing_document_subject . '.pdf';
            $zippath = [$pdfPath, $additional_path];
            return $this->collectiveFunctionController->downloadZip($zippath, $letter_id . '-' . $document->outgoing_document_subject);


        } else {
            if ($uri_segments[3] == "no") {
                $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'print', null, 'outgoing', 0, $letter_id);

            } else {
                $this->collectiveFunctionController->generatePDF($letter_id . '-' . $document->outgoing_document_subject, 'print', null, 'outgoing', 1, $letter_id);
            }

        }

    }

    public function sendDocumentFromEmail(Request $request, $documentId)
    {
       
        $email = $this->collectiveFunctionController->sendMail($documentId, null, null, 'outgoing', $request);
   
         
    session()->flash('success', 'Message sent');
        return back();
    }

    public function issue(Request $request)
    {
        

        $outgoingDocument = OutgoingDocument::find($request->outgoing_document_id);
        if ($outgoingDocument) {
       
            $id = $request->outgoing_document_id;
            $issue = $this->outgoingDocumentRepository->getIssueNumber($outgoingDocument->template_id, $request->outgoing_issue_date);

            if (isset($issue)) {
                
                $request['outgoing_issue_number'] = $issue['issue_code'];
                $request['outgoing_serial_number'] = $issue['next_serial_number'];
                $request['signature_user_id'] = $request->signature_user_id;
                $request['outgoing_issue_date'] = $request->outgoing_issue_date;
                $request['outgoing_issue_status'] = "issued";
                $request['issued_by'] = Auth::user()->id;
          
            }
            $update = $outgoingDocument->fill($request->all())->update();
        
            $newContent = $this->replaceVariableController->replaceVariable($outgoingDocument->outgoing_document_content, 'outgoing', $outgoingDocument->id, 'pdf', 'headerWithSignature');
      
            $outgoingDocument->outgoing_document_content = $newContent;
            $outgoingDocument['document_qr_code'] = $this->generateQRCode();
            $outgoingDocument->save();
          


            //calender notification
            $title = "Outgoing Document Issued";

            $content = "<a href=" . url('/documents/outgoingDocument/' . $outgoingDocument->id) . ">$outgoingDocument->outgoing_document_subject</a>";
           
            $reminder_date = (new DateTime($outgoingDocument->outgoing_issue_date))->format('Y-m-d\TH:i:s\Z');
            // $this->calendarRepository->store($title, $content, $reminder_date);
            //store in notification table
            if ($outgoingDocument->outgoing_document_privacy == "General") {
                $userId = $this->userRepository->getAllUsersId();
           
                NotificationTrait::createNotification($userId, 'has Issued ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }
            if ($outgoingDocument->outgoing_document_privacy == "Departmental") {
                $userId = $this->userRepository->getAllDepartmentUsersId(Auth::user()->department_id);
             
                NotificationTrait::createNotification($userId, 'has Issued ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }
            if ($outgoingDocument->outgoing_document_privacy == "Confidential") {
                $userId = DB::select('select user_id from dms_document_privacy where document_type="outgoing" and document_id =' . $id);
                for ($i = 0; $i < count($userId); $i++) {
                    $userId[$i] = $userId[$i]->user_id;
                }
                NotificationTrait::createNotification($userId, 'has Issued ' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }

            return $outgoingDocument;
        }
    }

    public function register(Request $request)
    {
        $outgoingDocument = OutgoingDocument::find($request->document_id);
        if ($outgoingDocument->outgoing_issue_status == "issued") {
            $request['outgoing_issue_status'] = "registered";
            $outgoingDocument->fill($request->all())->update();
            //store in notification table
            if ($outgoingDocument->outgoing_document_privacy == "General") {
                $userId = $this->userRepository->getAllUsersId();

                NotificationTrait::createNotification($userId, 'has Added Register Number in' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }
            if ($outgoingDocument->outgoing_document_privacy == "Departmental") {
                $userId = $this->userRepository->getAllDepartmentUsersId(Auth::user()->department_id);

                NotificationTrait::createNotification($userId, 'has Added Register Number in' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }
            if ($outgoingDocument->outgoing_document_privacy == "Confidential") {
                $userId = $this->userRepository->getConfidentialUserId($request->confidentialUserId);

                NotificationTrait::createNotification($userId, 'has Added Register Number in' . $outgoingDocument->outgoing_document_subject . ' Document', '/documents/outgoingDocument/' . $outgoingDocument->id, date('Y-m-d'), Auth::user()->id);

            }
            return $outgoingDocument;
        }

    }

    public function destroy($id, Request $request)
    {
       
        $document = $this->outgoingDocumentRepository->find($id);
        if ($document) {

            if ($request->additional_file != null) {
                $arrayPhoto = json_decode($document->outgoing_file_uploads);
                $remainingPics=count($arrayPhoto);

                for ($i = 0; $i < count($arrayPhoto); $i++) {
                    if ($arrayPhoto[$i] == $request->additional_file) {
                        //delete Picture

                        @unlink(storage_path() . '/app/public/uploads/documents/outgoingDocuments' . $request->additional_file);

                        unset($arrayPhoto[$i]);

                    }
                }
                if ($remainingPics == 1) {
                    $addPictures = null;
                } else {
                    $addPictures = json_encode(array_values($arrayPhoto));
                }
                $document->update(['outgoing_file_uploads' => $addPictures]);
                session()->flash('success', 'Document  has been deleted');
                return back();
            }
            $comments = DocumentComment::where('documents_id', '=', $document->id)->where('document_comments_type', '=', 'outgoing')->get();
            foreach ($comments as $comment) {
                @unlink(storage_path() . '/app/public/uploads/documents/commentDocuments/' . $comment->document_comments_upload);
                $comment->delete();
            }
            $documentTrack = DocumentTrack::where('tracks_document_id', '=', $document->id)->where('tracks_document_type', '=', 'outgoing')->get();
            foreach ($documentTrack as $track) {
                $track->delete();
            }
            $emailLogs = EmailLog::where('email_logs_document_id', '=', $document->id)->where('email_logs_document_type', '=', 'outgoing')->get();
            foreach ($emailLogs as $log) {
                $log->delete();
            }
            $reminders = Reminder::where('document_id', '=', $document->id)->where('document_type', '=', 'outgoing')->get();

            foreach ($reminders as $reminder) {
                $reminder->delete();
            }
            $document->delete();
            session()->flash('success', 'Document successfully deleted');
            return redirect('documents/outgoingDocument');
        }

    }

    public function generateQRCode()
    {
        $qrName = rand_string(10) . '.png';
       
        $path = storage_path('app/public/uploads/documents/outgoingDocuments');

        $file = file_exists($path);

        if (!$file) {

            $dir = Storage::makeDirectory('public/uploads/documents/outgoingDocuments', 0775, true, true);

        }
        $path = storage_path('app/public/uploads/documents/outgoingDocumentsQR-Codes');
        $file = file_exists($path);

        if (!$file) {
            Storage::makeDirectory('public/uploads/documents/outgoingDocuments/QR-Codes', 0775, true, true);
        }

        $file = storage_path('app/public/uploads/documents/outgoingDocumentsQR-Codes/' . $qrName);
        $url = url('document/' . base64_encode($qrName));

        $url = new QR_Url($url);
//        $pngImage=  QRCode::url('http://werneckbh.github.io/qr-code/')
//            ->setSize(8)
//            ->setMargin(2);
        $url->setOutfile($file)->png();

        return base64_encode($qrName);
    }

}
