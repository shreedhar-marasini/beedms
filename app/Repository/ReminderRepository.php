<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/7/17
 * Time: 5:22 PM
 */

namespace App\Repository;


use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;

class ReminderRepository
{
    /**
     * @var Reminder
     */
    private $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function getUser()
    {
        $getUser = Auth::user()->id;
        return $getUser;
    }

    public function all($request)
    {
        $reminders =   $this->reminder;
        $id = Auth::user()->id;
        $reminders = $this->reminder->where('reminder_user_id', $id)->orderBy('id','desc')->get();
       
        if ($request->has('reminder_title')) {
            $reminder_title = $request->reminder_title;
        
            $reminders =  $reminders->where('reminder_title','=', $reminder_title);
        
        }
        if ($request->has('document_type')) {
            $document_type = $request->document_type;
            $reminders =  $reminders->where('document_type','=', $document_type);
           
        }
        if ($request->has('reminder_to_email')) {
            $email = $request->reminder_to_email;
            $reminders =  $reminders->where('reminder_to_email','=', $email);
        }
 
        return $reminders;
    }

    public function findById($id)
    {
        $reminder = $this->reminder->find($id);
        return $reminder;
    }

}