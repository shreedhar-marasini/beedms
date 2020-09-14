<?php

namespace App\Http\Controllers\Documents;

use App\Models\Institution;
use App\Models\MasterSetting;
use App\Models\OutgoingDocument;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;

class ReplaceVariableController extends Controller
{

    public function replaceVariable($content, $documentType, $documentId, $flag = 'preview', $includeSignature = null)
    {
        
   
        $date = date('Y-m-d');
        $mycontent = $this->templateParse($content, '__TODAY_DATE__', $date);
        //for company stamp image
        $stamp_image = MasterSetting::where('key_name', '=', '_LETTER_STAMP_IMAGE_')->select('key_value')->first();

        if ($flag == "pdf") {
            $storageUrl = url('http://localhost:8000/storage/uploads/company_assets/' . $stamp_image->key_value);
      
        } else {
            $storageUrl = url('http://localhost:8000/storage/uploads/company_assets/' . $stamp_image->key_value);
        } 
     
        $image = '<img src="' . $storageUrl . '" alt=\"No Image\">';

        if ($includeSignature == 'headerWithSignature' || $flag == 'preview' || true) {
            $mycontent = str_replace('__SCANNED_COMPANY_STAMP__', $image, $mycontent);
       
        } else {
            $space = '<div style=\"height: 80px\"><br><br> </div>';
            $mycontent = str_replace('__SCANNED_COMPANY_STAMP__', $space, $mycontent);
        }

        if ($documentType == 'outgoing') {
            $document = OutgoingDocument::find($documentId);
            if ($document != null) {
                $signatureContent = User::where('id', '=', $document->signature_user_id)->first();
                if ($signatureContent != null) {
                 $mycontent = $this->templateParse($mycontent, '__SIGNATURE_CONTENT__', nl2br($signatureContent->user_signature_content));
               
                }
                $storageUrl =url('http://localhost:8000/storage/signature/' .$signatureContent->user_signature);
                $image = ' <img src="' . $storageUrl . '" alt="No Image">';
                if ($includeSignature == 'headerWithSignature' || $flag == 'preview') {   
                    $mycontent = str_replace('__SCANNED_SIGNATURE__', $image, $mycontent);       
                } else {
                    $space = '<div style=\"height: 80px\"><br><br> </div>';
                    $mycontent = str_replace('__SCANNED_SIGNATURE__', $space, $mycontent);
                }


                if ($document->outgoing_issue_status == 'issued') {
                    $mycontent = $this->templateParse($mycontent, '__ISSUE_DATE__', $document->outgoing_issue_date);
                }
                $mycontent = $this->templateParse($mycontent, '__DEPARTMENT_NAME__', $document->department_name);
                $mycontent = $this->templateParse($mycontent, '__RECEIVER_INSTITUTION__', $document->institution->institution_name);
                $mycontent = $this->templateParse($mycontent, '__RECEIVER_ADDRESS__', $document->institution->institution_address);

                $mycontent = $this->templateParse($mycontent, '__DOCUMENT_SUBJECT__', $document->outgoing_document_subject);
                $mycontent = $this->templateParse($mycontent, '__DATE__', $document->outgoing_document_date);
                $mycontent = $this->templateParse($mycontent, '__SIGNATURE_CONTENT__', $signatureContent->user_signature_content);

                if ($flag == "pdf") {
                    if ($includeSignature == 'headerWithSignature') {
             
                        $storageUrl = url('http://localhost:8000/storage/signature/'.$signatureContent->user_signature);
                     
                    } else {
                        $storageUrl = null;
                    }
                } else {
                    $storageUrl = url('http://localhost:8000/storage/signature/'.$signatureContent->user_signature);
                }
    
                //$storageUrl='/var/www/html/dms/public/storage/signature/sign1509086758.png';

               
                if ($includeSignature == 'headerWithSignature' || $flag == 'preview' ) {

                    $image = ' <img src=' . $storageUrl . ' alt="No Image">';
                    $image = '<img src="' . $storageUrl . ' alt=\"No Image\">';
                    $mycontent = str_replace('__SCANNED_SIGNATURE__', $image, $mycontent);
                    
                } else {
                    $space = '<div style=\"height: 80px\"><br><br> </div>';
                    $mycontent = str_replace('__SCANNED_SIGNATURE__', $space, $mycontent);
                }
            

            }
      
            if ($document->outgoing_issue_status == 'issued') {
                $mycontent = $this->templateParse($mycontent, '__ISSUE_DATE__', $document->outgoing_issue_date);
                $mycontent = $this->templateParse($mycontent, '__ISSUE_NUMBER__', $document->outgoing_issue_number);
            }
            //if the document is print without header and footer and without any signature stamp or any images
            // if ($includeSignature == null) {
            //     $space = '<div style=\"height: 80px\"><br><br> </div>';
            //     $mycontent = preg_replace('/(<)([img])(\w+)([^>]*>)/', $space, $mycontent);
            // }
       
            $mycontent = $this->templateParse($mycontent, '__DEPARTMENT_NAME__', $document->department_name);
            $mycontent = $this->templateParse($mycontent, '__RECEIVER_INSTITUTION__', $document->institution->institution_name);
            $mycontent = $this->templateParse($mycontent, '__RECEIVER_ADDRESS__', $document->institution->institution_address);
            $mycontent = $this->templateParse($mycontent, '__RECEIVER_INSTITUTION_DEPARTMENT__', $document->department_name);


            $mycontent = $this->templateParse($mycontent, '__DOCUMENT_SUBJECT__', $document->outgoing_document_subject);
            $mycontent = $this->templateParse($mycontent, '__DOCUMENT_DATE__', $document->outgoing_document_date);
       

        } else {

        }

        return $mycontent;


    }

    public function templateParse($content, $find, $replace)
    {

        $new_content = str_replace($find, $replace, $content);
        return $new_content;
    }
}


