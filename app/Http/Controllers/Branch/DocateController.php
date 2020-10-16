<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocateController extends Controller
{
    public function addForm(){
        return view('branch.outbound.docate_entry');
    }
}
