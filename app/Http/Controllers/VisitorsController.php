<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

use Illuminate\Http\Request;
use Session;
class VisitorsController extends Controller
{
    public function sendmail(Request $request){
        $name = $request->name;
        $phone= $request->phone;
        $email = $request->email;
        $course= $request->course;
        $location=$request->location;
        Mail::to('saligramam@cmstalentdevelopment.com')->send(new ContactMail($name,$phone,$email,$course,$location));
        Session::flash('success', 'Thanks For Contacting Us !.');
        return redirect()->route('contact');       
        
    }
}
