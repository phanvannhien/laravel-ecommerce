<?php

namespace App\Http\Controllers;

use App\Http\Filters\CountryFilter;
use App\Models\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index( Request $request, CountryFilter $filters ){
        $data = Countries::filter($filters)->orderBy('name')
            ->select('code as country_code','value as name','native','phone','continent','capital','currency','languages')
            ->paginate(20);
        return view('admin.systems.countries.index', ['data' => $data ]);
    }
}
