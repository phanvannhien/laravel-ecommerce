<?php

namespace App\Http\Controllers;

use App\Models\Continents;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    public function index(){
        $data = Continents::orderBy('name')->select('code as continent_code','name')->paginate(20);
        return view('admin.systems.continents.index',[ 'data' => $data ]);
    }
}
