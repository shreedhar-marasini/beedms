<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Roles\GroupRequest;
use App\Models\UserGroup;
use App\Repository\Roles\GroupRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends BaseController
{
    /**
     * @var UserGroup
     */
    private $userGroup;
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct(UserGroup $userGroup,GroupRepository $groupRepository)
    {
        parent::__construct();
        $this->userGroup = $userGroup;
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups=$this->groupRepository->all();

        return view('roles.groups.index',compact('groups'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {

        try{
            $create=$this->userGroup->create($request->all());

            if($create){
                session()->flash('success','Group successfully created');
                return back();
            }else{
                session()->flash('error','Group couldnot be created');
                return back();
            }
        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $id=(int)$id;
            $edits=$this->groupRepository->findById($id);
            if(count($edits)>0){
                $groups=$this->groupRepository->all();

                return view('roles.groups.index',compact('groups','edits'));
            }else{
                session()->flash('error','Id could not be obtained');
                return back();
            }

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION :'.$exception);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        $id=(int)$id;
        try{
            $menu=$this->groupRepository->findById($id);
            if($menu){
                $menu->fill($request->all())->save();
                session()->flash('success','Group updated successfully');

                return redirect(route('group.index'));
            }else{

                session()->flash('error','No record with given id');
                return back();
            }
        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION:'.$exception);
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=(int)$id;
        try{

            if($this->userGroup->destroy($id)){
                session()->flash('success','Group successfully deleted');
                return back();
            }else{
                session()->flash('error','Group could not be deleted');
                return back();
            }

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }
}
