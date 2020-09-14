<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\FiscalYearRequest;
use App\Models\FiscalYear;
use App\Repository\Configuration\FiscalYearRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FiscalYearController extends BaseController
{
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;
    /**
     * @var FiscalYear
     */
    private $fiscalYear;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(FiscalYearRepository $fiscalYearRepository, FiscalYear $fiscalYear)
    {
        parent::__construct();
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->fiscalYear = $fiscalYear;
    }


    public function index()
    {

        $fiscalYears = $this->fiscalYearRepository->all();
        
        return view('configurations.fiscalYears.index', compact('fiscalYears'));
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
    public function store(FiscalYearRequest $request)
    {
        try{
            $name = $request->fy_start_date;
            $create=FiscalYear::create($request->all());
            if($create){
                session()->flash('success','Fiscal Year successfully created!');
                return back();
            }else{
                session()->flash('error','Fiscal Year could not be created!');
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
            $edits = $this->fiscalYearRepository->findById($id);
            if(count($edits)>0)
            {
                $fiscalYears = $this->fiscalYearRepository->all();
                return view('configurations.fiscalYears.index', compact('edits','fiscalYears'));
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
    public function update(FiscalYearRequest $request, $id)
    {
        $id = (int)$id;
        try{
            $fiscalYear = $this->fiscalYearRepository->findById($id);
            if($fiscalYear){
                $fiscalYear->fill($request->all())->save();
                session()->flash('success','Fiscal Year updated successfully!');

                return redirect(route('fiscalYear.index'));
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

            $data= $this->fiscalYearRepository->checkRelation($id);
            $datas= $this->fiscalYearRepository->checkRelation2($id);

                if(count($data) == null || count($datas)== null)
                {
                   
                    FiscalYear::destroy($id);
                    session()->flash('success','Fiscal Year successfully deleted!');
                    return back();
                }
      
               
           else{
                session()->flash('error','Fiscal Year could not be deleted as it has been used!');
                return back();
            }
         
   
    }

    public function status($id)
    {
        $id = (int)$id;
          try{
             $fiscalYear = $this->fiscalYear->where('id','<>',$id)
                 ->update(['fy_status' => 'inactive']);
              $fiscalYear = $this->fiscalYear->where('id',$id)
                  ->update(['fy_status'=>'active']);

              session()->flash('status', 'Fiscal Year Status Updated!');

              return back();
          }
          catch(\Exception $e){
              $exception=$e->getMessage();
              session()->flash('error','EXCEPTION'.$exception);
              return back();
          }
    }
}
