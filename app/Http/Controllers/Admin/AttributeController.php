<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Attributes;

class AttributeController extends Controller
{
    public function index(){

        $data = Attributes::paginate();
        return view('admin.attributes.index', compact('data'));


    }
}
