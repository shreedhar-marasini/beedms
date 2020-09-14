<?php
//helper function for sending email for department and admin while storing incoming letter email to sender after issue
// outgoing letter email to department and admin uploading digitized document
//helper function for finding email of super admin
//helper function for generating pdf
//no mail to superadmin while sending email to the receiver in sent letter


namespace App\Http\Controllers;

use App\Models\DigitizedDocument;
use App\Models\EmailLog;
use App\Models\OutgoingDocument;
use App\Models\Template;

use App\Repository\Calender\CalenderRepository;
use App\Repository\Configuration\FiscalYearRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\CustomTcpdf;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use PDF;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Traits\DocumentTrackTrait;
use App\Http\Controllers\Documents\ReplaceVariableController;


class CollectiveFunctionController extends Controller
{
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;
    /**
     * @var ReplaceVariableController
     */
    private $replaceVariableController;
    /**
     * @var CalendarRepository
     */
    private $calendarRepository;

    /**
     * @param FiscalYearRepository $fiscalYearRepository
     */
    function __construct(
        FiscalYearRepository $fiscalYearRepository,
        ReplaceVariableController $replaceVariableController,
        CalenderRepository $calendarRepository
    )
    {
        $this->middleware('auth');
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->replaceVariableController = $replaceVariableController;
        $this->calendarRepository = $calendarRepository;
    }

