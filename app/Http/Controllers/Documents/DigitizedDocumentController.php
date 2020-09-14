<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\CollectiveFunctionController;
use App\Http\Requests\Documents\DigitizedDocumentRequest;
use App\Models\DigitizedDocument;
use App\Models\DocumentComment;
use App\Models\DocumentTag;
use App\Models\DocumentTrack;
use App\Models\EmailLog;
use App\Models\Folder;
use App\Models\Reminder;
use App\Models\Tag;
use App\Repository\CalendarRepository;
use App\Repository\Configuration\DepartmentRepository;
use App\Repository\Configuration\DocumentCategoryRepository;
use App\Repository\Configuration\FiscalYearRepository;
use App\Repository\Configuration\TagRepository;
use App\Repository\Configuration\TemplateRepository;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\DocumentCommentRepository;
use App\Repository\DocumentTimelineRepository;
use App\Repository\FolderRepository;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\UserRepository;
use App\Traits\DocumentTrackTrait;
use App\Traits\EmailLogTrait;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use DateTime;

class DigitizedDocumentController extends BaseController
{
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;
    /**
     * @var DocumentCategoryRepository
     */
    private $categoryRepository;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var TemplateRepository
     */
    private $templateRepository;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    /**
     * @var DigitizedDocument
     */
    private $digitizedDocument;
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
     * @var Tag
     */
    private $tag;
    /**
     * @var DocumentTag
     */
    private $documentTag;
    /**
     * @var DocumentTimelineRepository
     */
    private $documentTimelineRepository;
    /**
     * @var CalendarRepository
     */
    private $calendarRepository;
    /**
     * @var FolderRepository
     */
    private $folderRepository;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * DigitalizedDocumentController constructor.
     * @param DigitizedDocumentRepo $digitizedDocumentRepo
     * @param DocumentCategoryRepository $categoryRepository
     * @param DepartmentRepository $departmentRepository
     * @param TemplateRepository $templateRepository
     * @param InstitutionRepository $institutionRepository
     * @param DigitizedDocument $digitizedDocument
     * @param CollectiveFunctionController $collectiveFunctionController
     * @param DocumentCommentRepository $documentCommentRepository
     * @param TagRepository $tagRepository
     * @param DocumentTag $documentTag
     * @param DocumentTimelineRepository $documentTimelineRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        DigitizedDocumentRepo $digitizedDocumentRepo,
        DocumentCategoryRepository $categoryRepository,
        DepartmentRepository $departmentRepository,
        TemplateRepository $templateRepository,
        InstitutionRepository $institutionRepository,
        DigitizedDocument $digitizedDocument,
        CollectiveFunctionController $collectiveFunctionController,
        DocumentCommentRepository $documentCommentRepository,
        TagRepository $tagRepository,
        DocumentTag $documentTag,
        DocumentTimelineRepository $documentTimelineRepository,
        UserRepository $userRepository,
        CalendarRepository $calendarRepository,
        FolderRepository $folderRepository,
        FiscalYearRepository $fiscalYearRepository
    )
    {
        parent::__construct();
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
        $this->categoryRepository = $categoryRepository;
        $this->departmentRepository = $departmentRepository;
        $this->templateRepository = $templateRepository;
        $this->institutionRepository = $institutionRepository;
        $this->digitizedDocument = $digitizedDocument;
        $this->collectiveFunctionController = $collectiveFunctionController;
        $this->documentCommentRepository = $documentCommentRepository;
        $this->tagRepository = $tagRepository;
        $this->documentTag = $documentTag;
        $this->userRepository = $userRepository;
        $this->documentTimelineRepository = $documentTimelineRepository;
        $this->calendarRepository = $calendarRepository;
        $this->folderRepository = $folderRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function index(Request $request)
    {
        $digitizedDocuments = $this->digitizedDocumentRepo->getDigitizedDocument($request)->get();
        $category = $this->categoryRepository->getAllChild();
        $departments = $this->departmentRepository->all();
        $institutions = $this->institutionRepository->lists();
        $digitizedDocuments = $this->collectiveFunctionController->documentPagination($digitizedDocuments, 20);


        return view('documents.digitizedDocument.index', compact('digitizedDocuments', 'departments', 'institutions', 'category'));
    }

    public function create()
    {
        $categoryRepo = $this->categoryRepository;
        $departments = $this->departmentRepository->all();
        $templateRepo = $this->templateRepository;
        $institutions = $this->institutionRepository->lists();
        $folders = $this->folderRepository;
       
   
        return view('documents.digitizedDocument.add', compact('categoryRepo', 'departments', 'templateRepo', 'institutions', 'folders'));

    }

    public function store(DigitizedDocumentRequest $request)
    {
        try {
//            return $request->all();
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d',strtotime($request['digitized_document_date'])));
            if($fiscalYear)
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
           
    
                if ($request->select_from_existing_folder == null) {
                    $request['folder_id'] = 0;
                }
                if ($request->file_uploads != NULL) {
                    $images = $request->file_uploads;
                    foreach ($images as $image) {
                        $digitizeFile = $image;
                        $documentExtension = $digitizeFile->getClientOriginalExtension();
                        $digitizeFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'digitize' . time() . rand_string(6) . '.' . strtolower($documentExtension);
    
    
                        Storage::putFileAs('public/uploads/documents/digitizedDocuments', $digitizeFile, $digitizeFileName);
                        $imageNames[] = $digitizeFileName;
    
                    }
                    $request['digitized_document_path'] = json_encode($imageNames);
    
                }
                $request['uploaded_by_user_id'] = Auth::user()->id;
                $request['digitized_document_content'] = $request->editor1;
    
                $create = $this->digitizedDocument->create($request->all());
               
               
                        $create->save();
    
                if ($create) {
                    $userId = $this->userRepository->getAllUsersId();
                    DocumentTrackTrait::createDocumentTrack(Auth::user()->id, 'digitized', $create->id, 'create', date('Y-m-d'));
                    NotificationTrait::createNotification($userId, 'has Created' . " " . $create->digitized_document_name . " " . 'Document', '/documents/digitizedDocument/' . $create->id, date('Y-m-d'), Auth::user()->id);
                    if ($request->digitized_document_reminder_content != null) {
                        $reminder['reminder_user_id'] = Auth::user()->id;
                        $reminder['document_id'] = $create->id;
                        $reminder['document_type'] = 'digitized';
                        $reminder['reminder_date'] = $request->digitized_document_reminder_date;
                        $reminder['reminder_title'] = 'document_reminder';
                        $reminder['reminder_content'] = $request->digitized_document_reminder_content;
                        $reminder['reminder_type'] = 'email';
    //                $reminder['reminder_snooze_date']=$request->reminder_snooze_date;
                        $reminder['reminder_to_email'] = Auth::user()->email;
                        Reminder::create($reminder);
                    }
    
                    for ($i = 0; $i < $count; $i++) {
                        $tagEntry['document_id'] = $create->id;
                        $tagEntry['tag_id'] = $tags[$i];
                        $tagEntry['document_tag_type'] = 'digitized';
       
                        $this->documentTag->create($tagEntry);
                    }
    
                    $title = "Digitized Document Created";
                    $content = "<a href=" . url('http://localhost:8000/documents/digitizedDocument/' . $create->id) . ">$request->digitized_document_name</a>";
    
                    $reminder_date = (new DateTime($create->created_at))->format('Y-m-d\TH:i:s\Z');
                    // $this->calendarRepository->store($title, $content, $reminder_date);
    
    
                    if ($request->digitized_document_privacy == "confidential") {
                        $users = $request['confidential_email'];
                        $userIds = explode(',', $users);
                        foreach ($userIds as $user) {
                            $value[] = [
                                'document_id' => $create->id,
                                'document_type' => 'digitized',
                                'user_id' => $user
                            ];
                        }
                        DB::table('dms_document_privacy')->insert($value);
                    }
    
                    if ($request->save == "save") {
                        session()->flash('success', 'Digitized document added successfully');
                        return redirect('documents/digitizedDocument');
                    } elseif ($request->saveAndAddNew == "saveAndAddNew") {
                        session()->flash('success', 'Digitized document added successfully');
                        return redirect('documents/digitizedDocument/create');
                    } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->digitized_document_privacy == "general") {
                        session()->flash('success', 'Digitized document added successfully');
                        return redirect('documents/incomingDocument');
                    } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->digitized_document_privacy == "Departmental" || $request->digitized_document_privacy == "confidential") {
                        $sendMessage = $this->collectiveFunctionController->sendMail($create->id, $create->department_id, null, 'digitized', $request);
                        session()->flash('success', 'Digitized document added successfully and sent email!');
                        return redirect('documents/digitizedDocument');
                    }
                    session()->flash('success', 'Digitized document added successfully!');
                    return redirect('documents/digitizedDocument');
    
                }
    

            }
            else
            {
                session()->flash('error', 'Date should be of this fiscal year');
                return back()->withInput();
            }
           
        } catch (\Exception $exception) {
            $exception = $exception->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }


    public function show($id)
    {
        try {
            $user_id = Auth::user()->id;
            $document = $this->digitizedDocumentRepo->findById($id);
            if ($document) {
                $documentComments = $this->documentCommentRepository->getDigitizedDocumentCommentsById($id);
                $timelineDate = $this->documentTimelineRepository->getDocumentDate($id, 'digitized');
                $tags = $this->documentTag->where('document_id', $id)->where('document_tag_type', '=', 'digitized')->get();
                $reminders = Reminder::where('document_type', '=', 'digitized')->where('document_id', '=', $id)->where('reminder_user_id', '=', Auth::user()->id)->get();
                DocumentTrackTrait::createDocumentTrack($user_id, 'digitized', $id, 'view', date('Y-m-d'));
                $path = storage_path() . '/app/public/uploads/documents/digitizedDocuments';


              
                return view('documents.digitizedDocument.show', compact('document', 'documentComments', 'documentContentNew','timelineDate', 'reminders', 'tags'));
            } else {
                session()->flash('error', "Document not available!!");
                return redirect('documents/digitizedDocument');
            }

        } catch (\Exception $exception) {
            $exception = $exception->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }

    }

    public function editReminder($documentId, $reminderId)
    {

        try {
            $document = $this->digitizedDocument->find($documentId);
            $documentComments = $this->documentCommentRepository->getOutgoingDocumentCommentsById($documentId);
            $timelineDate = $this->documentTimelineRepository->getDocumentDate($documentId, 'digitized');
            $reminders = Reminder::where('document_type', '=', 'digitized')->where('document_id', '=', $documentId)->where('reminder_user_id', '=', Auth::user()->id)->get();
            $tags = $this->documentTag->where('document_id', $documentId)->where('document_tag_type', '=', 'digitized')->get();
            $edits = Reminder::find($reminderId);
            return view('documents.digitizedDocument.show', compact('document', 'documentComments', 'timelineDate', 'reminders', 'edits', 'tags'));

        } catch (\Exception $exception) {
            $exception = $exception->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }


    public function edit($id)
    {
        $edits = $this->digitizedDocumentRepo->findById($id);
        if ($edits) {
            $categoryRepo = $this->categoryRepository;
            $departments = $this->departmentRepository->all();
            $templateRepo = $this->templateRepository;
            $institutions = $this->institutionRepository->lists();
            $folders = $this->folderRepository;

            if ($edits->digitized_document_privacy == 'Confidential') {
                $userLists = DB::table('dms_document_privacy')->where('document_id', $id)->where('document_type', 'digitized')->select('user_id')->get();
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

            $tags = $this->documentTag->where('document_id', '=', $edits->id)->where('document_tag_type', '=', 'digitized')->select('tag_id')->get();
            if (count($tags) != null) {
                foreach ($tags as $tag) {
                    $tagsInfo[] = $this->tagRepository->findTag($tag->tag_id);
                }
                $tagIds = json_encode($tagsInfo);
            } else {
                $tagsInfo[] = null;
                $tagIds = json_encode($tagsInfo);
            }
            return view('documents.digitizedDocument.edit', compact('edits', 'categoryRepo', 'users', 'departments', 'templateRepo', 'institutions', 'tagIds', 'folders'));
        } else {
            session()->flash('error', 'Document not available !!');
            return redirect('documents/digitizedDocument');
        }

    }


    public function update(DigitizedDocumentRequest $request, $id)
    {
        try {
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d'));

            $tagIds = $request->get('tag_id');
     
            $tags = explode(',', $tagIds);
         
            $count = count($tags);
            $digitizeDocument = $this->digitizedDocument->find($id);


            if ($request->select_from_existing_folder == null) {
                $request['folder_id'] = 0;
            }

            if ($request->file_uploads != NULL) {
                if ($digitizeDocument->digitized_document_path != null) {
                    $images = json_decode($digitizeDocument->digitized_document_path);
                    if ($images != null) {
                        foreach ($images as $image) {

                            Storage::delete('public/uploads/documents/digitizedDocuments/' . $image);
                        }
                    } else {
                        Storage::delete('public/uploads/documents/digitizedDocuments/' . $digitizeDocument->digitized_document_path);
                    }
                }

                $images = $request->file_uploads;
                for ($i = 0; $i < count($images); $i++) {
                    $digitizeFile = $images[$i];
                    $documentExtension = $digitizeFile->getClientOriginalExtension();
                    $digitizeFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'digitize' . time() . rand_string(6) . '.' . strtolower($documentExtension);

                    Storage::putFileAs('public/uploads/documents/digitizedDocuments', $digitizeFile, $digitizeFileName);
                    $imageNames[] = $digitizeFileName;

                }
                $request['digitized_document_path'] = json_encode($imageNames);


            }
            // if ($request->add_file_upload != NULL) {
            //     if ($digitizeDocument->digitized_file_uploads != null) {
            //         $oldImages = json_decode($digitizeDocument->digitized_file_uploads);

            //     }

            //     $images = $request->add_file_upload;
         
            //     for ($i = 0; $i < count($images); $i++) {
            //         $digitizeFile = $images[$i];
            //         $documentExtension = $digitizeFile->getClientOriginalExtension();
            //         $digitizeFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' . 'digitize' . time() . rand_string(6) . '.' . strtolower($documentExtension);

            //         Storage::putFileAs('public/uploads/documents/digitizedDocuments', $digitizeFile, $digitizeFileName);
            //         $imageNames[] = $digitizeFileName;

            //     }
            //     if ($digitizeDocument->digitized_file_uploads != null && $oldImages != null) {
            //         $oldImages = json_decode($digitizeDocument->digitized_file_uploads);
            //         $request['digitized_file_uploads'] = json_encode(array_merge($oldImages, $imageNames));

            //     } else {
            //         $request['digitized_file_uploads'] = json_encode($imageNames);

            //     }


            // }
         
            if($request->editor1 != null)
            {
         
                $request['digitized_document_content'] = $request->editor1;
            }
       
          
      

            $update = $digitizeDocument->fill($request->all())->save();
         
            if ($update) {
              if($request['digitized_file_uploads'] != null){
                if (!isset($request['digitized_file_uploads'])) {
                    DB::table('dms_document_tags')->where('document_id', '=', $digitizeDocument->id)->delete();
                    DB::table('dms_document_privacy')->where('document_id', '=', $digitizeDocument->id)->delete();
                    for ($i = 0; $i < $count; $i++) {
    
                        $tagEntry['document_id'] = $digitizeDocument->id;
                        $tagEntry['tag_id'] = $tags[$i];
                        $tagEntry['document_tag_type'] = 'digitized';
                     
                 
                      $this->documentTag->create($tagEntry); 
                    }
                }

              }
               
                if ($request->digitized_document_privacy == "confidential") {
                    $users = $request['confidential_email'];
                    $userIds = explode(',', $users);
                    foreach ($userIds as $user) {
                        $data[] = [
                            'document_id' => $id,
                            'document_type' => 'digitized',
                            'user_id' => $user
                        ];
                    }
                    DB::table('dms_document_privacy')->insert($data);
                }
                if ($request->saveAdditionalFile == "saveAdditionalFile") {
                    return redirect('documents/digitizedDocument/' . $id);
                }
                if ($request->update == "update") {
                    session()->flash('success', 'Digitized document updated successfully');
                    return redirect('documents/digitizedDocument');
                } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->digitized_document_privacy == "general") {
                    session()->flash('success', 'Digitized document updated and email sent successfully ');
                    return redirect('documents/digitizedDocument');
                } elseif ($request->saveAndSendEmail == "saveAndSendEmail" && $request->digitized_document_privacy == "Departmental" || $request->digitized_document_privacy == "Confidential") {
                    $sendMessage = $this->collectiveFunctionController->sendMail($digitizeDocument->id, $digitizeDocument->department_id, null, 'digitized', $request);

                    session()->flash('success', 'Digitized document updated and email sent successfully ');
                    return redirect('documents/digitizedDocument');
                }
            } else {
                session()->flash('error', 'Digitized document could not be updated');
                return back();

            }

        } catch (\Exception $exception) {
            $exception = $exception->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
        }
    }


    public function destroy($id, Request $request)
    {
        try {

            $document = $this->digitizedDocumentRepo->findById($id);
        
            if ($document) {
             
                if ($request->additional_file != null) {
                    $arrayPhoto = json_decode($document->digitized_document_path);
                 
                    $remainingPics=count($arrayPhoto);
                    
                    for ($i = 0; $i < count($arrayPhoto); $i++) {
                        if ($arrayPhoto[$i] == $request->additional_file) {
                            //delete Picture

                            @unlink(storage_path() . '/app/public/uploads/documents/digitizedDocuments/' . $request->additional_file);

                            unset($arrayPhoto[$i]);

                        }
                    }
                    if($remainingPics==1) {
                        $addPictures=null;
                    }
                    else {
                        $addPictures = json_encode(array_values($arrayPhoto));
                    }
                    $document->update(['digitized_document_path' => $addPictures]);
                    session()->flash('success', 'Document  has been deleted');
                    return back();
                }


                $comments = DocumentComment::where('documents_id', '=', $document->id)->where('document_comments_type', '=', 'digitized')->get();
                foreach ($comments as $comment) {
                    @unlink(storage_path() . '/app/public/uploads/documents/commentDocuments/' . $comment->document_comments_upload);
                    $comment->delete();
                }
                $documentTrack = DocumentTrack::where('tracks_document_id', '=', $document->id)->where('tracks_document_type', '=', 'digitized')->get();
                foreach ($documentTrack as $track) {
                    $track->delete();
                }
                $emailLogs = EmailLog::where('email_logs_document_id', '=', $document->id)->where('email_logs_document_type', '=', 'digitized')->get();
                foreach ($emailLogs as $log) {
                    $log->delete();
                }
                $reminders = Reminder::where('document_id', '=', $document->id)->where('document_type', '=', 'digitized')->get();

                foreach ($reminders as $reminder) {
                    $reminder->delete();
                }
                $document->delete();

                session()->flash('success', 'Digitized document deleted successfully');
                return redirect()->back();

            } else {
                session()->flash('error', 'Action not authorized!!');
                return redirect()->back();
            }


        } catch (\Exception $exception) {
            $exception = $exception->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return redirect()->back();
        }
    }

    public function downloadDocument($id)
    {
        $user_id = Auth::user()->id;

        DocumentTrackTrait::createDocumentTrack($user_id, 'digitized', $id, 'download', date('Y-m-d'));

        $digitizeDocument = $this->digitizedDocument->find($id);
        $digitize = json_decode($digitizeDocument->digitized_document_path);
        for ($i=0; $i < count($digitize); $i++) { 
            return response()->download(storage_path('app/public/uploads/documents/digitizedDocuments/'.$digitize[$i]));
        }
       
    }

    public function searchTag(Request $request)
    {
        $results = $this->tagRepository->searchTag($request)->get();
        return response($results);

    }

    public function sendDocumentFromEmail(Request $request, $documentId)
    {
        $email = $this->collectiveFunctionController->sendMail($documentId, null, null, 'digitized', $request);
        if ($email) {
            session()->flash('success', 'Message sent');
        }
        return back();
    }


}
