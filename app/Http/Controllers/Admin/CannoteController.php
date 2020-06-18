<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;
use App\ServiceArea;

class CannoteController extends Controller
{
    public function addForm()
    {
        $states = State::where('status',1)->get();
        $service_area = ServiceArea::where('status',1)->get();
        return view('admin.outbound.canote_entry',compact('states','service_area'));
    }
}