    public function test(Request $request)
    {
       
        return $sendMessage = $this->sendMail(1, null, null, 'outgoing', $request);
    }

//$document_id id of the document either incoming outgoing digitized
//$department_id to inform the particular document to inform about document
//document type incoming outgoing and digitized
    public function sendMail($document_id, $department_id, $institution_id, $documentType, $request)
    {
       
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            if ($request->bcc_email != null)
          
                $bccemail = explode(',', $request->bcc_email);
            else
                $bccemail = '';

            if ($documentType == 'incoming') {
                $letter = \App\Models\IncomingDocument::find($document_id);


                $location = null;
                //for getting email id to send email
                if ($request->receiver_email != null || $request->letter_subject != null) {

                    $email = explode(',', $request->receiver_email);
                    $subject = $request->incoming_document_subject;
                    if ($request->cc_email != null) {
                        $ccemail = explode(',', $request->cc_email);
                 
                    } else {
                        $ccemail = '';

                    }

                } else {
                    $email = self::findEmail($department_id, $request);
                    $subject = $letter->incoming_document_subject;
                    $ccemail = '';
                  

                }
                //document Attachment

                if ($request->attach_incoming_document_additional_uploads == 'yes' && $letter->incoming_document_additional_uploads != null && $request->hasFile('optional_uploads')) {
        
                    $opt = $request->file('optional_uploads');
                 
                    $name = time() . rand(0, 9);
                    $extesnion = $request->file('optional_uploads')->getClientOriginalExtension();
                    $name .= '.' . $extesnion;
                    //optional uploads
                    $location[0] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_upload;
                    $location[1] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_additional_uploads;
                    $location[2] = public_path() . "/uploads/documents/incomingDocuments/" . $name;

                    move_uploaded_file($opt, $location[2]);


                } elseif ($request->attach_incoming_document_additional_uploads == 'yes' && $letter->incoming_document_additional_uploads != null) {
                
                    $location[0] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_upload;
                    $location[1] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_additional_uploads;
                    $location[2] = '';
                

                } elseif ($request->hasFile('optional_uploads')) {
                
                    $opt = $request->file('optional_uploads');
                    $name = time() . rand(0, 9);
                    $extesnion = $request->file('optional_uploads')->getClientOriginalExtension();
                    $name .= '.' . $extesnion;
           
                    //optional uploads

                    $location[0] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_upload;
                    $location[1] = '';
                    $location[2] = public_path() . "/uploads/documents/incomingDocuments/" . $name;
                
                    move_uploaded_file($opt, $location[2]);

                } else {
                    
                    $location[0] = storage_path() . "/app/public/uploads/documents/incomingDocuments/" . $letter->incoming_document_upload;
                    $location[1] = '';
                    $location[2] = '';
            
                }
                $size = sizeOf($location);
           


            } elseif ($documentType == 'outgoing') {
       
                $letter = \App\Models\OutgoingDocument::with('institution')->with('user')->find($document_id);
           
                if ($request->receiver_email != null || $request->letter_subject != null) {

                  
                    $email = explode(',', $request->receiver_email);
                    $subject = $request->letter_subject;
                    if ($request->cc_email != null){
                        $ccemail = explode(',', $request->cc_email);
                      
                    }
                       
                    else {
                        $ccemail = '';
                    }


                } else {

                    $subject = 'test';
                    $ccemail = '';
                    $location = '';
                    $email = 'peace.shrizaa@gmail.com';

                }
                //document attachment
           
                $name = $letter->outgoing_registration_number . '-' . $subject;
                $fileLocation = public_path() .'/uploads/documents/outgoingDocuments';
  
                $pdf = $this->generatePDF($name, 'save', $fileLocation, 'outgoing', 1, $letter->id);
        
                //change the content of the letter replacing variable
                $letter['outgoing_document_content'] = $this->replaceVariableController->replaceVariable($letter->outgoing_document_content, 'outgoing', $letter->id, null, 'headerWithSignature');
                
             
                $location[0] = public_path() .'/uploads/documents/outgoingDocuments/' . $name . ".pdf";


                if ($request->attach_outgoing_file_uploads == 'yes' && $letter->outgoing_file_uploads != null && $request->hasFile('optional_uploads')) {
                
                    $location[1] = storage_path() . "/app/public/uploads/documents/outgoingDocuments/" . $letter->outgoing_file_uploads;
                    $opt = $request->file('optional_uploads');
                    $optionalImage = $letter->outgoing_registration_number . str_replace('/', '-', $letter->outgoing_letter_subject) . '.' . $opt->getClientOriginalExtension();
                    $location[2] = public_path() . "/uploads/documents/outgoingDocuments/" . $optionalImage;
                    move_uploaded_file($opt, $location[2]);


                } elseif ($request->attach_outgoing_file_uploads == 'yes' && $letter->outgoing_file_uploads != null) {
            
                    $location[1] = storage_path() . "/app/public/uploads/documents/outgoingDocuments/" . $letter->outgoing_file_uploads;
                    $location[2] = '';
                } elseif ($request->hasFile('optional_uploads')) {
               
                    $location[1] = '';
                    $opt = $request->file('optional_uploads');
                    $optionalImage = $letter->outgoing_registration_number . str_replace('/', '-', $letter->outgoing_letter_subject) . '.' . $opt->getClientOriginalExtension();
                    $location[2] = public_path() . "/uploads/documents/outgoingDocuments/" . $optionalImage;
                    move_uploaded_file($opt, $location[2]);


                } else {
               
                    $location[1] = '';
                    $location[2] = '';
                }
  
                $size = sizeOf($location);
             

            } else if ($documentType == 'digitized') {
                $letter = \App\Models\DigitizedDocument::find($document_id);
//                dd($document_id);

                $location = null;
                //for getting email id to send email

                if ($request->receiver_email != null || $request->letter_subject != null) {
                  
                    $email = explode(',', $request->receiver_email);
                    $subject = $request->letter_subject;
                    if ($request->cc_email != null)
                        $ccemail = explode(',', $request->cc_email);
                    else
                    
                        $ccemail = '';

                } else {
                    $email = self::findEmail($department_id, $request);
                    $subject = $letter->digitized_document_name;
                    $ccemail = '';
                }
                //document Attachment
                if ($letter->digitized_document_content && $letter->digitized_document_path == null && $request->hasFile('optional_uploads')) {
                    //document attachment
                    $name = $letter->digitized_document_name;
                    $fileLocation = public_path() . '/uploads/documents/digitizedDocuments/';
//                    $pdf = $this->generatePDF($name, 'save', $fileLocation, 'outgoing', 1, $letter->id);
                    $location[0] = public_path() . '/uploads/documents/digitizedDocuments/' . $name . ".pdf";


                    $opt = $request->file('optional_uploads');
                    $name = time() . rand(0, 9);
                    $extesnion = $request->file('optional_uploads')->getClientOriginalExtension();
                    $name .= '.' . $extesnion;
                    //optional uploads
                    $location[1] = '';
                    $location[2] = public_path() . "/uploads/documents/digitizedDocuments/" . $name;
                    move_uploaded_file($opt, $location[2]);
                } elseif ($letter->digitized_document_path != null && $request->hasFile('optional_uploads')) {
                    $location[0] = '';
                    $location[1] = storage_path() . "/app/public/uploads/documents/digitizedDocuments/" . $letter->digitized_docment_path;

                    $opt = $request->file('optional_uploads');
                    $name = time() . rand(0, 9);
                    $extesnion = $request->file('optional_uploads')->getClientOriginalExtension();
                    $name .= '.' . $extesnion;
                    $location[2] = public_path() . "/uploads/documents/digitizedDocuments/" . $name;
                    move_uploaded_file($opt, $location[2]);

                } elseif ($letter->digitized_document_path == null) {
                    $name = $letter->digitized_document_name;
                    $fileLocation = public_path() . '/uploads/documents/digitizedDocuments/';
                    $pdf = $this->generatePDF($name, 'save', $fileLocation, 'digitized', 0, $letter->id);
                    $location[0] = public_path() . '/uploads/documents/digitizedDocuments/' . $name . ".pdf";
                    $location[1] = '';
                    $location[2] = '';

                } else {
                    $location[0] = '';
                    $location[1] = storage_path() . "/app/public/uploads/documents/digitizedDocuments/" . $letter->digitized_document_path;
                    $location[2] = '';
                }

//                if ($request->hasFile('optional_uploads')) {
//                    $opt = $request->file('optional_uploads');
//                    $name = time() . rand(0, 9);
//                    $extesnion = $request->file('optional_uploads')->getClientOriginalExtension();
//                    $name .= '.' . $extesnion;
//                    //optional uploads
//                    $location[0] = storage_path() . "/app/public/uploads/documents/digitizedDocuments/" . $letter->digitized_docment_path;
////                    if ($letter->digitized_document_content && $letter->digitized_document_path==null) {
//                        $location[1] = '';
////                    }
//                    $location[2] = public_path() . "/uploads/documents/outgoingDocuments//" . $name;
//                    move_uploaded_file($opt, $location[2]);
//                }
//// else {
////
////                    $location[0] = storage_path() . "/app/public/uploads/documents/digitizedDocuments/" . $letter->digitized_docment_path;
////                    $location[1] = '';
////                    $location[2] = '';
////
////                }
///
///
                $size = sizeOf($location);

            }


            //get logoimage
            //$master_setting=\App\Models\MasterSetting::where()
            $website = \App\Models\MasterSetting::where('key_name', '_COMPANY_WEBSITE_')->first();
            $logo = \App\Models\MasterSetting::where('key_name', '_COMPANY_LOGO_')->first();

            $logoForEmail = $website->key_value . '/storage/uploads/company_assets/' . $logo->key_value;
         
            $mail = Mail::send('emails.mailInfo', ['letter' => $letter, 'logoForEmail' => $logoForEmail, 'documentType' => $documentType, 'request' => $request], function ($m) use ($letter, $subject, $ccemail, $bccemail, $location, $headers, $email, $size, $documentType, $logoForEmail, $request) {
      
                $m->to($email)->subject($subject);
                if ($ccemail != '') {
                    $m->cc($ccemail)->subject($subject);
           
                }
                if ($bccemail != '') {
                    $m->cc($bccemail)->subject($subject);
                
                }
                for ($i = 0; $i < $size; $i++) {
                    if ($location[$i] != '') {
                        $m->attach($location[$i]);
                      
                    }
                }

            });

            //unlink additional attachment while sending email
            if ($location[2] != '') {
                
                unlink($location[2]);
            }
            if ($documentType == 'outgoing') {
                if ($location[0] != '') {
              
                    unlink($location[0]);
                }
            }


            if ($mail < 0) {
                session()->flash('error', 'Error in sending email');
                return redirect()->back();


            } else

                if ($ccemail != '' && $bccemail != '')
                    $emails = array_unique(array_merge($email, $ccemail, $bccemail));
                elseif ($ccemail == '' && $bccemail != '')
                    $emails = array_unique(array_merge($email, $bccemail));
                elseif ($ccemail != '' && $bccemail == '')
                    $emails = array_unique(array_merge($email, $ccemail));
                else
                    $emails = $email;

            $this->saveEmailLog($emails, $document_id, $documentType, $department_id, $letter->institution->id, $request);

        
    }

//save email logs for all actions

