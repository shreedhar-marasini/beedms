<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\DesignationRequest;
use App\Models\Designation;
use App\Repository\Configuration\DesignationRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $designationRepository;

    public function __construct(DesignationRepository $designationRepository)
    {
        parent::__construct();

        $this->designationRepository = $designationRepository;
    }

    public function index()
    {
        $designations = $this->designationRepository->all();
        return view('configurations.designations.index', compact('designations'));
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
    public function store(DesignationRequest $request)
    {
        try{
            $create=Designation::create($request->all());
            if($create){
                session()->flash('success','Designation successfully created!');
                return back();
            }else{
                session()->flash('error','Designation could not be created!');
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
            $id = (int)$id;
            $edits = $this->designationRepository->findById($id);
            if(count($edits)>0)
            {
                $designations = $this->designationRepository->all();
                return view('configurations.designations.index', compact('edits','designations'));
            }
            else{
                session()->flash('error','Id could not be obtained!');
                return back();
            }

        }catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationRequest $request, $id)
    {
        $id = (int)$id;
        try{
            $designation = $this->designationRepository->findById($id);
//            return $designation;
            if($designation){
                $designation->fill($request->all())->save();
//                return $designation;
                session()->flash('success','Designation updated successfully!');

                return redirect(route('designation.index'));
            }else{

                session()->flash('error','No record with given id!');
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
            $value = $this->designationRepository->findById($id);

            if($value){
                $valueId = $value->id;
                $user = User::where('designation_id',$valueId)->get();

                if(count($user)>0)
                {
                    session()->flash('error','Designation is in use. Unable to delete!');
                    return back();
                }
                $value->delete();
                session()->flash('success','Designation successfully deleted!');
                return back();
            }else{
                session()->flash('error','Designation could not be deleted!');
                return back();
            }

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }
}
