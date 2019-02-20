<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    /*
     * Configurations
     */
    public function configuration(){
        return view('admin.configuration',array('configuration' => Configuration::all()) );
    }

    public function configurationSave(Request $request){
        $arrConfigs = $request->input('config');

        foreach ($arrConfigs as $key => $value) {
            # code...
            $config = Configuration::where('name',$key)->update(
                array( 'config_value' => $value)
            );

        }

        return view('admin.configuration',array('configuration' => Configuration::all()) )
            ->with('status', 'Lưu thành công' );

    }


}