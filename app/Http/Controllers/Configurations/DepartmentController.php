<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\DepartmentRequest;
use App\Models\Department;
use App\Models\DigitizedDocument;
use App\Models\IncomingDocument;
use App\Models\OutgoingDocument;
use App\Repository\Configuration\DepartmentRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        parent::__construct();
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $departments = $this->departmentRepository->all();
        return view('configurations.departments.index', compact('departments'));
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
    public function store(DepartmentRequest $request)
    {
        try{
            $create=Department::create($request->all());
            if($create){
                session()->flash('success','Department successfully created!');
                return back();
            }else{
                session()->flash('error','Department could not be created!');
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
            $edits = $this->departmentRepository->findById($id);
            if(count($edits)>0)
            {
                $departments = $this->departmentRepository->all();
               return view('configurations.departments.index', compact('edits','departments'));
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
    public function update(DepartmentRequest $request, $id)
    {
        $id = (int)$id;
        try{
            $department = $this->departmentRepository->findById($id);
            if($department){
                $department->fill($request->all())->save();
                session()->flash('success','Department updated successfully!');

                return redirect(route('department.index'));
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
            $value = $this->departmentRepository->findById($id);

            if($value){
                $valueId = $value->id;
                $digitized = DigitizedDocument::where('department_id',$valueId)->get();
                $incoming = IncomingDocument::where('receiver_department_id',$valueId)->get();
                $user = User::where('department_id',$valueId)->get();

                if(count($incoming)>0 || count($digitized)>0 || count($user)>0)
                {
                    session()->flash('error','Department is in use. Unable to delete this Department!');
                    return back();
                }
                $value->delete();
                session()->flash('success','Department successfully deleted!');
                return back();
            }else{
                session()->flash('error','Department could not be deleted!');
                return back();
            }

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }
}
