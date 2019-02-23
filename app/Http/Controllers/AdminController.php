<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\User;
use App\Exam;
use App\Mcq;
use App\Mcqimg;
use App\Fillup;
use App\Fillupimg;
use App\Mtf;
use App\Mtfimg;
use App\Batch;
use App\Conductexam;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Session;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin'); 
    }
   public function vcrbatch(){
       $bt = Batch::all();
       return view('admin-addbatch')->with('batches',$bt);
   }
    public function addbatch(Request $request){

        $data=$this->validate($request, [
            'batch'=>'required',
            
       ]);

        $bt = new Batch;
        $bt->batch=$request->batch;
        $bt->save(); 
        Session::flash('success', 'Exam Created Successfully');
    	return redirect()->route('admin.vcrbatch');   
    }
    public function deletebatch($batchid){
        
        $delsubject = Batch::firstOrFail()->where('id',$batchid);
        $delsubject->delete();
        Session::flash('success', ' Batch removed Successfully.');
    	return redirect()->route('admin.conductexamview');     
    }
    public function regstudent(){
        
        $users = User::all();
        $bt = Batch::all();
        return view('auth.register')->with('users',$users)->with('batches',$bt);
    }
   
    
    public function editstudent(Request $request,$id){
        $data=$this->validate($request, [
            'edpassword' => 'required|string|min:6|confirmed',
          
       ]);
        $edstudent = User::find($id);
        // $edstudent->name=$request->edname;
        // $edstudent->userid=$request->eduserid;
        // $edstudent->email=$request->edemail;
        $edstudent->password=Hash::make($request->edpassword);
        // $edstudent->mobilenumber=$request->edmobilenum;
        // $edstudent->student_sub_idfk=$request->edstudent_sub_idfk;

        $edstudent->save();
        Session::flash('success', 'Student Password Updated Successfully.');
        return redirect()->route('admin.regstudent');     
        
    }
    public function export(){
        return Excel::download(new UsersExport, 'Students.xlsx');
    }
    public function deleteconductedexam($cexamid){
        
        $delsubject = Conductexam::firstOrFail()->where('id',$cexamid);
        $delsubject->delete();
        Session::flash('success', 'Conducted exam removed for the batch Successfully.');
    	return redirect()->route('admin.conductexamview');     
    }
    public function deletestudent($id){
        $delstudent = User::findOrFail($id);
        $delstudent->delete();
        Session::flash('success', 'Student Removed Successfully.');
    	return redirect()->route('admin.regstudent');     
    }

    
  
    public function viewcreateexam(){
        
        $exams = Exam::all();
        return view('admin-createexam')->with('exams',$exams);
    }
    public function createexam(Request $request){

        $data=$this->validate($request, [
            'title'=>'required|string|min:3|max:120',
            'instructions'=>'required',
            'mark'=>'required|string',
            'time'=>'required|string',
            'noofqns'=>'required|string'
       ]);

        $exam = new Exam;
        $exam->title=$request->title;
        $exam->instructions=$request->instructions;
        $exam->mark=$request->mark;
        $exam->time=$request->time;
        $exam->noofqns=$request->noofqns;
        $exam->save(); 
        Session::flash('success', 'Exam Created Successfully');
    	return redirect()->route('admin.vcrexam');   
    }
    public function deleteexam($examid){
        $delsubject = Exam::first()->where('id',$examid);
        $delsubject->delete();
        Session::flash('success', 'Exam Removed Successfully.');
    	return redirect()->route('admin.vcrexam');   
    }
    public function addqnexamdisp(){
        
        $exams = Exam::all();
        $obj = Mcq::paginate(1);
        $obji= Mcqimg::paginate(1);
        $fill= Fillup::paginate(1);
        $filli= Fillupimg::paginate(1);
      $mtf = Mtf::paginate(1);
      $mtfi = Mtfimg::paginate(1);

        return view('admin-addquestion',compact('obj','obji','fill','filli','mtf','mtfi'))->with('exams',$exams);
    }
    public function addobjqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
            'optiona'=>'required',
            'optionb'=>'required',
            'optionc'=>'required',
            'optiond'=>'required',
            'crctanswer'=>'required',

       ]);

        $obj = new Mcq;
        $obj->examidfk=$request->examid;
        $obj->question=$request->question;
        $obj->optiona=$request->optiona;
        $obj->optionb=$request->optionb;
        $obj->optionc=$request->optionc;
        $obj->optiond=$request->optiond;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 
        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function deleteobjqn($objid){
        $delsubject = Mcq::first()->where('id',$objid);
        $delsubject->delete();
        Session::flash('success', 'Objective Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function addobjimgqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
            'optiona'=>'required',
            'optionb'=>'required',
            'optionc'=>'required',
            'optiond'=>'required',
            'crctanswer'=>'required',

       ]);
       $extension = $request->question->extension();
       $request->file('question');
       $retpath = "/uploads/objective/".$request->examid.'.'.$extension;
       
        $obj = new Mcqimg;
        $obj->examidfk=$request->examid;
        $obj->question=$retpath;
        $obj->optiona=$request->optiona;
        $obj->optionb=$request->optionb;
        $obj->optionc=$request->optionc;
        $obj->optiond=$request->optiond;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 
        $obji= Mcqimg::max('id');
        $path = $request->question->storeAs('/public/uploads/objective',$request->examid.$obji.'.'.$extension);
        $edretpath = Mcqimg::find($obji);
        $edret = "/uploads/objective/".$request->examid.$obji.'.'.$extension;
        $edretpath->question = $edret;
       $edretpath->save();
        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function deleteobjiqn($objiid){
        $delsubject = Mcqimg::first()->where('id',$objiid);
        $delsubject->delete();
        Session::flash('success', 'Objective Image Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function addfillupqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
            'crctanswer'=>'required',

       ]);

        $obj = new Fillup;
        $obj->examidfk=$request->examid;
        $obj->question=$request->question;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 
        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function deletefillqn($fillid){
        $delsubject = Fillup::first()->where('id',$fillid);
        $delsubject->delete();
        Session::flash('success', 'Fill Up Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function addfillupimgqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
            'crctanswer'=>'required',

       ]);

       $extension = $request->question->extension();
       $request->file('question');
       $retpath = "/uploads/fillup/".$request->examid.'.'.$extension;
        $obj = new Fillupimg;
        $obj->examidfk=$request->examid;
        $obj->question=$retpath;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 
        
        $filli= Fillupimg::max('id');
        $path = $request->question->storeAs('/public/uploads/fillup',$request->examid.$filli.'.'.$extension);
        $edretpath = Fillupimg::find($filli);
        $edret = "/uploads/fillup/".$request->examid.$filli.'.'.$extension;
        $edretpath->question = $edret;
       $edretpath->save();
        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    
    public function deletefilliqn($filliid){
        $delsubject = Fillupimg::first()->where('id',$filliid);
        $delsubject->delete();
        Session::flash('success', 'Fill Up Image Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function addmtfqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
            'columna'=>'required',
            'ca1'=>'required',
            'ca2'=>'required',
            'ca3'=>'required',
            'ca4'=>'required',
            'columnb'=>'required',
            'cb1'=>'required',
            'cb2'=>'required',
            'cb3'=>'required',
            'cb4'=>'required',
            'cb5'=>'required',
            'optiona'=>'required',
            'optionb'=>'required',
            'optionc'=>'required',
            'optiond'=>'required',
            'crctanswer'=>'required',

       ]);

        $obj = new Mtf;
        $obj->examidfk=$request->examid;
        $obj->question=$request->question;
        $obj->columna=$request->columna;
        $obj->ca1=$request->ca1;
        $obj->ca2=$request->ca2;
        $obj->ca3=$request->ca3;
        $obj->ca4=$request->ca4;
        $obj->columnb=$request->columnb;
        $obj->cb1=$request->cb1;
        $obj->cb2=$request->cb2;
        $obj->cb3=$request->cb3;
        $obj->cb4=$request->cb4;
        $obj->cb5=$request->cb5;

        $obj->optiona=$request->optiona;
        $obj->optionb=$request->optionb;
        $obj->optionc=$request->optionc;
        $obj->optiond=$request->optiond;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 
        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    
    public function deletemtfqn($mtfid){
        $delsubject = Mtf::first()->where('id',$mtfid);
        $delsubject->delete();
        Session::flash('success', 'Match the Following Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function addmtfimgqn(Request $request){

        $data=$this->validate($request, [
            'examid'=>'required',
            'question'=>'required',
         
            'optiona'=>'required',
            'optionb'=>'required',
            'optionc'=>'required',
            'optiond'=>'required',
            'crctanswer'=>'required',

       ]);
         

       $extension = $request->question->extension();
       $request->file('question');
       $retpath = "/uploads/matchthefollowing/".$request->examid.'.'.$extension;
        $obj = new Mtfimg;
        $obj->examidfk=$request->examid;
        $obj->question=$retpath;
        

        $obj->optiona=$request->optiona;
        $obj->optionb=$request->optionb;
        $obj->optionc=$request->optionc;
        $obj->optiond=$request->optiond;
        $obj->crctanswer=$request->crctanswer;
        $obj->save(); 

        $mtfi = Mtfimg::max('id');
        $path = $request->question->storeAs('/public/uploads/matchthefollowing',$request->examid.$mtfi.'.'.$extension);

        $edretpath = Mtfimg::find($mtfi);
        $edret = "/uploads/matchthefollowing/".$request->examid.$mtfi.'.'.$extension;
        $edretpath->question = $edret;
        $edretpath->save();


        Session::flash('success', 'Question added Successfully');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function deletemtfiqn($mtfiid){
        $delsubject = Mtfimg::first()->where('id',$mtfiid);
        $delsubject->delete();
        Session::flash('success', 'Match the Following Image Qn Removed Successfully.');
    	return redirect()->route('admin.addqnexamdisp');   
    }
    public function conductexamview(){
        $exams = Exam::all();
        $bt = Batch::all();
        $ce =  Conductexam::all();
        return view('admin-conductexamview')->with('exams',$exams)->with('batches',$bt)->with('conductexam',$ce);
    }
    public function conductexam(Request $request){
        $data=$this->validate($request, [
            'examidfk'=>'required',
            'batch'=>'required',
            
       ]);

        $ce = new Conductexam;
        $ce->examidfk=$request->examidfk;
        $ce->batchfk=$request->batch;
        $ce->save(); 
        Session::flash('success', 'Exam started Successfully for the batch');
    	return redirect()->route('admin.conductexamview'); 
    }
}
