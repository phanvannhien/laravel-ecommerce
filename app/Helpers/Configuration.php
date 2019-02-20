<?php
namespace App\Helpers;
use App\Models\Configuration as ConfigModel;

class Configuration{
    public static function get($name){
        $config = ConfigModel::where('name',$name)->first();
        return 	isset($config->config_value) ? $config->config_value :'';
    }
}