    public function saveEmailLog($email, $document_id, $documentType, $department_id, $institution_id, $request)
    {
        $data['email_logs_address'] = serialize($email);
        $data['sender_user_id'] = Auth::user()->id;
        $data['email_logs_sent_date'] = date('Y-m-d');
        $data['email_logs_document_id'] = $document_id;
        $data['email_logs_document_type'] = $documentType;

        if ($documentType == 'incoming') {
            $data['institution_id'] = 0;

            //get email of department belog to department_id

            $emailFromDb = self::findEmail($department_id, $request);

            if (serialize($email) == serialize($emailFromDb)) {
                $data['department_id'] = $department_id;


            } else {
                $data['department_id'] = 0;
            }
        } elseif ($documentType == 'outgoing') {
            $data['department_id'] = 0;
            //here confusing

//            $emailFromDb = \App\Models\NameCard::with('institution')->find($institution_id);
            $emailFromDb = \App\Models\Institution::with('name_cards')->where('id', $institution_id)->select('institution_email_address')->first();

            foreach ($email as $mail) {

                if ($mail == $emailFromDb->institution_email_address) {
                    $data['institution_id'] = $institution_id;
                }
            }
//            if (serialize($email) == serialize()) {
//                dd('here');
//                $data['institution_id'] = $institution_id;
//
//
//            } else {
//                $data['institution_id'] = 0;
//            }

        } else {
//            $data['department_id'] = $department_id;


        }

//        dd($data);
        \App\Models\EmailLog::create($data);
//                if ($location[0] != '') {
//                    unlink($location[0]);
//                }

//        session()->flash('success', 'Mail Sent Successfully');
        return redirect()->back();


    }




