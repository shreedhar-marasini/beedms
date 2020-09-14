<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Models\MasterSetting;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UIController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $ui = MasterSetting::where('key_type', '=', 'color')->where('master_configuration_type', '=', 'ui')->where('key_name', '=', '_UI_SKIN_')->first();
        $masterSetting = MasterSetting::where('key_type', '=', 'radio')->where('master_configuration_type', '=', 'ui')->get();
        return view('configurations.ui.index', compact('masterSetting','ui'));
    }

    public function changeSkin($skin)
    {
    $masterSetting = MasterSetting::where('key_type', '=', 'color')->where('key_name', '=', '_UI_SKIN_')->update(['key_value' => $skin]);
        return redirect('configurations/ui');

    }

    public function changeLayout($key_name, $value)
    {
        $data = MasterSetting::where('key_name', '=', $key_name)
            ->first();
        if ($data->key_value == 1) {
//            if ($data->key_name == "_TOGGLE_SIDEBAR_" && $data->key_value == 1 || $data->key_name == "_SIDEBAR_EXPAND_ON_HOVER_" && $data->key_value == 1) {
//                $data = MasterSetting::where('key_name', '=', "_SIDEBAR_EXPAND_ON_HOVER_")
//                    ->update(['key_value' => 0]);
//                $data = MasterSetting::where('key_name', '=', "_TOGGLE_SIDEBAR_")
//                    ->update(['key_value' => 0]);
//            } else
                $data = MasterSetting::where('key_name', '=', $key_name)
                    ->update(['key_value' => 0]);
        } else {
//            if ($data->key_name == "_TOGGLE_SIDEBAR_" && $data->key_value == 0 || $data->key_name == "_SIDEBAR_EXPAND_ON_HOVER_" && $data->key_value == 0) {
//                $data = MasterSetting::where('key_name', '=', "_SIDEBAR_EXPAND_ON_HOVER_")
//                    ->update(['key_value' => 1]);
//                $data = MasterSetting::where('key_name', '=', "_TOGGLE_SIDEBAR_")
//                    ->update(['key_value' => 1]);
//            } else

                $data = MasterSetting::where('key_name', '=', $key_name)
                    ->update(['key_value' => 1]);
        }
    }

}
