<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Repository\Institution\InstitutionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ToolController extends BaseController
{
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;

    public function __construct(InstitutionRepository $institutionRepository)
    {

        $this->institutionRepository = $institutionRepository;
    }

    public function index()
    {
        $institutionList = $this->institutionRepository->lists();
        return view('tools.index', compact('institutionList'));
    }

    public function institutionStore(Request $request)
    {
        if (Input::hasFile('institution')) {
            $path = Input::file('institution')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count() > 0) {
                foreach ($data as $key => $value) {

                    $name = $value->institution_name;
                    $insert = [
                        'institution_name' => $value->institution_name,
                        'institution_address' => $value->institution_address,
                        'institution_email_address' => $value->institution_email_address,
                        'institution_contact_number' => $value->institution_contact_number,
                        'institution_website' => $value->institution_website,
                        'institution_pan_number' => $value->institution_pan_number
                    ];

                    if (!empty($insert)) {
                        $value = Institution::where('institution_name', $name)->get();
                        if (count($value) < 1) {
                            DB::table('dms_institutions')->insert($insert);
                        }
                    }
                }
                session()->flash('success', 'Institutions imported successfully!');
                return back();
            }
        }

        session()->flash('error', 'Field is Empty!');
        return back();
    }

    public function namecardStore(Request $request)
    {
        $institution = $request->institution_id;
        if (Input::hasFile('namecard')) {
            $path = Input::file('namecard')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count() > 0) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'institution_id' => $institution,
                        'name_card_person' => $value->name_card_person,
                        'name_card_address' => $value->name_card_address,
                        'name_card_designation' => $value->name_card_designation,
                        'name_card_email_address1' => $value->name_card_email_address1,
                        'name_card_email_address2' => $value->name_card_email_address2,
                        'name_card_contact_number1' => $value->name_card_contact_number1,
                        'name_card_contact_number2' => $value->name_card_contact_number2,
                        'business_card' => $value->business_card
                    ];
                }
                if (!empty($insert)) {
                    DB::table('dms_name_cards')->insert($insert);
                    session()->flash('success', 'Namecard imported successfully!');
                    return back();
                }
            }
        }
        session()->flash('error', 'File is Empty!');
        return back();
    }

    public function departmentStore(Request $request)
    {
        if (Input::hasFile('department')) {
            $path = Input::file('department')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count() > 0) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'department_name' => $value->department_name,
                        'department_short_name' => $value->department_short_name
                    ];
                }
                if (!empty($insert)) {
                    DB::table('departments')->insert($insert);
                    session()->flash('success', 'Department imported successfully!');
                    return back();
                }
            }
        }
        session()->flash('error', 'File is Empty!');
        return back();
    }

    public function designationStore(Request $request)
    {
        if (Input::hasFile('designation')) {
            $path = Input::file('designation')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count() > 0) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'designation_name' => $value->designation_name,
                        'designation_short_name' => $value->designation_short_name
                    ];
                }
                if (!empty($insert)) {
                    DB::table('designations')->insert($insert);
                    session()->flash('success', 'Designation imported successfully!');
                    return back();
                }
            }
        }
        session()->flash('error', 'File is Empty!');
        return back();
    }


}
