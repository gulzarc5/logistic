<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
class ContactController extends Controller
{
    public function contactList(){
        return view('admin.contact_list');
    }

    public function contactListAjax(Request $request)
    {
        return datatables()->of(Contact::get())
            ->addIndexColumn()
            ->make(true);
    }
}
