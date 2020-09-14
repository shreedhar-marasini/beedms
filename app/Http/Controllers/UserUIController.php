<?php

namespace App\Http\Controllers;

use App\Models\MasterSetting;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserUIController extends Controller
{
    public function index()
    {
        $ui = MasterSetting::where('key_type', '=', 'color')->where('master_configuration_type', '=', 'ui')->where('key_name', '=', '_UI_SKIN_')->first();

        $masterSetting = MasterSetting::where('key_type', '=', 'radio')->where('master_configuration_type', '=', 'ui')->get();
        $user=User::find(Auth::user()->id);
        $skin=$user->_UI_SKIN_;
        return view('users.ui.index', compact('masterSetting','skin','user'));
    }
    public function changeSkin($skin)
    {
   
        $masterSetting = User::where('id', '=', Auth::user()->id)->update(['_UI_SKIN_' => $skin]);
      
        return back();

    }

    public function changeLayout($key_name, $value)
    {
       
        $data = User::where('id', '=', Auth::user()->id)
            ->first();

        if ($data[$key_name] == 1) {
//            if ($data->key_name == "_TOGGLE_SIDEBAR_" && $data->key_value == 1 || $data->key_name == "_SIDEBAR_EXPAND_ON_HOVER_" && $data->key_value == 1) {
//                $data = MasterSetting::where('key_name', '=', "_SIDEBAR_EXPAND_ON_HOVER_")
//                    ->update(['key_value' => 0]);
//                $data = MasterSetting::where('key_name', '=', "_TOGGLE_SIDEBAR_")
//                    ->update(['key_value' => 0]);
//            } else
            $data = User::where('id', '=', Auth::user()->id)
                ->update([$key_name => '0']);
        } else {
//            if ($data->key_name == "_TOGGLE_SIDEBAR_" && $data->key_value == 0 || $data->key_name == "_SIDEBAR_EXPAND_ON_HOVER_" && $data->key_value == 0) {
//                $data = MasterSetting::where('key_name', '=', "_SIDEBAR_EXPAND_ON_HOVER_")
//                    ->update(['key_value' => 1]);
//                $data = MasterSetting::where('key_name', '=', "_TOGGLE_SIDEBAR_")
//                    ->update(['key_value' => 1]);
//            } else

            $data = User::where('id', '=', Auth::user()->id)
                ->update([$key_name => '1']);

        }
    }
    public function clearUi(){
        $user=User::where('id','=',Auth::user()->id);
        $user = User::where('id', '=', Auth::user()->id)
            ->update(['_UI_SKIN_' => '',
            '_FIXED_LAYOUT_'=>'0',
        '_BOXED_LAYOUT_'=>'0',
        '_TOGGLE_SIDEBAR_'=>'0']);
        return back();
    }
    
}
