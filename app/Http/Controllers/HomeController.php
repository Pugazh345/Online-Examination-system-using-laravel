<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Auth;
use App\Batch;
use App\Conductexam;
use App\Exam;
use App\Mcq;
use App\Mcqimg;
use App\Fillup;
use App\Fillupimg;
use App\Mtf;
use App\Mtfimg;
use App\Result;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       $batchfk = Auth::user()->batchfk;
       $stid = Auth::user()->id;
       $bt=Conductexam::where('batchfk',$batchfk)->get();
       $exam = Exam::where('id',$bt[0]->examidfk)->first();
       $result =  Result::where('examidfk',$bt[0]->examidfk)->where('studentidfk',$stid)->first();
       return view('home')->with('batches',$bt)->with('exam',$exam)->with('result',$result);
    }
    public function startexam($examid){

     $duration = Exam::where('id',$examid)->first();
        $obj = Mcq::where('examidfk',$examid)->get();
        $objcount = $obj->count();
        $objimg = Mcqimg::where('examidfk',$examid)->get();
        $objimgcount = $objimg->count();
        $fillup = Fillup::where('examidfk',$examid)->get();
        $fillupcount = $fillup->count();
       $fillupimg = Fillupimg::where('examidfk',$examid)->get();
       $fillupimgcount = $fillupimg->count();
       $mtf = Mtf::where('examidfk',$examid)->get();
       $mtfcount = $mtf->count();
       $mtfimg = Mtfimg::where('examidfk',$examid)->get();
       $mtfimgcount = $mtfimg->count();
       session()->put('key', 'value');
       $stid = Auth::user()->id;
       $result =  Result::where('examidfk',$examid)->where('studentidfk',$stid)->first();
     if(!empty($result)){
       Session::flash('fail', 'You have completed the exam already and  Your Score is '.$result->marks);
       
       return view('exam',compact('examid','obj','objcount','objimg','objimgcount','fillup','fillupcount','fillupimg','fillupimgcount','mtf','mtfcount','mtfimg','mtfimgcount','duration')) ;
     }
       return view('exam',compact('examid','obj','objcount','objimg','objimgcount','fillup','fillupcount','fillupimg','fillupimgcount','mtf','mtfcount','mtfimg','mtfimgcount','duration')) ;
    }
    public function result(){
        return view('result');
    }
    public function submitexam(Request $request){
        $examid = $request->examid;
        // $batchfk = Auth::user()->batchfk;
       $stid = Auth::user()->id;
       $result =  Result::where('examidfk',$examid)->where('studentidfk',$stid)->first();
     if(!empty($result)){
       Session::flash('failed', 'You have completed the exam already and  Your Score is '.$result->marks);
       return redirect()->route('user.result');
     }
     else{
     $exam = Exam::where('id',$examid)->first();
     $totalmark = $exam->mark*$exam->noofqns;
        $obj = Mcq::where('examidfk',$examid)->get();
        $objcount = $obj->count();
        $objimg = Mcqimg::where('examidfk',$examid)->get();
        $objimgcount = $objimg->count();
        $fillup = Fillup::where('examidfk',$examid)->get();
        $fillupcount = $fillup->count();
       $fillupimg = Fillupimg::where('examidfk',$examid)->get();
       $fillupimgcount = $fillupimg->count();
       $mtf = Mtf::where('examidfk',$examid)->get();
       $mtfcount = $mtf->count();
       $mtfimg = Mtfimg::where('examidfk',$examid)->get();
       $mtfimgcount = $mtfimg->count();
       $count=0;

       if($request->has('opt')){
        for ($i=1,$j=0; $i <= $objcount ; $i++,$j++) { 
            $opt= "opt".$i;
    
            if(!strcmp($obj[$j]->crctanswer,$request->$opt)){
                  $count=$count+1;
               }
            
           }
       }
       
       if($request->has('opti')){
        
       for ($i=1,$j=0; $i <= $objimgcount ; $i++,$j++) { 
        $opti= "opti".$i;

        if(!strcmp($objimg[$j]->crctanswer,$request->$opti)){
              $count=$count+1;
           }
       
          
       }
    }
    if($request->has('fill')){
       
       for ($i=1,$j=0; $i <= $fillupcount ; $i++,$j++) { 
        $fill= "fillans".$i;

        if(!strcmp($fillup[$j]->crctanswer,$request->$fill)){
              $count=$count+1;
           }
       }
    }
    if($request->has('filli')){

       for ($i=1,$j=0; $i <= $fillupimgcount ; $i++,$j++) { 
        $filli= "fillians".$i;

        if(!strcmp($fillupimg[$j]->crctanswer,$request->$filli)){
              $count=$count+1;
           }
          
       }
    }
    if($request->has('mt')){

       for ($i=1,$j=0; $i <= $mtfcount ; $i++,$j++) { 
        $mt= "mtf".$i;

        if(!strcmp($mtf[$j]->crctanswer,$request->$mt)){
              $count=$count+1;
           }
       }
    }
    if($request->has('mtfi')){

       for ($i=1,$j=0; $i <= $mtfimgcount ; $i++,$j++) { 
        $mtfi= "mtfi".$i;

        if(!strcmp($mtfimg[$j]->crctanswer,$request->$mtfi)){
              $count=$count+1;
           }
          
       }
    }

      $score = $count*$exam->mark;
      session()->put('result', $count);
      $result = new Result;
      $result->studentidfk = Auth::user()->id;
      $result->examidfk = $examid;
      $result->marks = $score;
      $result->save();

       Session::flash('success', 'Your Score is '.$score. ' Out of '.$totalmark);
        return redirect()->route('user.result');
    }
    }
    public function studentabout()
    {   
        $subid = Auth::user()->student_sub_idfk;
       $subid2 = Auth::user()->student_sub_idfk2;
       $subid3 = Auth::user()->student_sub_idfk3;
       $subid4 = Auth::user()->student_sub_idfk4;
       $subid5 = Auth::user()->student_sub_idfk5;

       $grp = Subject ::where('sub_id',$subid)->get();
       $grp2 = Subject ::where('sub_id',$subid2)->get();
       $grp3 = Subject ::where('sub_id',$subid3)->get();
       $grp4 = Subject ::where('sub_id',$subid4)->get();
       $grp5 = Subject ::where('sub_id',$subid5)->get();
    //    $videos = Videomaterials ::where('sub_idfk',$studentid)->get();
    
    return view('userabout')->with('grp',$grp)->with('grp2',$grp2)->with('grp3',$grp3)->with('grp4',$grp4)->with('grp5',$grp5);
        
    }
    public function studentcontact()
    {   
       $studentid = Auth::user()->student_sub_idfk;
       $grp = Subject ::where('sub_id',$studentid)->get();
       $videos = Videomaterials ::where('sub_idfk',$studentid)->get();
    //    $groupname=$groupname->subtitle;        
        return view('usercontact')->with('grp',$grp)->with('videos',$videos);
    }
    public function coursecontent($group){
        $subid = Auth::user()->student_sub_idfk;
        $subid2 = Auth::user()->student_sub_idfk2;
        $subid3 = Auth::user()->student_sub_idfk3;
        $subid4 = Auth::user()->student_sub_idfk4;
        $subid5 = Auth::user()->student_sub_idfk5;
 
        $grp = Subject ::where('sub_id',$subid)->get();
        $grp2 = Subject ::where('sub_id',$subid2)->get();
        $grp3 = Subject ::where('sub_id',$subid3)->get();
        $grp4 = Subject ::where('sub_id',$subid4)->get();
        $grp5 = Subject ::where('sub_id',$subid5)->get();

       $selgrp = Subject ::where('sub_id',$group)->get();
       $videos = Videomaterials ::where('sub_idfk',$group)->get();
    //    $groupname=$groupname->subtitle;        
        return view('usercoursecontent')->with('grp',$grp)->with('grp2',$grp2)->with('grp3',$grp3)->with('grp4',$grp4)->with('grp5',$grp5)->with('selgrp',$selgrp)->with('videos',$videos);
    }
    public function videomaterials(){
       $studentid = Auth::user()->student_sub_idfk;
        $videos = Videomaterials ::where('sub_idfk',$studentid)->get();
        $grp = Subject ::where('sub_id',$studentid)->get();
    //    $videos = $filtered->all();

        return view('videomaterials')->with('videos',$videos)->with('grp',$grp);
    }
    public function getVideo($video)
{
    
    $fileContents = Storage::disk('local')->get($video);
    $response = Response::make($fileContents, 200);
    // $response->header('Content-Type', "video/mp4;");
    return $response;
}

    public function pdvideomaterials(){
        $subid = Auth::user()->student_sub_idfk;
        $subid2 = Auth::user()->student_sub_idfk2;
        $subid3 = Auth::user()->student_sub_idfk3;
        $subid4 = Auth::user()->student_sub_idfk4;
        $subid5 = Auth::user()->student_sub_idfk5;
 
        $grp = Subject ::where('sub_id',$subid)->get();
        $grp2 = Subject ::where('sub_id',$subid2)->get();
        $grp3 = Subject ::where('sub_id',$subid3)->get();
        $grp4 = Subject ::where('sub_id',$subid4)->get();
        $grp5 = Subject ::where('sub_id',$subid5)->get();
        $videos = Personalitydevs::all();
    //    $videos = $filtered->all();
        return view('pdvideomaterials')->with('videos',$videos)->with('grp',$grp)->with('grp2',$grp2)->with('grp3',$grp3)->with('grp4',$grp4)->with('grp5',$grp5);
    }
}
