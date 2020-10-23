<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
class BagingController extends Controller
{
    public function bagingList(){
        $city= City::where('status',1)->get();
        return view('branch.outbound.baging_list',compact('city'));
    }

    public function fetchDetails(){
        
    }
}
