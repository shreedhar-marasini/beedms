<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\DigitizedDocument;
use App\Models\DocumentTrack;
use App\Models\IncomingDocument;
use App\Models\MasterSetting;
use App\Models\Notification;
use App\Models\OutgoingDocument;
use App\Repository\Roles\GroupRepository;
use App\Repository\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var GroupRepository
     */
    private $groupRepository;
    /**
     * @var User
     */
    private $user;

    public function __construct(UserRepository $userRepository, GroupRepository $groupRepository, User $user)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupList = $this->groupRepository->groupList();
        $users = $this->userRepository->all();
   
        
        $designationList = Designation::select('id', 'designation_name')->get();
        $departmentList = Department::select('id', 'department_name')->get();
        return view('users.index', compact('users', 'groupList', 'departmentList', 'designationList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserAddRequest $request)
    {
//        return $request->all();

        try {
       
            $password = str_random(6);
            $request['password'] = bcrypt($password);
            

            if (!empty($request->file('avatar_image'))) {
                $userAvatar = $request->file('avatar_image');
                $avatarExtension = $userAvatar->getClientOriginalExtension();
                $userAvatarName = 'avatar' . time() . '.' . strtolower($avatarExtension);
                $request['user_image'] = $userAvatarName;
                $avatarImageSuccess = true;
            }

            if (!empty($request->file('signature_image'))) {
                $userSignature = $request->file('signature_image');
                $signatureExtension = $userSignature->getClientOriginalExtension();
                $userSignatureName = 'sign' . time() . '.' . strtolower($signatureExtension);
                $request['user_signature'] = $userSignatureName;
                $signatureImageSuccess = true;
            }

            $user = $this->user->create($request->all());

            if ($user) {
                if (isset($avatarImageSuccess)) {
                    Storage::putFileAs('public/avatar', $userAvatar, $userAvatarName);
                    Image::make(storage_path() . '/app/public/avatar/' . $userAvatarName)->resize(128, 128)->save();
                }
          
                if (isset($signatureImageSuccess)) {
                    Storage::putFileAs('public/signature', $userSignature, $userSignatureName);
                    Image::make(storage_path() . '/app/public/signature/' . $userSignatureName)->resize(128, 128)->save();
                }
                if ($user)
         
                    Mail::send('emails.userCredential', ['userName' => $request->name, 'password' => $password], function ($m) use ($request) {
          
                        $m->to($request->email)->subject('User Access Information');
                    });
             
                session()->flash('success', 'User Successfully Created!');
                return back();

            } else {
                session()->flash('success', 'User could not be Create!');
                return back();
            }


        } catch (\Exception $e) {
       
            return $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $id = (int)$id;
            $edits = $this->userRepository->findById($id);
            if (count($edits) > 0) {
                $users = $this->userRepository->all();
                $designationList = Designation::select('id', 'designation_name')->get();
                $departmentList = Department::select('id', 'department_name')->get();
                $groupList = $this->groupRepository->groupList();

                return view('users.index', compact('users', 'edits', 'departmentList', 'designationList', 'groupList'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $user = $this->userRepository->findById($id);
            $oldValue = $this->userRepository->findById($id);

            if ($user) {
                if (!empty($request->file('avatar_image'))) {
                    $userAvatar = $request->file('avatar_image');
                    $avatarExtension = $userAvatar->getClientOriginalExtension();
                    $userAvatarName = 'avatar' . time() . '.' . strtolower($avatarExtension);
                    $request['user_image'] = $userAvatarName;
                    $avatarImageSuccess = true;
                }

                if (!empty($request->file('signature_image'))) {
                    $userSignature = $request->file('signature_image');
                    $signatureExtension = $userSignature->getClientOriginalExtension();
                    $userSignatureName = 'sign' . time() . '.' . strtolower($signatureExtension);
                    $request['user_signature'] = $userSignatureName;
                    $signatureImageSuccess = true;
                }

                $update = $user->fill($request->all())->save();
                if ($update) {
                    if (isset($avatarImageSuccess)) {
                        if ($oldValue->user_image != null)
                            @unlink(storage_path() . '/app/public/avatar/' . $oldValue->user_image);

                        Storage::putFileAs('public/avatar', $userAvatar, $userAvatarName);
                        Image::make(storage_path() . '/app/public/avatar/' . $userAvatarName)->resize(128, 128)->save();

                    }

                    if (isset($signatureImageSuccess)) {
                        $oldSignatureImage = DB::table('dms_outgoing_documents')
                          -> where('outgoing_document_content', 'like', '%'.$oldValue->user_signature.'%')

                            ->count();
                        if ($oldValue->user_signature != null && $oldSignatureImage==0)
                            @unlink(storage_path() . '/app/public/signature/' . $oldValue->user_signature);
                        Storage::putFileAs('public/signature', $userSignature, $userSignatureName);
                        Image::make(storage_path() . '/app/public/signature/' . $userSignatureName)->resize(128, 128)->save();
                    }
                    session()->flash('success', 'User Successfully updated!');
                    return redirect(route('user.index'));
                } else {
                    session()->flash('error', 'User could not be update!');
                    return back();
                }
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $user = $this->userRepository->findById($id);
            if ($user) {
                $userId = $user->id;
                $incoming = IncomingDocument::where('uploaded_by_user_id', $userId)->get();
                $digitized = DigitizedDocument::where('uploaded_by_user_id', $userId)->get();
                $outgoing = OutgoingDocument::where('created_by_user_id', $userId)->get();
                $notification = Notification::where('notification_user_id',$userId)->get();
                if (count($incoming) > 0 || count($digitized) > 0 || count($outgoing) > 0 || count($notification) > 0) {
                    session()->flash('error', 'Unable to delete!');
                    return back();
                }
                $user->delete();
                @unlink(storage_path() . '/app/public/avatar/' . $user->user_image);
                @unlink(storage_path() . '/app/public/signature/' . $user->user_signature);
                session()->flash('success', 'User successfully deleted!');
                return back();
            } else {
                session()->flash('error', 'User could not be delete!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }

    public function changeStatus($id, $type)
    {

        try {
            $id = (int)$id;
            $user = $this->userRepository->findById($id);
            if ($type == 'status') {
                if ($user->user_status == 'inactive') {
                    $user->user_status = 'active';
                    $user->save();
                    session()->flash('success', 'User Successfully Activated!');
                    return back();
                }
                $user->user_status = 'inactive';
                $user->save();
                session()->flash('success', 'Menu Successfully Deactivated!');
                return back();
            } elseif ($type == 'access') {
                if ($user->user_signature_allow_other == 'false') {
                    $user->user_signature_allow_other = 'true';
                    $user->save();
                    session()->flash('success', 'Menu Successfully Activated!');
                    return back();
                }
                $user->user_signature_allow_other = 'false';
                $user->save();
                session()->flash('success', 'Menu Successfully Deactivated!');
                return back();
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }

    }

    public function searchList()
    {
        $searchTerm = Input::get("q");
        $results = $this->userRepository->searchUser($searchTerm)->get();
        return response()->json($results);
    }

    public function profile(Request $request)
    {
        $userActivity = $this->userRepository->getUserActivity()->paginate(5);
        $activityDate = $this->userRepository->getActivityDate();
        $lastLogin = DB::table('user_log_tables')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->skip(1)->take(1)->value('created_at');
        $user = Auth::user();

        //uiPane
        $ui = MasterSetting::where('key_type', '=', 'color')->where('master_configuration_type', '=', 'ui')->where('key_name', '=', '_UI_SKIN_')->first();

        $masterSetting = MasterSetting::where('key_type', '=', 'radio')->where('master_configuration_type', '=', 'ui')->get();
        $user=User::find(Auth::user()->id);
        $skin=$user->_UI_SKIN_;



        return view('profile', compact('user', 'userActivity', 'activityDate', 'lastLogin','skin','masterSetting','ui'));
    }

    public function password(PasswordRequest $request)
    {
        if (Hash::check($request->input('old'), Auth::user()->password)) {
            $id = Auth::user()->id;
            $data = $this->user->find($id);
            if ($data) {
                $request['password'] = Hash::make($request->input('password'));
                $data->fill($request->all())->save();
                session()->flash('success', 'Password was changed successfully!');
                return redirect()->back();
            }
            session()->flash('error', 'Error Occoured!!!! Something is not right!');
            return redirect()->back()->withInput();
        }
        session()->flash('error', 'Error Occoured!!!! Old password incorrect!');
        return redirect()->back()->withInput();
    }

    public function profilePic(Request $request)
    {
        $user = Auth::user();
        if (!empty($request->file('user_image'))) {
            $userPicture = $request->file('user_image');
            $extension = $userPicture->getClientOriginalExtension();
            $userAvatar = 'profile' . time() . '.' . strtolower($extension);
            $request['user_image'] = $userAvatar;
            $avatarImageSuccess = true;
        }
        if (isset($avatarImageSuccess)) {
            if ($user->user_image != null) {
                @unlink(storage_path() . '/app/public/avatar/' . $user->user_image);
            }
            Storage::putFileAs('/public/storage/avatar', $userPicture, $userAvatar);
            Image::make(storage_path() . '/app/public/avatar/' . $userAvatar)->resize(128, 128)->save();
            $user->user_image = $userAvatar;
            $user->save();
        }
        return back();

    }
    public function uploadImage(Request $request)
    {

        $image = $request->image;

        list($type, $image) = explode(';', $image);

        list(, $image) = explode(',', $image);

        $image = base64_decode($image);

        $image_name = 'profile' . time() . '.png';

        $user = Auth::user();

        if ($user->user_image != null) {
            @unlink(storage_path() . '/app/public/avatar/' . $user->user_image);
        }
//            Storage::putFileAs('public/uploads/users/images/profilePic', $image, $userAvatar);
        $path = storage_path('app/public/avatar/'.$image_name);
        file_put_contents($path, $image);


        $user->user_image = $image_name;
        $user->save();


//        Storage::putFileAs('public/uploads/users/images/profilePic', $image, $image_name);
//
//
//

        return response()->json(['status' => true]);

    }
}
