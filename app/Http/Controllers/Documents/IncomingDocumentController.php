<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\CollectiveFunctionController;
use App\Http\Requests\Documents\IncomingDocument\IncomingDocumentRequest;
use App\Models\DocumentComment;
use App\Models\DocumentTag;
use App\Models\DocumentTrack;
use App\Models\EmailLog;
use App\Models\IncomingDocument;
use App\Models\Reminder;
use App\Models\Tag;
use App\Repository\CalendarRepository;
use App\Repository\Configuration\DepartmentRepository;
use App\Repository\Configuration\DocumentCategoryRepository;
use App\Repository\Configuration\FiscalYearRepository;
use App\Repository\Configuration\TagRepository;
use App\Repository\Documents\DocumentCommentRepository;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\DocumentTimelineRepository;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\UserRepository;
use App\Traits\DocumentTrackTrait;
use App\Traits\EmailLogTrait;
use App\Traits\NotificationTrait;
use App\User;
//use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IncomingDocumentController extends BaseController
{
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var DocumentCategoryRepository
     */
    private $documentCategoryRepository;
    /**
     * @var CollectiveFunctionController
     */
    private $collectiveFunctionController;
    /**
     * @var DocumentCommentRepository
     */
    private $documentCommentRepository;
    /**
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var DocumentTag
     */
    private $documentTag;

    private $documentTimelineRepository;

    private $userRepository;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    public function __construct(
        IncomingDocumentRepo $incomingDocumentRepo,
        InstitutionRepository $institutionRepository,
        DepartmentRepository $departmentRepository,
        DocumentCategoryRepository $documentCategoryRepository,
        CollectiveFunctionController $collectiveFunctionController,
        DocumentCommentRepository $documentCommentRepository,
        TagRepository $tagRepository, DocumentTag $documentTag,
        DocumentTimelineRepository $documentTimelineRepository,
        UserRepository $userRepository,
        CalendarRepository $calendarRepository,
        FiscalYearRepository $fiscalYearRepository
      
    )
    {
        parent::__construct();
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->institutionRepository = $institutionRepository;
        $this->departmentRepository = $departmentRepository;
        $this->documentCategoryRepository = $documentCategoryRepository;
        $this->collectiveFunctionController = $collectiveFunctionController;
        $this->documentCommentRepository = $documentCommentRepository;
        $this->tagRepository = $tagRepository;
        $this->documentTag = $documentTag;
        $this->documentTimelineRepository = $documentTimelineRepository;
        $this->userRepository = $userRepository;
        $this->calendarRepository = $calendarRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function index(Request $request)
    {
        $incomingDocuments = $this->incomingDocumentRepo->getfilter($request)->get();
        $category = $this->documentCategoryRepository->getAllChild();
        $departments = $this->departmentRepository->all();
        $institutions = $this->institutionRepository->lists();
        $incomingDocuments = $this->collectiveFunctionController->documentPagination($incomingDocuments, 20);
     

        return view('documents.incoming.index', compact('incomingDocuments', 'category', 'departments', 'institutions'));
    }

    public function create()
    {
        $institutionList = $this->institutionRepository->lists();
        $departmentList = $this->departmentRepository->lists();
        $documentCategoryRepo = $this->documentCategoryRepository;
        $tagList = $this->tagRepository->lists();

        return view('documents.incoming.add', compact('institutionList', 'tagList', 'departmentList', 'documentCategoryRepo'));
    }

    public function store(IncomingDocumentRequest $request)
    {
        try {
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d',strtotime($request['document_received_date'])));
            if($fiscalYear != null)
            {
            
                if($request->get('tag_id') == null)
                {
                    $tagIds = 1;
                }
                else{
                    $tagIds = $request->get('tag_id');
                }
            

            $tags = explode(',', $tagIds);
            $count = count($tags);
            $request['uploaded_by_user_id'] = Auth::user()->id;

            $getIssue = $this->incomingDocumentRepo->getIssueNumber($request->document_category_id, $request->document_received_date);

            $request['incoming_document_registration_number'] = $getIssue['incoming_document_registration_number'];
            $request['incoming_serial_number'] = $getIssue['incoming_serial_number'];

            $name = str_replace('/', '-', $fiscalYear->fy_name) . '/' . $request['incoming_document_registration_number'];
            if (!empty($request->file('file_upload'))) {
                $incomingDocument = $request->file('file_upload');
                $documentExtension = $incomingDocument->getClientOriginalExtension();
                $incomingFileName = $name . '.' . strtolower($documentExtension);

                $request['incoming_document_upload'] = $incomingFileName;
                $file_upload = true;
            }

            if (!empty($request->file('incoming_document_add_uploads'))) {
                $additionalDocument = $request->file('incoming_document_add_uploads');
                $additionalDocumentExtension = $additionalDocument->getClientOriginalExtension();
                $additionalFileName = 'additional' . $name . '.' . strtolower($additionalDocumentExtension);

                $request['incoming_document_additional_uploads'] = $additionalFileName;
                $incoming_document_add_uploads = true;
            }

            $create = IncomingDocument::create($request->all());
            $id = $create->id;
            if ($create) {

                $title = "Incoming Document Created";
                $content = "<a href=" . url('/documents/incomingDocument/' . $create->id) . ">$create->incoming_document_subject</a>";

                $reminder_date = (new DateTime($create->created_at))->format('Y-m-d\TH:i:s\Z');

                // $this->calendarRepository->store($title, $content, $reminder_date);
                // dd('test');

                $userId = $this->userRepository->getAllUsersId();
                DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $id, 'create', date('Y-m-d'));
                NotificationTrait::createNotification($userId, 'has Created' . " " . $create->incoming_document_subject . " " . 'Document', '/documents/incomingDocument/' . $create->id, date('Y-m-d'), Auth::user()->id);
                for ($i = 0; $i < $count; $i++) {
                    $tagEntry['document_id'] = $create->id;
                    $tagEntry['tag_id'] = $tags[$i];
                    $tagEntry['document_tag_type'] = 'incoming';
                    $this->documentTag->create($tagEntry);
                }

                $id = $create->id;
                if (isset($file_upload)) {
                    Storage::putFileAs('public/uploads/documents/incomingDocuments', $incomingDocument, $incomingFileName);
                }

                if (isset($incoming_document_add_uploads)) {
                    Storage::putFileAs('public/uploads/documents/incomingDocuments', $additionalDocument, $additionalFileName);

                }

                if ($request->incoming_document_privacy == "confidential") {
                    $users = $request['confidential_email'];
                    $userIds = explode(',', $users);
                    foreach ($userIds as $user) {
                        $value[] = [
                            'document_id' => $create->id,
                            'document_type' => 'incoming',
                            'user_id' => $user
                        ];
                    }
                    DB::table('dms_document_privacy')->insert($value);
                }

                session()->flash('success', 'Incoming Document successfully created');

                if ($request->save == "save") {
                    return redirect('documents/incomingDocument');
                } elseif ($request->saveAndAddNew == "saveAndAddNew") {
                    return redirect('documents/incomingDocument/create');
                } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->incoming_document_privacy == 'general') {
                    return redirect('documents/incomingDocument/create');
                }

                if ($request->incoming_document_privacy == "departmental" || $request->incoming_document_privacy == "confidential") {

                    if ($request->saveAndSendEmail == "saveAndSendEmail") {

                        $request['attach_incoming_document_additional_uploads'] = 'yes';
                        $sendMessage = $this->collectiveFunctionController->sendMail($create->id, $request->receiver_department_id, null, 'incoming', $request);
                        //                        EmailLogTrait::createEmailLog($create_id,$request->receiver_department_id,);
                        session()->flash('success', 'Incoming Document successfully created and message sent');
                        return redirect('documents/incomingDocument');
                    }
                }


            } else {
                session()->flash('error', 'Incoming Document could not be created');
                return back()->withInput();
            }
            
            }
            else{
                session()->flash('error', 'Date should be of this fiscal year');
                return back()->withInput();
            }


               
        } catch (\Exception $e) {
            $e->getMessage();
 
            session()->flash('error', 'Exception : ' . $e);
            return back()->withInput();
        }

    }

    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits = $this->incomingDocumentRepo->findById($id);
            if (count($edits) > 0) {
                $institutionList = $this->institutionRepository->lists();
                $departmentList = $this->departmentRepository->lists();
                $documentCategoryRepo = $this->documentCategoryRepository;


                if ($edits->incoming_document_privacy == 'Confidential') {
                    $userLists = DB::table('dms_document_privacy')->where('document_id', $id)->where('document_type', 'incoming')->select('user_id')->get();
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

                $tags = $this->documentTag->where('document_id', '=', $edits->id)->where('document_tag_type', '=', 'incoming')->select('tag_id')->get();

                if (count($tags) != null) {
                    foreach ($tags as $tag) {
                        $tagsInfo[] = $this->tagRepository->findTag($tag->tag_id);
                    }
                    $tagIds = json_encode($tagsInfo);
                } else {
                    $tagsInfo[] = null;
                    $tagIds = json_encode($tagsInfo);
                }
                return view('documents.incoming.edit', compact('edits', 'users', 'tagIds', 'institutionList', 'departmentList', 'documentCategoryRepo'));
            } else {
                session()->flash('error', 'Document not available');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            $errors = $this->validator->errors()->toArray();

            return Response::json(
                array('errors' => $errors)
            );

        }
    }

    public function update(IncomingDocumentRequest $request, $id)
    {
      
            $fiscalYear =  $this->fiscalYearRepository->getFiscalYear(date('Y-m-d'));

            $tagIds = $request->get('tag_id');
            $tags = explode(',', $tagIds);
            $count = count($tags);
            $value = $this->incomingDocumentRepo->findById($id);

            if (!empty($request->file('file_upload'))) {
                if (!empty($value->incoming_document_upload)) {
                    Storage::delete('public/uploads/documents/incomingDocuments/' . $value->incoming_document_upload);
                }
                $incomingDocument = $request->file('file_upload');
                $documentExtension = $incomingDocument->getClientOriginalExtension();
                $incomingFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'document' . time() . '.' . strtolower($documentExtension);

                $request['incoming_document_upload'] = $incomingFileName;
                $file_upload = true;
            }

            if (!empty($request->file('incoming_document_add_uploads')) || $request->add_file_upload != NULL) {
                $oldImages = null;
                if ($value->incoming_document_additional_uploads != null) {
                    $oldImages = json_decode($value->incoming_document_additional_uploads);

                }

                if ($oldImages == null && $value->incoming_document_additional_uploads != null) {
                  
                    $imageNames[] = $value->incoming_document_additional_uploads;
                 
                }

                $images = $request->add_file_upload;
                for ($i = 0; $i < count($images); $i++) {
                    $incomingFile = $images[$i];
                    $documentExtension = $incomingFile->getClientOriginalExtension();
                    $incomingFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'incoming' . time() . rand_string(6) . '.' . strtolower($documentExtension);

                   $sande= Storage::putFileAs('public/uploads/documents/incomingDocuments', $incomingFile, $incomingFileName);
        
                   $imageNames[] = $incomingFileName;
     
                if ($value->incoming_document_additional_uploads != null && $oldImages != null) {
                   
                    $oldImages = json_decode($value->incoming_document_additional_uploads);
                    $request['incoming_document_additional_uploads'] = json_encode(array_merge($oldImages, $imageNames));

                } else {
                
                    $request['incoming_document_additional_uploads'] = json_encode($imageNames);

                }
            }

            }
            $userId = $this->userRepository->getAllUsersId();

            if ($value) {

                $value->fill($request->all())->save();
                DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $id, 'edit', date('Y-m-d'));
                NotificationTrait::createNotification($userId, 'has Updated' . " " . $value->incoming_document_subject . " " . 'Document', '/documents/incomingDocument/' . $value->id, date('Y-m-d'), Auth::user()->id);
                DB::table('dms_document_tags')->where('document_id', '=', $value->id)->delete();
                if ($tagIds != null || $tagIds != '') {
                    DB::table('dms_document_privacy')->where('document_id', '=', $value->id)
                        ->where('document_type', '=', 'incoming')->delete();
                    for ($i = 0; $i < $count; $i++) {
                        $tagEntry['document_id'] = $value->id;
                        $tagEntry['tag_id'] = $tags[$i];
                        $tagEntry['document_tag_type'] = 'incoming';
                        $this->documentTag->create($tagEntry);
                    }
                }
                if (isset($file_upload)) {
            Storage::putFileAs('public/uploads/documents/incomingDocuments', $incomingDocument, $incomingFileName);
  
                }
//                if (isset($incoming_document_add_uploads)) {
//                    Storage::putFileAs('public/uploads/documents/incomingDocuments', $additionalDocument, $additionalFileName);
//
//                }
                if ($request->incoming_document_privacy == "confidential") {
                    $users = $request['confidential_email'];
                    $userIds = explode(',', $users);
                    foreach ($userIds as $user) {
                        $data[] = [
                            'document_id' => $id,
                            'document_type' => 'incoming',
                            'user_id' => $user
                        ];
                    }
                    DB::table('dms_document_privacy')->insert($data);
                }
                session()->flash('success', 'Incoming Document successfully Updated');

                if ($request->saveAdditionalFile == "saveAdditionalFile") {
                    return redirect('documents/incomingDocument/' . $id);
                }
                if ($request->update == "update") {
                    return redirect('documents/incomingDocument');
                } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->incoming_document_privacy == 'general') {
                    return redirect('documents/incomingDocument');
                }

                if ($request->incoming_document_privacy == "departmental" || $request->incoming_document_privacy == "confidential") {

                    if ($request->saveAndSendEmail == "saveAndSendEmail") {

                        $request['attach_incoming_document_additional_uploads'] = 'yes';
                        $sendMessage = $this->collectiveFunctionController->sendMail($value->id, $request->receiver_department_id, null, 'incoming', $request);
                        session()->flash('success', 'Incoming Document successfully Updated and email sent');
                        return redirect('documents/incomingDocument');
                    }
                }

            } else {
                session()->flash('error', 'Incoming Document could not be updated');
                return back();
            }
     
    }


    public function getDepartmentEmail($id)
    {
        $array = CollectiveFunctionController::findEmail($id);
        return implode(",", $array);
    }

    public function destroy($id, Request $request)
    {
        try {
            $id = (int)$id;
            $value = $this->incomingDocumentRepo->findById($id);

            if ($value) {

                if ($request->additional_file != null) {
                    $arrayPhoto = json_decode($value->incoming_document_additional_uploads);
                    $remainingPics=count($arrayPhoto);

                    for ($i = 0; $i < count($arrayPhoto); $i++) {
                        if ($arrayPhoto[$i] == $request->additional_file) {
                            //delete Picture

                            @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $request->additional_file);

                            unset($arrayPhoto[$i]);

                        }
                    }
                    if($remainingPics==1) {
                    $addPictures=null;
                    }
                    else {
                        $addPictures = json_encode(array_values($arrayPhoto));
                    }
                    $value->update(['incoming_document_additional_uploads' => $addPictures]);
                    session()->flash('success', 'Document  has been deleted');
                    return back();
                }


                $comments = DocumentComment::where('documents_id', $value->id)->where('document_comments_type', 'incoming')->get();
                foreach ($comments as $comment) {
                    if ($comment->document_comments_upload != null) {
                        @unlink(storage_path() . '/app/public/uploads/documents/commentDocuments/' . $comment->document_comments_upload);
                    }
                    $comment->delete();
                }

                $tracks = DocumentTrack::where('tracks_document_id', $value->id)->where('tracks_document_type', 'incoming')->get();
                foreach ($tracks as $track) {
                    $track->delete();
                }

                $emailLogs = EmailLog::where('email_logs_document_id', $value->id)->where('email_logs_document_type', 'incoming')->get();
                foreach ($emailLogs as $log) {
                    $log->delete();
                }

                $reminders = Reminder::where('document_id', $value->id)->where('document_type', 'incoming')->get();
                foreach ($reminders as $reminder) {
                    $reminder->delete();
                }
                $value->delete();
//                DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $id, 'delete', date('Y-m-d'));
                session()->flash('success', 'Incoming Document successfully deleted');
                return back();

            } else {
                session()->flash('error', 'Incoming Document could not be deleted');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();
        }
    }

    public function show($id)
    {
        $id = (int)$id;
        try {
            $tags = DocumentTag::where('document_tag_type', '=', 'incoming')->where('document_id', $id)->get();
            $incomingDocument = $this->incomingDocumentRepo->findById($id);
            if (empty($incomingDocument)) {
                session()->flash('error', "Document not available!!");
                return back();
            }
            $user_id = Auth::user()->id;
            $document = IncomingDocument::with('user')->with('institution')->find($id);
            $reminders = Reminder::where('document_type', '=', 'incoming')->where('document_id', '=', $id)->where('reminder_user_id', '=', Auth::user()->id)->get();
            $documentComments = $this->documentCommentRepository->getIncomingDocumentCommentsById($id);
            $timelineDate = $this->documentTimelineRepository->getDocumentDate($id, 'incoming');
            
            DocumentTrackTrait::createDocumentTrack($user_id, 'incoming', $id, 'view', date('Y-m-d'));
            return view('documents.incoming.show', compact('tags', 'incomingDocument', 'user_id', 'document', 'reminders', 'documentComments', 'timelineDate'));

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();
        }
    }

    /**
     * @param $documentId
     */
    public function downloadDocument($documentId)
    {
        try {
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $document = IncomingDocument::find($documentId);
            DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $documentId, 'download', date('Y-m-d'));
            if ($document->incoming_document_upload != null) {

                if (file_exists($docpath = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $document->incoming_document_upload)) {
                    if ($document->incoming_document_additional_uploads != null) {
                        if (file_exists($additional_path = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $document->incoming_document_additional_uploads)) {
//                        $additional_path = storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $document->incoming_document_additional_uploads;
                            $zippath = [$docpath, $additional_path];

                            return $this->collectiveFunctionController->incomingDownloadZip($zippath, $document->id . '-' . $document->incoming_document_subject);
                        }
                    }

                    return response()->download($docpath);
                } else {
                    session()->flash('error', "Document doesn't Exist!!");
                    return back();

                }

            } else {
                return false;
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back()->withInput();
        }
    }

    public function download($documentId)
    {
        DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $documentId, 'download', date('Y-m-d'));
        $document = IncomingDocument::find($documentId);
        if ($document->incoming_document_upload != null) {
            $path = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $document->incoming_document_upload;
            return response()->download($path);
        }
        return false;
    }

    public function downloadAdd($documentId)
    {
      
        DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'incoming', $documentId, 'download', date('Y-m-d'));
        $document = IncomingDocument::find($documentId);
     
        if ($document->incoming_document_additional_uploads != null) {

            $incoming = json_decode($document->incoming_document_additional_uploads);
            for ($i=0; $i < count($incoming) ; $i++) { 
                $additional_path = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $incoming[$i];
                return response()->download($additional_path);
            }
    
           
        }
        return false;
    }


    public function sendDocumentFromEmail(Request $request, $documentId)
    {
     
        $email = $this->collectiveFunctionController->sendMail($documentId, null, null, 'incoming', $request);

        session()->flash('success', 'Email/Message sent');
        return back();
    }

    public function editReminder($documentId, $reminderId)
    {

        $user_id = Auth::user()->id;
        $tags = DocumentTag::where('document_tag_type', '=', 'incoming')->where('document_id', '=', $documentId)->get();
        $incomingDocument = $this->incomingDocumentRepo->findById($documentId);
        DocumentTrackTrait::createDocumentTrack($user_id, 'incoming', $documentId, 'view', date('Y-m-d'));
        $document = IncomingDocument::with('user')->with('institution')->find($documentId);
        $reminders = Reminder::where('document_type', '=', 'incoming')->where('document_id', '=', $documentId)->get();
        $documentComments = $this->documentCommentRepository->getIncomingDocumentCommentsById($documentId);
        $timelineDate = $this->documentTimelineRepository->getDocumentDate($documentId, 'incoming');
        $edits = Reminder::find($reminderId);
        return view('documents.incoming.show', compact('incomingDocument', 'document', 'documentComments', 'reminders', 'edits', 'tags', 'timelineDate'));
    }

}
