<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 7/27/17
 * Time: 4:21 PM
 */

namespace App\Repository;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;


class UserRepository
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function all()
    {
        $users = $this->user->orderBy('name', 'asc')->get();
        return $users;

    }

    public function userList()
    {
        $users = $this->user
            ->select('id', 'name')
            ->orderBy('id', 'DESC')
            ->get();
        return $users;
    }

    public function findById($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function findByUser($id)
    {
        return $this->user->select('id', 'name')->find($id);
    }

    public function signatureAllowOtherList()
    {
        $users = $this->user
            ->select('id', 'name')
            ->where('user_signature_allow_other', '=', 'true')
            ->orWhere('id', '=', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        return $users;
    }

    //this function is use to insert into notification table in creating updating document
    public function getAllUsersId()
    {
        $users = $this->user
            ->where('user_status', '=', 'active')
            ->select('id')
            ->get();
        foreach ($users as $user) {
            if (Auth::user()->id != $user->id)
                $id[] = $user->id;
        }
        return $id;
    }

    //this function is use to insert into notification table in creating updating document
    public function getAllDepartmentUsersId($department_id)
    {

        $users = $this->user
            ->where('user_status', '=', 'active')
            ->where('department_id', '=', $department_id)
            ->orwhere('user_group_id', '=', 1)
            ->where('id', '!=', Auth::user()->id)
            ->select('id')
            ->get();
        foreach ($users as $user) {
            if (Auth::user()->id != $user->id)
                $id[] = $user->id;
        }
        return $id;
    }

    //confidential part left
    public function getConfidentialUserId($userId)
    {
        $users = $this->user
            ->where('id', '=', $userId)
            ->get();
        foreach ($users as $user) {
            if (Auth::user()->id != $user->id)
                $id[] = $user->id;
        }

        return $id;
    }

    public function searchUser($searchTerm)
    {
        $user = $this->user->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
        return $user;

    }

    /*
         Create VIEW v_user_activity as SELECT id as document_id, 'incoming' as document_type , uploaded_by_user_id as user_id ,'incoming'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, deleted_at as deleted_date FROM dms_incoming_documents UNION

 SELECT id as document_id, 'outgoing' as document_type , created_by_user_id as user_id, 'outgoing'as activity_type , created_at as created_at, issued_by as issued_by_user_id, signature_user_id as signed_by_user_id, deleted_at as deleted_date FROM dms_outgoing_documents UNION

 SELECT id as document_id, 'digitized' as document_type , uploaded_by_user_id as user_id, 'digitized'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id , deleted_at as deleted_date FROM dms_digitized_documents UNION

    SELECT email_logs_document_id as document_id, email_logs_document_type as document_type , sender_user_id as user_id ,'email'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id ,NULL as deleted_date FROM dms_email_logs UNION

    SELECT documents_id as document_id, document_comments_type as document_type , commented_by_user_id as user_id ,'comments'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_comments UNION

    SELECT tracks_document_id as document_id, tracks_document_type as document_type , document_access_user_id as user_id ,'tracks'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_tracks UNION

      SELECT document_id as document_id, document_type as document_type , reminder_user_id as user_id ,'reminder'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_reminders

    */


    public function getUserActivity()
    {
        $user_id = Auth::user()->id;
        $userActivity = DB::table('v_user_activity')->where('user_id', $user_id)->where('deleted_date', null)->orderBy('created_at', 'desc');
//        $userActivity = DB::select('select * from v_user_activity where user_id =' . $user_id . ' and deleted_date is NULL order by created_at desc');
        return $userActivity;

    }

    public function getCurrentUserActivity()
    {
        if (User::isSuperAdmin()) {
            $currentUserActivity = DB::select('select * from v_user_activity where user_id =' . $user_id . ' and deleted_date is NULL order by created_at desc');

        } else {
            $currentUserActivity = DB::select('select * from v_user_activity where user_id =' . $user_id . ' and deleted_date is NULL order by created_at desc');
        }
        return $currentUserActivity;
    }

    public function online()
    {
        $users = Self::userList();
       
        $now = Carbon::now();
        $user_id = Auth::user()->id;
        $users = DB::table('users')->where('last_online', '>=', $now)->where('id', '!=', $user_id)->get();
        if (count($users) > 0) {
            foreach ($users as $user) {
                $username[] = $user;
            }
            return $username;
        }
    }

    public function getActivityDate()
    {
        $userId = Auth::user()->id;
        $activityDate = DB::select("SELECT DISTINCT( created_at) FROM `v_user_activity` where user_id= $userId  AND deleted_date is NULL ORDER by created_at desc");
        return $activityDate;
    }

}