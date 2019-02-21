<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ShippingMethod;

class ShippingController extends Controller
{

    function index(){

        return view('admin.shippings.index',['shippings' => ShippingMethod::all() ]);
    }

    public function edit($id){
        return view('admin.shippings.edit', ['data' => ShippingMethod::findOrFail($id)] );
    }
}