    //$displayName name of the file,
    // $action for either to view download or save in folder,
    // $fileLocation to save where to save the document
    //$documentType for either letter, contract, minutes
    //$header 1 for print with header 0 for print without header
    //$letter_id for the letter content to be displayed
    public function generatePDF($displayName, $action, $fileLocation, $documentType, $header, $letter_id)
    {

        if ($documentType == 'outgoing') {

            $document = OutgoingDocument::find($letter_id);
            $template = Template::find($document->template_id);
      

        } elseif ($documentType == 'digitized') {
            $document = DigitizedDocument::find($letter_id);
            $template = Template::find($document->template_id);

        }
        $includeSignature = null;
      
        if ($header == 1 && $template->include_header == "yes") {
      
            PDF::setHeaderCallback(function ($pdf) {
                $assets = DB::table('master_settings')
                    ->where('key_name', '=', '_LETTER_HEADER_IMAGE_')
                    ->first();
             

                if ($assets->key_value != null) {
                    list($width, $height, $type, $attr) = getimagesize(storage_path('app/public/uploads/company_assets/' . $assets->key_value));
                    $pdf->Image(storage_path('app/public/uploads/company_assets/' . $assets->key_value), 0, 0, $height, 0, '', null);

                } else {
                
                    $pdf->Image(storage_path('app/public/uploads/company_assets/default_!!header.gif'), 0, 0, 210, 0, 'GIF', null);
                }
                $pdf->SetY(0);

                // Set font
                $pdf->SetFont('helvetica', 'B', 20);
                // Title


            });

            if ($template->include_footer == "yes") {

                PDF::setFooterCallback(function ($pdf) use ($document) {
                    $assets = DB::table('master_settings')
                        ->where('key_name', '=', '_LETTER_FOOTER_IMAGE_')
                        ->first();
                    if (isset($document->document_qr_code)) {

                        $pdf->Image(public_path('uploads/documents/outgoingDocuments/QR-Codes/' . base64_decode($document->document_qr_code)), 10, 274, 20, 0, '', null);

                    }
                    if ($assets->key_value != null) {

                        list($width, $height, $type, $attr) = getimagesize(storage_path('app/public/uploads/company_assets/' . $assets->key_value));


                        $pdf->Image(storage_path('app/public/uploads/company_assets/' . $assets->key_value), 105, 277, $height, 0, '', null);


                    } else {

                        $pdf->Image(storage_path('app/public/uploads/company_assets/default_!!footer.gif'), 105, 277, 100, 0, 'GIF', null);

                    }


                    $pdf->SetY(0);


                });
            }
            $includeSignature = 'headerWithSignature';

        }

        CustomTcpdf::setFontSubsetting(true);

        $assets = DB::table('master_settings')
            ->where('key_name', '=', '_DEFAULT_FONT_')
            ->first();
        if ($assets != null) {
            CustomTcpdf::setFont($assets->key_value, '', 12);
        } else {
            CustomTcpdf::setFont('Freeserif', '', 12);

        }

        CustomTcpdf::SetPrintHeader(true);
        CustomTcpdf::SetPrintFooter(true);

        CustomTcpdf::SetAutoPageBreak(TRUE, 30);

//        CustomTcpdf::SetMargins(20, 30, 20, true);
        CustomTcpdf::SetMargins(20, 40, 20, true);

        CustomTcpdf::AddPage('P', 'A4');
        if ($documentType == 'outgoing') {
            $stampImage = DB::table('master_settings')
                ->where('key_name', '=', '_LETTER_STAMP_IMAGE_')
                ->first();

         


            $item = \App\Models\OutgoingDocument::with('institution')->find($letter_id);
            $newContent = $this->replaceVariableController->replaceVariable($item->outgoing_document_content, 'outgoing', $item->id, 'pdf', $includeSignature);
       
//            $position=strpos($newContent,"<img src=",0);
//
//$newstr = substr_replace($newContent, '"{{public(',$position+9, 0);
//            $position=strpos($newstr,"alt=",0);
//
//            $newContent = substr_replace($newstr, ')}}"',$position, 0);
            CustomTcpdf::writeHTML(view('documents.pdf.letterPdf', compact('item', 'stampImage', 'newContent', 'includeSignature'))->render());


        } elseif ($documentType == 'digitized') {
            $item = \App\Models\DigitizedDocument::find($letter_id);

            CustomTcpdf::writeHTML(view('documents.pdf.letterPdf', compact('item', 'stampImage'))->render());


        } else {

        }
        CustomTcpdf::setTitle($displayName);
        if ($action == 'save' && $fileLocation != null) {
            //download pdf file and store in given location
            $user_id = Auth::user()->id;
            DocumentTrackTrait::createDocumentTrack($user_id, 'outgoing', $letter_id, 'download', date('Y-m-d'));
            $fileLocation = $fileLocation . "/" . $displayName . ".pdf";

            CustomTcpdf::Output($fileLocation, 'F');

        } elseif ($action == 'download') {
            //view file
            CustomTcpdf::output($displayName . '.pdf', 'D');
        } else {
            //view file
            CustomTcpdf::output($displayName . '.pdf', 'I');
        }


    }

