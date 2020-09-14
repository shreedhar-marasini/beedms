<?php

namespace App\Http\Controllers;

use App\Models\DigitizedDocument;
use App\Models\DocumentComment;
use App\Models\DocumentTrack;
use App\Models\EmailLog;
use App\Models\IncomingDocument;
use App\Models\OutgoingDocument;
use App\Models\Reminder;
use App\Models\UserLogTable;
use App\User;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function reset()
    {
        $user = User::select('users.*')
                        ->where('users.email' ,'=', 'superadmin@youngminds.com.np')
                    ->first();
        $user1 = User::select('users.*')
                ->where('users.email' ,'=', 'admin@youngminds.com.np')
                ->first();
        
                    // ->where(['users.email' => 'srijan@youngminds.com.np',
                    // // 'users.email' => 'shristi@youngminds.com.np'])
    if(count($user) != null)
    {
            $reset1 = OutgoingDocument::where('created_by_user_id', '=', $user->id)->get();
         
            $reset2 = IncomingDocument::where('uploaded_by_user_id', '=', $user->id)->get();
            $reset3 = DigitizedDocument::where('uploaded_by_user_id', '=', $user->id)->get();
            $comments = DocumentComment::where('commented_by_user_id', '=', $user->id)->get();
            $documentTrack = DocumentTrack::where('document_access_user_id', '=', $user->id)->get();
            $emailLogs = EmailLog::where('sender_user_id', '=', $user->id)->get();
            $reminders = Reminder::where('reminder_user_id', '=', $user->id)->get();
           $userLog = UserLogTable::where('user_id', '=', $user->id)->get();  
           foreach($reset1 as $res)
           {
               if(count($res->outgoing_file_uploads) != null )
               {
                $arrayPhoto = json_decode($res->outgoing_file_uploads);
             
                    if(count($arrayPhoto) > 1)
                    {
               
                        foreach($arrayPhoto as $photo)
                        {
                            @unlink(storage_path() . '/app/public/uploads/documents/outgoingDocuments/' . $photo);
                        }
                         
        
                        $res->delete();   
                    }
                    else
                    {
                        @unlink(storage_path() . '/app/public/uploads/documents/outgoingDocuments/' . $res->outgoing_file_uploads);
                        $res->delete();
                    }
   
               
              
            }
            else
            {
          
                $res->delete();
            }
              
           }
           foreach($reset2 as $res)
           {
            if(count($res->incoming_document_upload) != null || count( $res->incoming_document_additional_uploads) )
            {
             $arrayPhoto = json_decode( $res->incoming_document_additional_uploads);
            
          
                 if(count($arrayPhoto) > 1)
                 {
            
                     foreach($arrayPhoto as $photo)
                     {
                         @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $photo);
                     }
                      
                     @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_upload);
                     $res->delete();   
                 }
                 else
                 {
                    @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_upload);
                     @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_additional_uploads);
                     $res->delete();
                 }

            
           
         }
         else
         {
       
             $res->delete();
         }
        }
   
           foreach($reset3 as $res)
           {
            if(count($res->digitized_document_path) != null  )
            {
               
                $arrayPhoto = json_decode( $res->digitized_document_path);
             
                if(count($arrayPhoto) >= 1)
                {
           
                    foreach($arrayPhoto as $photo)
                    {
                        @unlink(storage_path() . '/app/public/uploads/documents/digitizedDocuments/' . $photo);
                    }
                     
                   
                    $res->delete();   
                }

            }
               $res->delete();
           }
           foreach($comments as $res)
           {
               $res->delete();
           }
           foreach($documentTrack as $res)
           {
               $res->delete();
           }
           foreach($emailLogs as $res)
           {
               $res->delete();
           }
           foreach($reminders as $res)
           {
               $res->delete();
           }
           foreach($userLog as $res)
           {
               $res->delete();
           }
 
    }
    if(count($user1) != null)
    {

         $reset1 = OutgoingDocument::where('created_by_user_id', '=', $user1->id)->get();
    
         $reset2 = IncomingDocument::where('uploaded_by_user_id', '=', $user1->id)->get();
         $reset3 = DigitizedDocument::where('uploaded_by_user_id', '=', $user1->id)->get();
      
         $comments = DocumentComment::where('commented_by_user_id', '=', $user1->id)->get();
         $documentTrack = DocumentTrack::where('document_access_user_id', '=', $user1->id)->get();
         $emailLogs = EmailLog::where('sender_user_id', '=', $user1->id)->get();
         $reminders = Reminder::where('reminder_user_id', '=', $user1->id)->get();
        $userLog = UserLogTable::where('user_id', '=', $user1->id)->get();   
        foreach($reset1 as $res)
        {
            if(count($res->outgoing_file_uploads) != null )
            {
             $arrayPhoto = json_decode($res->outgoing_file_uploads);
          
                 if(count($arrayPhoto) > 1)
                 {
            
                     foreach($arrayPhoto as $photo)
                     {
                         @unlink(storage_path() . '/app/public/uploads/documents/outgoingDocuments/' . $photo);
                     }
                      
     
                     $res->delete();   
                 }
                 else
                 {
                     @unlink(storage_path() . '/app/public/uploads/documents/outgoingDocuments/' . $res->outgoing_file_uploads);
                     $res->delete();
                 }

            
           
         }
         else
         {
       
             $res->delete();
         }
           
        }
        foreach($reset2 as $res)
        {
         if(count($res->incoming_document_upload) != null || count( $res->incoming_document_additional_uploads) )
         {
          $arrayPhoto = json_decode( $res->incoming_document_additional_uploads);
         
       
              if(count($arrayPhoto) > 1)
              {
         
                  foreach($arrayPhoto as $photo)
                  {
                      @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $photo);
                  }
                   
                  @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_upload);
                  $res->delete();   
              }
              else
              {
                 @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_upload);
                  @unlink(storage_path() . '/app/public/uploads/documents/incomingDocuments/' . $res->incoming_document_additional_uploads);
                  $res->delete();
              }

         
        
      }
      else
      {
    
          $res->delete();
      }
     }

        foreach($reset3 as $res)
        {
         if(count($res->digitized_document_path) != null  )
         {
            
             $arrayPhoto = json_decode( $res->digitized_document_path);
          
             if(count($arrayPhoto) >= 1)
             {
        
                 foreach($arrayPhoto as $photo)
                 {
                     @unlink(storage_path() . '/app/public/uploads/documents/digitizedDocuments/' . $photo);
                 }
                  
                
                 $res->delete();   
             }

         }
            $res->delete();
        }
        foreach($comments as $res)
        {
            $res->delete();
        }
        foreach($documentTrack as $res)
        {
            $res->delete();
        }
        foreach($emailLogs as $res)
        {
            $res->delete();
        }
        foreach($reminders as $res)
        {
            $res->delete();
        }
        foreach($userLog as $res)
        {
            $res->delete();
        }
    }

        
    
       return redirect('/dashboard');
        
        

    }
}
