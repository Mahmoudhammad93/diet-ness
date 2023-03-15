<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactUs(Request $request){
        $contact = Contact::create($request->all());

        return responseSuccess(trans('admin.Success Contact') ,$contact);
        
    }
}
