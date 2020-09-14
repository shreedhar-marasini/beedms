<?php

namespace App\Http\Controllers\Documents;

use App\Http\Requests\DocumentCommentRequest;
use App\Models\DocumentComment;
use App\Models\DocumentPrivacy;
use App\Repository\Configuration\FiscalYearRepository;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\DocumentCommentRepository;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\Documents\OutgoingDocumentRepository;
use App\Repository\UserRepository;
use App\Traits\NotificationTrait;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;

class DocumentCommentController extends Controller
{
    /**
     * @var DocumentCommentRepository
     */
    private $documentCommentRepository;
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    public function __construct(
        DocumentCommentRepository $documentCommentRepository,
        IncomingDocumentRepo $incomingDocumentRepo,
        UserRepository $userRepository,
        DigitizedDocumentRepo $digitizedDocumentRepo,
        OutgoingDocumentRepository $outgoingDocumentRepository,
        FiscalYearRepository $fiscalYearRepository
    )
    {
        $this->documentCommentRepository = $documentCommentRepository;
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->userRepository = $userRepository;
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function store(DocumentCommentRequest $request)
    {
        try {
            $fiscalYear = $this->fiscalYearRepository->getFiscalYear(date('Y-m-d'));

            if (!empty($request->file('comment_file_uploads'))) {
                $outgoingCommentFile = $request->file('comment_file_uploads');
                $documentExtension = $outgoingCommentFile->getClientOriginalExtension();
                $outgoingCommentFileName = str_replace('/', '-', $fiscalYear->fy_name) . '/' .$request->documents_id . '-' . time() . '-commentFile' . '.' . strtolower($documentExtension);
                $request['document_comments_upload'] = $outgoingCommentFileName;
                $comment_file_uploads = true;
            }
            $request['commented_by_user_id'] = Auth::user()->id;
            $comment = DocumentComment::create($request->all());
            if ($comment) {
                $website = \App\Models\MasterSetting::where('key_name', '_COMPANY_WEBSITE_')->first();
                $logo = \App\Models\MasterSetting::where('key_name', '_COMPANY_LOGO_')->first();

                $logoForEmail = $website->key_value . '/storage/uploads/company_assets/' . $logo->key_value;

                if ($request->document_comments_type == "incoming") {
                    $document = $this->incomingDocumentRepo->findById($request->documents_id);
                    $privacy = $document['incoming_document_privacy'];
                    $documentType = '/documents/incomingDocument/';
                    if ($privacy == 'Confidential') {
                        $userLists = DB::table('dms_document_privacy')->where('document_id', $document->id)->where('document_type', 'incoming')->select('user_id')->get();
                        if (count($userLists) > 0) {
                            foreach ($userLists as $userList) {
                                $user[] = $userList->user_id;
                            }

                            foreach ($user as $u) {
                                if (Auth::user()->id != $u)
                                    $email[] = User::find($u)->email;
                            };

                            $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';


                            $mail = Mail::send('emails.commentmail', ['letter' => $document, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($document, $subject, $email, $documentType, $logoForEmail, $request) {

                                $m->to($email)->subject($subject);


                            });
                            NotificationTrait::createNotification($user, 'has Commented on Document', $documentType . $document->id, date('Y-m-d'), Auth::user()->id);
                        }
                    }
                } elseif ($request->document_comments_type == "digitized") {
                    $document = $this->digitizedDocumentRepo->findById($request->documents_id);
                    $privacy = $document['digitized_document_privacy'];
                    $documentType = '/documents/digitizedDocument/';
                    if ($privacy == 'Confidential') {
                        $userLists = DB::table('dms_document_privacy')->where('document_id', $document->id)->where('document_type', 'digitized')->select('user_id')->get();
                        if (count($userLists) > 0) {
                            foreach ($userLists as $userList) {
                                $user[] = $$userList->user_id;
                            }
                            foreach ($user as $u) {
                                if (Auth::user()->id != $u)
                                    $email[] = User::find($u)->email;
                            };

                            $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';


                            $mail = Mail::send('emails.commentmail', ['letter' => $document, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($document, $subject, $email, $documentType, $logoForEmail, $request) {

                                $m->to($email)->subject($subject);


                            });
                            NotificationTrait::createNotification($user, 'has Commented on Document', $documentType . $document->id, date('Y-m-d'), Auth::user()->id);
                        }
                    }

                } else {
                    $document = $this->outgoingDocumentRepository->findById($request->documents_id);
                    $privacy = $document['outgoing_document_privacy'];
                    $documentType = '/documents/outgoingDocument/';
                    if ($privacy == 'Confidential') {
                        $userLists = DB::table('dms_document_privacy')->where('document_id', $document->id)->where('document_type', 'outgoing')->select('user_id')->get();
                        if (count($userLists) > 0) {
                            foreach ($userLists as $userList) {
                                $user[] = $userList->user_id;
                            }
                            foreach ($user as $u) {
                                if (Auth::user()->id != $u)
                                    $email[] = User::find($u)->email;
                            };

                            $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';


                            $mail = Mail::send('emails.commentmail', ['letter' => $document, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($document, $subject, $email, $documentType, $logoForEmail, $request) {

                                $m->to($email)->subject($subject);


                            });
                            NotificationTrait::createNotification($user, 'has Commented on Document', $documentType . $document->id, date('Y-m-d'), Auth::user()->id);
                        }
                    }
                }

                if ($privacy == "General") {
                    $userId = $this->userRepository->getAllUsersId();
                    foreach ($userId as $user) {
                        if (Auth::user()->id != $user)

                            $email[] = User::find($user)->email;
                    };
                    if ($document->incoming_document_subject != null) {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';
                    } elseif ($document->outgoing_document_subject != null) {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';

                    } else {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->digitized_document_name . ' "';

                    }


                    $mail = Mail::send('emails.commentmail', ['letter' => $document, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($document, $subject, $email, $documentType, $logoForEmail, $request) {

                        $m->to($email)->subject($subject);


                    });
                    $username = Auth::user()->id;
                    NotificationTrait::createNotification($userId, 'has Commented on Document', $documentType . $document->id, date('Y-m-d'), $username);

                }
                if ($privacy == "Departmental") {
                    $userId = $this->userRepository->getAllDepartmentUsersId(Auth::user()->department_id);
                    foreach ($userId as $user) {
                        if (Auth::user()->id != $user)
                            $email[] = User::find($user)->email;
                    };
                    if ($document->incoming_document_subject != null) {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';
                    } elseif ($document->outgoing_document_subject != null) {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->incoming_document_subject . ' "';

                    } else {
                        $subject = Auth::user()->name . ' commented on document " ' . $document->digitized_document_name . ' "';

                    }


                    $mail = Mail::send('emails.commentmail', ['letter' => $document, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($document, $subject, $email, $documentType, $logoForEmail, $request) {

                        $m->to($email)->subject($subject);


                    });
                    NotificationTrait::createNotification($userId, 'has Commented on Document', $documentType . $document->id, date('Y-m-d'), Auth::user()->id);

                }

                if (isset($comment_file_uploads)) {

                    Storage::putFileAs('public/uploads/documents/commentDocuments', $outgoingCommentFile, $outgoingCommentFileName);
                }
                session()->flash('success', 'Successfully added Comment');
                return back();

            } else {
                session()->flash('error', 'Cannot Comment Please try again');
                return back()
                    ->withInput();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back()
                ->withInput();
        }
    }

    public function download($id)
    {
        $comment = DocumentComment::find($id);
        $filepath = storage_path('app/public/uploads/documents/commentDocuments/' . $comment->document_comments_upload);
        return response()->download($filepath);

    }

    public function show($id)
    {

    }

    public function update($id, DocumentCommentRequest $request)
    {
        $comment = DocumentComment::find($id);
        if (!empty($request->file('comment_file_uploads'))) {
            $outgoingCommentFile = $request->file('comment_file_uploads');
            $documentExtension = $outgoingCommentFile->getClientOriginalExtension();
            $outgoingCommentFileName = $request->documents_id . '-' . time() . '-commentFile' . '.' . strtolower($documentExtension);
            $request['document_comments_upload'] = $outgoingCommentFileName;
            unlink('public/uploads/documents/commentDocuments' . $comment->document_comments_upload);
            $comment_file_uploads = true;
        }
        $request['commented_by_user_id'] = Auth::user()->id;
        $save = $comment->fill($request->all())->save();
        if ($save) {
            if (isset($comment_file_uploads)) {
                Storage::putFileAs('public/uploads/documents/commentDocuments', $outgoingCommentFile, $outgoingCommentFileName);
            }

        }
        return $comment;
    }

    public function destroy($id)
    {
        $comment = DocumentComment::find($id);
        if ($comment) {
            if ($comment->document_comments_upload != null)
                unlink(storage_path() . '/app/public/uploads/documents/commentDocuments/' . $comment->document_comments_upload);
            $comment->delete();
        }
        return $comment;
    }
}
