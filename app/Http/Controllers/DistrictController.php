<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index( Request $request ){
        $data = District::orderBy('maqh')
            ->select('*')
            ->paginate(20);
        return view('admin.systems.districts.index', ['data' => $data ]);
    }
}