    //findEmail by department id with super admin which is used in incoming letter email form
    public static function findEmail($department_id, $request)
    {
        if ($request->digitized_document_privacy == 'confidential' || $request->incoming_document_privacy == 'confidential' || $request->outgoing_document_privacy == 'confidential') {
            $users = $request->get('confidential-email');
            $user_ids = explode(',', $users);
            $count = count($user_ids);
            for ($i = 0; $i < $count; $i++) {
                $emails[] = DB::table('users')->where('id', '=', $user_ids[$i])->select('email')->get();
            }
            $emails = array_collapse($emails);
        } else {
            $emails = DB::table('departments')
                ->join('users', 'users.department_id', '=', 'departments.id')
                ->where('departments.id', '=', $department_id)
                ->where('user_status', '=', 'active')
                ->select('users.email')
                ->get();
        }
        $superAdmin = DB::table('users')
            ->where('users.user_group_id', '=', 1)
            ->where('user_status', '=', 'active')
            ->get();
        $sflag = 0;

        for ($i = count($superAdmin) - 1; $i >= 0; $i--) {
            $Semail[$i] = $superAdmin[$i]->email;
            if ($Semail[$i] == Auth::user()->email) {
                $sflag = '1';
            }


        }
        if ($sflag != 1) {
            $Semail[count($superAdmin)] = Auth::user()->email;
        }
//get email of same department
        $flag = 0;

        if (count($emails) == 0) {
            return $Semail;

        } else {

            for ($i = count($emails) - 1; $i >= 0; $i--) {
                $email[$i] = $emails[$i]->email;
                if ($email[$i] == Auth::user()->email) {
                    $flag = '1';
                }


            }
            if ($flag != 1) {
                $email[count($emails)] = Auth::user()->email;
            }

        }
        $email = array_unique(array_merge($Semail, $email));
        return $email;


    }
    //$filePath is the file which you want to zip array
    //mention the file which should be remove in first of the array
    //$fileName is the name of the zip file
    public function downloadZip($filePath, $fileName)
    {
      
        $zipper = new \Chumper\Zipper\Zipper;

        $zipper->make('uploads/temp/' . $fileName . '.zip')->add([$filePath]);


        $zipper->close();
        unlink($filePath[0]);

        return response()->download(public_path('uploads/temp/' . $fileName . '.zip'))->deleteFileAfterSend(true);

    }

    public function incomingDownloadZip($filePath, $fileName)
    {
        $zipper = new \Chumper\Zipper\Zipper;

        $zipper->make('uploads/temp/' . $fileName . '.zip')->add([$filePath]);

        $zipper->close();

        return response()->download(public_path('uploads/temp/' . $fileName . '.zip'))->deleteFileAfterSend(true);

    }

    public function documentPagination($document, $perPage)
    {
        $page = Input::get('page', 1);
        //Create a new Laravel collection from the array data
        $collection = new Collection($document);
        $collection = $collection->sortBy('id', SORT_NATURAL, 'desc');


//Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($page - 1) * $perPage, $perPage)->all();


//Create our paginator and pass it to the view
        $document = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

        return $document;
    }

    public function getEnglishDate($nepaliDate)
    {
        
        $englishDate = $this->calendarRepository->getEnglishDate($nepaliDate);
   
        if ($englishDate) {
            return $englishDate;
        }
        $list = '<span class="label label-danger">';
        $list .= 'The Nepali date is incorrect.';
        $list .= '</span>';
        return $list;
    }
}
