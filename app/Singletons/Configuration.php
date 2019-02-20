<?php

namespace App\Singletons;
use App\Models\Configuration as ConfigDB;

class Configuration{

    protected $config;

    public function __construct()
    {
        $config = ConfigDB::select('name','config_value as value')->get();
        $data = $config->mapWithKeys(function ($item) {
            return [$item['name'] => $item['value']];
        });
        $this->config = $data;
    }

    public function get($key){
        return $this->config[$key];
    }

}