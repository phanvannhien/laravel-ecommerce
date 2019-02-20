<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
/**
 * Models
 */
use App\Models\Countries;
use App\Models\Cities;
use App\Models\District;
use App\Models\Wards;

class UtilController{

    public function getCountries(Request $request){
        $countries = Countries::orderBy('name')->select('id','value as text')->get();
        return response()->json( $countries ); 
    }

    public function getCities( Request $request ){
        
            $cities = Cities::orderBy('name')->select('matp as id', 'name as text' )->get();
            return response()->json($cities);
        
    }

    public function getDistricts( Request $request, $city_id ){
        if( $request->ajax() ){
            $districts = District::where('matp', $city_id)
            ->orderBy('name')
            ->select('maqh as id', 'name as text' )
            ->get();
            return response()->json($districts );
        }
    }

    public function getWards( Request $request, $district_id ){
        if( $request->ajax() ){
            $wards = Wards::where('maqh', $district_id)
                ->orderBy('name')
                ->select('xaid as id', 'name as text' )
                ->get();
            return response()->json( $wards );
        }
    }
}