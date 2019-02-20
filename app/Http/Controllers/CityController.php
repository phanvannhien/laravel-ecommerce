<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index( Request $request ){
        $data = Cities::orderBy('matp')
            ->select('*')
            ->paginate(20);
        return view('admin.systems.cities.index', ['data' => $data ]);
    }
}
