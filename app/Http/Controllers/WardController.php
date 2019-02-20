<?php

namespace App\Http\Controllers;

use App\Models\Wards;
use Illuminate\Http\Request;

class WardController extends Controller
{
    public function index( Request $request ){
        $data = Wards::orderBy('xaid')
            ->select('*')
            ->paginate(20);
        return view('admin.systems.wards.index', ['data' => $data ]);
    }
}
