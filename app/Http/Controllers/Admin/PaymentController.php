<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    //
    public function index(){
        return view('admin.payments.index', [ 'payments' =>  config('payment')] );
    }
}
