<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Models\MasterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $masterSetting = MasterSetting::where('master_configuration_type', '!=', 'ui')->orderBy('key_display_order','asc')->get();
        return view('configurations.branding.index', compact('masterSetting'));

    }

    public function store(Request $request)
    {
//        dd('here');
        $masterSetting = MasterSetting::all();
        foreach ($masterSetting as $name) {
            $key_name = $name->key_name;
            //check either file or text
            $check = MasterSetting::where('key_name', '=', $key_name)->first();

            if ($check->key_type == "file") {


                if (!empty($request->file($key_name))) {
                    if ($check->key_value != null) {
                        @unlink(storage_path() . '/app/public/uploads/company_assets/' . $check->key_value);
                    }
                    $brandingFile = $request->file($key_name);
                    $documentExtension = $brandingFile->getClientOriginalExtension();
                    $brandingFileName = 'branding' . time() . '.' . strtolower($documentExtension);
                    $file_uploads = true;

                    $update = MasterSetting::where('key_name', '=', $key_name)
                        ->update(['key_value' => $brandingFileName]);


                    if (isset($file_uploads)) {

                        Storage::putFileAs('public/uploads/company_assets/', $brandingFile, $brandingFileName);
                    }

                }


            } else {
                if ($key_name != '__GOOGLE_CALENDER_IFRAME__') {
                    if($request->_EMAIL_PASSWORD_==''){
                        $items = MasterSetting::where('key_name', '=', $key_name)
                            ->update(['key_value' => $check->key_value]);
                    }
                    else
                    $items = MasterSetting::where('key_name', '=', $key_name)
                        ->update(['key_value' => $request->$key_name]);
                }
            }
            $serviceAct = MasterSetting::where('key_name', '=', '__GOOGLE_CALENDER_SERVICE_ACCOUNT__')->first();
            if ($serviceAct->key_value != null) {
                $file = fopen('ServiceAccount.json', 'w+');
                fwrite($file, $serviceAct->key_value);
                fclose($file);
            }

        }
        session()->flash('success', 'Successfully updated');
        return redirect('configurations/branding');

    }
}
