@extends('layouts.admin-layout')
@section('rightnavcontent')

<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
       
    @else
        <li class="nav-item dropdown">
       
                <a class="btn btn-danger" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            
        </li>
    @endguest
</ul>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
  <span style="color:green"> {{ session('success') }}</span>
</div>
@endif
        
            <div class="row">
                @foreach($exams as $exam)
                <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header formheader">
                        {{$exam->title}}
                </div>
                <div class="card-body">
                  <h5 class="card-title">Mark Per Question : {{$exam->mark}}</h5>
                  <h5 class="card-title">Duration : {{$exam->time}}</h5>
                  <h5 class="card-title">No. Of Questions : {{$exam->noofqns}}</h5>


                    
                  <a  data-toggle="modal" data-target="#questiontypemodal" data-examid="{{$exam->id}}" data-examtitle="{{$exam->title}}" class="addqnbtn btn btn-primary">Add Questions</a> 
                  
                </div>
                <div class="card-footer formheader text-muted">
                       Updated On {{$exam->updated_at}}
                </div>
              </div>
            </div>

            @endforeach
            </div>
           <hr>
           <h4 class="float-left w-100">Objective Questions</h4>
           @if ($obj->isEmpty())
           <h5 class="text-center">No Questions Added</h5>
           @else
            @foreach($obj as $key=>$ob)

             <div class="card w-100">
                <div class="card-body">
                  <h4 class="card-title"> {{ $ob->question }}</h4>
                  <p class="card-text text-dark">Option A : {{$ob->optiona}} </p>
                  <p class="card-text text-dark">Option B : {{$ob->optionb}}</p>
                  <p class="card-text text-dark">Option C : {{$ob->optionc}}</p>
                  <p class="card-text text-dark">Option D : {{ $ob->optiond }}</p>
                  <p class="card-text text-dark">Answer: {{ $ob->crctanswer }}</p>

                  <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deleteobjqn', $ob->id) !!}" data-sub_id="{{$ob->id}}" data-target="#custom-width-modal">Delete</a>

                </div>
              </div>
           @endforeach
           {{ $obj->links() }}
           @endif
           <hr>
           <h4 class="float-left w-100">Objective Questions with Image</h4>
           @if ($obji->isEmpty())
           <h5 class="text-center">No Questions Added</h5>
           @else
            @foreach($obji as $key=>$obi)

             <div class="card w-100">
                <div class="card-body">
                  
                  <img src="{{ asset('storage/app/public/')}}{{ $obi->question }}" class="w-100" alt="">

                  <p class="card-text text-dark">Option A : {{$obi->optiona}} </p>
                  <p class="card-text text-dark">Option B : {{$obi->optionb}}</p>
                  <p class="card-text text-dark">Option C : {{$obi->optionc}}</p>
                  <p class="card-text text-dark">Option D : {{ $obi->optiond }}</p>
                  <p class="card-text text-dark">Answer: {{ $obi->crctanswer }}</p>

                  <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deleteobjiqn', $obi->id) !!}" data-sub_id="{{$obi->id}}" data-target="#custom-width-modal">Delete</a>

                </div>
              </div>
           @endforeach
           {{ $obji->links() }}
           @endif

           <hr>
           <h4 class="float-left w-100">Fill Up Questions</h4>
           @if ($fill->isEmpty())
           <h5 class="text-center">No Questions Added</h5>
           @else
           @foreach($fill as $key=>$fi)

            <div class="card w-100">
               <div class="card-body">
                 <h4 class="card-title"> {{ $fi->question }}</h4>
                 <p class="card-text text-dark">Answer: {{ $fi->crctanswer }}</p>

                 <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletefillqn', $fi->id) !!}" data-sub_id="{{$fi->id}}" data-target="#custom-width-modal">Delete</a>

               </div>
             </div>
          @endforeach
          {{ $fill->links() }}
          @endif

          <hr>
          <h4 class="float-left w-100">Fill Up Questions with Image</h4>
          @if ($filli->isEmpty())
          <h5 class="text-center">No Questions Added</h5>
          @else
          @foreach($filli as $key=>$fii)

           <div class="card w-100">
              <div class="card-body">
                
                <img src="{{ asset('storage/app/public/')}}{{ $fii->question }}" class="w-100" alt="">

                
                <p class="card-text  text-dark">Answer: {{ $fii->crctanswer }}</p>

                <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletefilliqn', $fii->id) !!}" data-sub_id="{{$fii->id}}" data-target="#custom-width-modal">Delete</a>

              </div>
            </div>
         @endforeach
         {{ $filli->links() }}
         @endif

         <hr>
         <h4 class="float-left w-100">Match the following Questions</h4>
         @if ($mtf->isEmpty())
         <h5 class="text-center">No Questions Added</h5>
         @else
          @foreach($mtf as $key=>$mt)

           <div class="card w-100">
              <div class="card-body">
                <h5 class="card-text float-left">{{ $mt->question }}</h5>

                <table class="table">
                    <thead class="formheader">
                      <tr>
                        <th>{{ $mt->columna }}</th>
                        <th>{{ $mt->columna }}</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $mt->ca1 }}</td>
                        <td>{{ $mt->cb1 }}</td>
                        
                      </tr>
                      <tr>
                          <td>{{ $mt->ca2 }}</td>
                          <td>{{ $mt->cb2 }}</td>
                          
                      </tr>
                      <tr>
                          <td>{{ $mt->ca3 }}</td>
                          <td>{{ $mt->cb3 }}</td>
                          
                      </tr>
                      
                      <tr>
                          <td>{{ $mt->ca4 }}</td>
                          <td>{{ $mt->cb4 }}</td>
                          
                      </tr>
                      
                      <tr>
                          <td></td>
                          <td>{{ $mt->cb5 }}</td>
                          
                      </tr>
                    </tbody>
                  </table>

                
                <p class="card-text text-dark">Option A : {{$mt->optiona}} </p>
                <p class="card-text text-dark">Option B : {{$mt->optionb}}</p>
                <p class="card-text text-dark">Option C : {{$mt->optionc}}</p>
                <p class="card-text text-dark">Option D : {{ $mt->optiond }}</p>
                <p class="card-text text-dark">Answer: {{ $mt->crctanswer }}</p>
                

                <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletemtfqn', $mt->id) !!}" data-sub_id="{{$mt->id}}" data-target="#custom-width-modal">Delete</a>
                
              </div>
            </div>
         @endforeach
         {{ $mtf->links() }}
         @endif

         <hr>
         <h4 class="float-left w-100">Match the following Questions with Image</h4>
         @if ($mtfi->isEmpty())
         <h5 class="text-center">No Questions Added</h5>
         @else
          @foreach($mtfi as $key=>$mti)

           <div class="card w-100">
              <div class="card-body">

                <img src="{{ asset('storage/app/public/')}}{{ $mti->question }}" class="w-100" alt="">
               

                
                <p class="card-text text-dark">Option A : {{$mti->optiona}} </p>
                <p class="card-text text-dark">Option B : {{$mti->optionb}}</p>
                <p class="card-text text-dark">Option C : {{$mti->optionc}}</p>
                <p class="card-text text-dark">Option D : {{ $mti->optiond }}</p>
                <p class="card-text text-dark">Answer: {{ $mti->crctanswer }}</p>
                

                
                <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletemtfiqn', $mti->id) !!}" data-sub_id="{{$mti->id}}" data-target="#custom-width-modal">Delete</a>
                
              </div>
            </div>
         @endforeach
         {{ $mtfi->links() }}
         @endif

         <hr>
         
         {{--  select qn type  modal  --}}
    <div id="questiontypemodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questiontypemodalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:100%">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="questiontypemodalLabel">Select the type of Question</h5>
    
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                      
                        <ul class="list-group">
                            <a  data-toggle="modal" data-target="#obj-modal" data-dismiss="modal" class="seltypeqn">  <li class="list-group-item d-flex justify-content-between align-items-center">
                              Objective
                              
                            </li></a>
                            <a  data-toggle="modal" data-target="#objimg-modal" data-dismiss="modal" class="seltypeqn"> <li class="list-group-item d-flex justify-content-between align-items-center">
                              Objective with Image Question
                              
                            </li></a>
                            <a  data-toggle="modal" data-target="#fillup-modal" data-dismiss="modal" class="seltypeqn">  <li class="list-group-item d-flex justify-content-between align-items-center">
                              Fill Up 
                              
                            </li></a>
                            <a  data-toggle="modal" data-target="#fillupimg-modal" data-dismiss="modal" class="seltypeqn"><li class="list-group-item d-flex justify-content-between align-items-center">
                              Fill Up with Image Question
                              
                            </li></a>
                            <a  data-toggle="modal" data-target="#mtf-modal" data-dismiss="modal" class="seltypeqn"><li class="list-group-item d-flex justify-content-between align-items-center">
                                   Match the Following
                              
                              </li></a>
                              <a  data-toggle="modal" data-target="#mtfimg-modal" data-dismiss="modal" class="seltypeqn"><li class="list-group-item d-flex justify-content-between align-items-center">
                                Match the Following Image Question
                             
                           </li></a>
                            </ul>
                    
    
    
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
    {{--  objective qn type form  --}}
        <form method="POST" action="{{ route('admin.addobjqn') }}" aria-label="{{ __('addobjqn') }}">
                @csrf
    
            <div id="obj-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="obj-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header formheader">
                                <h5 class="modal-title" id="obj-modalLabel">Objective type Question</h5>
        
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            
                               <div class="row">
                               <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly="readonly" >
        
                                        @if ($errors->has('examid'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('examid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
        
                                        @if ($errors->has('examtitle'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('examtitle') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
        
                                    <div class="col-md-6">
                                        <textarea rows="5" id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('question') }}" required autofocus></textarea>
        
                                        @if ($errors->has('question'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group row">
                                    <label for="optiona" class="col-md-4 col-form-label text-md-right">{{ __('Option A') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optiona" type="text" class="form-control{{ $errors->has('optiona') ? ' is-invalid' : '' }}" name="optiona" value="{{ old('optiona') }}" required autofocus>
        
                                        @if ($errors->has('optiona'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optiona') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="optionb" class="col-md-4 col-form-label text-md-right">{{ __('Option B') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optionb" type="text" class="form-control{{ $errors->has('optionb') ? ' is-invalid' : '' }}" name="optionb" value="{{ old('optionb') }}" required autofocus>
        
                                        @if ($errors->has('optionb'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optionb') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
        
                                        @if ($errors->has('crctanswer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('crctanswer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-4">
    
                                <div class="form-group row">
                                    <label for="optionc" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optionc" type="text" class="form-control{{ $errors->has('optionc') ? ' is-invalid' : '' }}" name="optionc" value="{{ old('optionc') }}" required autofocus>
        
                                        @if ($errors->has('optionc'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optionc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="optiond" class="col-md-4 col-form-label text-md-right">{{ __('Option D') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optiond" type="text" class="form-control{{ $errors->has('optiond') ? ' is-invalid' : '' }}" name="optiond" value="{{ old('optiond') }}" required autofocus>
        
                                        @if ($errors->has('optiond'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optiond') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                                
                               
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn stlogin-btn">
                                {{ __('submit') }}
                            </button>
                            <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{--  objective with image qn type form  --}}
        <form method="POST" action="{{ route('admin.addobjimgqn') }}" enctype="multipart/form-data" aria-label="{{ __('addobjimgqn') }}">
                @csrf
    
            <div id="objimg-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="objimg-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header formheader">
                                <h5 class="modal-title" id="objimg-modalLabel">Objective type with Image Question </h5>
        
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            
                               <div class="row">
                               <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly >
        
                                        @if ($errors->has('examid'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('examid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
        
                                        @if ($errors->has('examtitle'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('examtitle') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
        
                                    <div class="col-md-6">
                                        
                                        <input type="file" class="form-control-file{{  $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="question" required autofocus>
                                        @if ($errors->has('question'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group row">
                                    <label for="optiona" class="col-md-4 col-form-label text-md-right">{{ __('Option A') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optiona" type="text" class="form-control{{ $errors->has('optiona') ? ' is-invalid' : '' }}" name="optiona" value="{{ old('optiona') }}" required autofocus>
        
                                        @if ($errors->has('optiona'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optiona') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="optionb" class="col-md-4 col-form-label text-md-right">{{ __('Option B') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optionb" type="text" class="form-control{{ $errors->has('optionb') ? ' is-invalid' : '' }}" name="optionb" value="{{ old('optionb') }}" required autofocus>
        
                                        @if ($errors->has('optionb'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optionb') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
        
                                        @if ($errors->has('crctanswer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('crctanswer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-4">
    
                                <div class="form-group row">
                                    <label for="optionc" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optionc" type="text" class="form-control{{ $errors->has('optionc') ? ' is-invalid' : '' }}" name="optionc" value="{{ old('optionc') }}" required autofocus>
        
                                        @if ($errors->has('optionc'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optionc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="optiond" class="col-md-4 col-form-label text-md-right">{{ __('Option D') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="optiond" type="text" class="form-control{{ $errors->has('optiond') ? ' is-invalid' : '' }}" name="optiond" value="{{ old('optiond') }}" required autofocus>
        
                                        @if ($errors->has('optiond'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('optiond') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                                
                               
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn stlogin-btn">
                                {{ __('submit') }}
                            </button>
                            <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
         {{--  Fill up type form  --}}
         <form method="POST" action="{{ route('admin.addfillupqn') }}" aria-label="{{ __('addfillupqn') }}">
            @csrf
    
        <div id="fillup-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="fillup-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog " >
                <div class="modal-content">
                    <div class="modal-header formheader">
                            <h5 class="modal-title" id="fillup-modalLabel">Fill Up type  Question form</h5>
    
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        
                           <div class="row">
                           <div class="col-md-6">
                            <div class="form-group row">
                                <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
    
                                <div class="col-md-6">
                                    <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly >
    
                                    @if ($errors->has('examid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('examid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
    
                                <div class="col-md-6">
                                    <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
    
                                    @if ($errors->has('examtitle'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('examtitle') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                    
                            <div class="form-group row">
                                <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
    
                                <div class="col-md-6">
                                    <textarea rows="5" id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('question') }}" required autofocus></textarea>
    
                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
    
                                <div class="col-md-6">
                                    <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
    
                                    @if ($errors->has('crctanswer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('crctanswer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            
                            </div>
                        </div>
                            
                           
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn stlogin-btn">
                            {{ __('submit') }}
                        </button>
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                        
                    
                    </div>
                </div>
            </div>
        </div>
    </form>
      {{--  Fill up with image type form  --}}
      <form method="POST" action="{{ route('admin.addfillupimgqn') }}" enctype="multipart/form-data" aria-label="{{ __('addfillupimgqn') }}">
        @csrf
    
    <div id="fillupimg-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="fillupimg-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header formheader">
                        <h5 class="modal-title" id="fillupimg-modalLabel">Fill Up type with Image Question </h5>
    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    
                       <div class="row">
                       <div class="col-md-6">
                        <div class="form-group row">
                            <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
    
                            <div class="col-md-6">
                                <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly >
    
                                @if ($errors->has('examid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('examid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
    
                            <div class="col-md-6">
                                <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
    
                                @if ($errors->has('examtitle'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('examtitle') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
    
                            <div class="col-md-6">
                                
                                <input type="file" class="form-control-file{{  $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="question" required autofocus>
                                @if ($errors->has('question'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
    
                            <div class="col-md-6">
                                <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
    
                                @if ($errors->has('crctanswer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('crctanswer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        
                        </div>
                    </div>
                        
                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn stlogin-btn">
                        {{ __('submit') }}
                    </button>
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                    
                
                </div>
            </div>
        </div>
    </div>
    </form>
    {{--  Match the following qn form  --}}
    <form method="POST" action="{{ route('admin.addmtfqn') }}" aria-label="{{ __('addmtfqn') }}">
        @csrf
    
    <div id="mtf-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mtf-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header formheader">
                        <h5 class="modal-title" id="mtf-modalLabel">Match the Following Question Form</h5>
    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    
                       <div class="row">
                       <div class="col-md-4">
                        <div class="form-group row">
                            <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
    
                            <div class="col-md-6">
                                <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly >
    
                                @if ($errors->has('examid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('examid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
    
                            <div class="col-md-6">
                                <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
    
                                @if ($errors->has('examtitle'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('examtitle') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
    
                            <div class="col-md-6">
                                <textarea rows="5" id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('question') }}" required autofocus></textarea>
    
                                @if ($errors->has('question'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group row">
                                    <label for="columna" class="col-md-4 col-form-label text-md-right">{{ __('Column A') }}</label>
            
                                    <div class="col-md-6">
                                        <input id="columna" type="text" class="form-control{{ $errors->has('columna') ? ' is-invalid' : '' }}" name="columna" value="{{ old('columna') }}" required autofocus>
            
                                        @if ($errors->has('columna'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('columna') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="ca1" class="col-md-4 col-form-label text-md-right">{{ __('CA1') }}</label>
                
                                        <div class="col-md-6">
                                            <input id="ca1" type="text" class="form-control{{ $errors->has('ca1') ? ' is-invalid' : '' }}" name="ca1" value="{{ old('ca1') }}" required autofocus>
                
                                            @if ($errors->has('ca1'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('ca1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="ca2" class="col-md-4 col-form-label text-md-right">{{ __('CA2') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="ca2" type="text" class="form-control{{ $errors->has('ca2') ? ' is-invalid' : '' }}" name="ca2" value="{{ old('ca2') }}" required autofocus>
                    
                                                @if ($errors->has('ca2'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('ca2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="ca3" class="col-md-4 col-form-label text-md-right">{{ __('CA3') }}</label>
                        
                                                <div class="col-md-6">
                                                    <input id="ca3" type="text" class="form-control{{ $errors->has('ca3') ? ' is-invalid' : '' }}" name="ca3" value="{{ old('ca3') }}" required autofocus>
                        
                                                    @if ($errors->has('ca3'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ca3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="ca4" class="col-md-4 col-form-label text-md-right">{{ __('CA4') }}</label>
                            
                                                    <div class="col-md-6">
                                                        <input id="ca4" type="text" class="form-control{{ $errors->has('ca4') ? ' is-invalid' : '' }}" name="ca4" value="{{ old('ca4') }}" required autofocus>
                            
                                                        @if ($errors->has('ca4'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('ca4') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                    <div class="form-group row">
                            <label for="optiona" class="col-md-4 col-form-label text-md-right">{{ __('Option A') }}</label>
    
                            <div class="col-md-6">
                                <input id="optiona" type="text" class="form-control{{ $errors->has('optiona') ? ' is-invalid' : '' }}" name="optiona" value="{{ old('optiona') }}" required autofocus>
    
                                @if ($errors->has('optiona'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('optiona') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="optionb" class="col-md-4 col-form-label text-md-right">{{ __('Option B') }}</label>
    
                            <div class="col-md-6">
                                <input id="optionb" type="text" class="form-control{{ $errors->has('optionb') ? ' is-invalid' : '' }}" name="optionb" value="{{ old('optionb') }}" required autofocus>
    
                                @if ($errors->has('optionb'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('optionb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
    
                            <div class="col-md-6">
                                <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
    
                                @if ($errors->has('crctanswer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('crctanswer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="col-md-4">
                                <div class="form-group row">
                                        <label for="columnb" class="col-md-4 col-form-label text-md-right">{{ __('Column B') }}</label>
                
                                        <div class="col-md-6">
                                            <input id="columnb" type="text" class="form-control{{ $errors->has('columnb') ? ' is-invalid' : '' }}" name="columnb" value="{{ old('columnb') }}" required autofocus>
                
                                            @if ($errors->has('columnb'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('columnb') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="cb1" class="col-md-4 col-form-label text-md-right">{{ __('CB1') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="cb1" type="text" class="form-control{{ $errors->has('cb1') ? ' is-invalid' : '' }}" name="cb1" value="{{ old('cb1') }}" required autofocus>
                    
                                                @if ($errors->has('cb1'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('cb1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="cb2" class="col-md-4 col-form-label text-md-right">{{ __('CB2') }}</label>
                        
                                                <div class="col-md-6">
                                                    <input id="cb2" type="text" class="form-control{{ $errors->has('cb2') ? ' is-invalid' : '' }}" name="cb2" value="{{ old('cb2') }}" required autofocus>
                        
                                                    @if ($errors->has('cb2'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cb2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="cb3" class="col-md-4 col-form-label text-md-right">{{ __('CB3') }}</label>
                            
                                                    <div class="col-md-6">
                                                        <input id="cb3" type="text" class="form-control{{ $errors->has('cb3') ? ' is-invalid' : '' }}" name="cb3" value="{{ old('cb3') }}" required autofocus>
                            
                                                        @if ($errors->has('cb3'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('cb3') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="cb4" class="col-md-4 col-form-label text-md-right">{{ __('CB4') }}</label>
                                
                                                        <div class="col-md-6">
                                                            <input id="cb4" type="text" class="form-control{{ $errors->has('cb4') ? ' is-invalid' : '' }}" name="cb4" value="{{ old('cb4') }}" required autofocus>
                                
                                                            @if ($errors->has('cb4'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('cb4') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                            <label for="cb5" class="col-md-4 col-form-label text-md-right">{{ __('CB5') }}</label>
                                    
                                                            <div class="col-md-6">
                                                                <input id="cb5" type="text" class="form-control{{ $errors->has('cb5') ? ' is-invalid' : '' }}" name="cb5" value="{{ old('cb5') }}" required autofocus>
                                    
                                                                @if ($errors->has('cb5'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('cb5') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                        <div class="form-group row">
                            <label for="optionc" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>
    
                            <div class="col-md-6">
                                <input id="optionc" type="text" class="form-control{{ $errors->has('optionc') ? ' is-invalid' : '' }}" name="optionc" value="{{ old('optionc') }}" required autofocus>
    
                                @if ($errors->has('optionc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('optionc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="optiond" class="col-md-4 col-form-label text-md-right">{{ __('Option D') }}</label>
    
                            <div class="col-md-6">
                                <input id="optiond" type="text" class="form-control{{ $errors->has('optiond') ? ' is-invalid' : '' }}" name="optiond" value="{{ old('optiond') }}" required autofocus>
    
                                @if ($errors->has('optiond'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('optiond') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                        
                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn stlogin-btn">
                        {{ __('submit') }}
                    </button>
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                    
                
                </div>
            </div>
        </div>
    </div>
    </form>
    {{--  Match the following Image qn form  --}}
    <form method="POST" action="{{ route('admin.addmtfimgqn') }}"  enctype="multipart/form-data" aria-label="{{ __('addmtfimgqn') }}">
            @csrf
        
        <div id="mtfimg-modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mtfimg-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog " >
                <div class="modal-content">
                    <div class="modal-header formheader">
                            <h5 class="modal-title" id="mtfimg-modalLabel">Match the Following with Image Question/h5>
        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        
                           <div class="row">
                           <div class="col-md-4">
                            <div class="form-group row">
                                <label for="examid" class="col-md-4 col-form-label text-md-right">{{ __('Exam Id') }}</label>
        
                                <div class="col-md-6">
                                    <input id="examid" type="text" class="form-control{{ $errors->has('examid') ? ' is-invalid' : '' }}" name="examid" value="" required autofocus readonly >
        
                                    @if ($errors->has('examid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('examid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="examtitle" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>
        
                                <div class="col-md-6">
                                    <input id="examtitle" type="text" class="form-control{{ $errors->has('examtitle') ? ' is-invalid' : '' }}" name="examtitle" value="" required autofocus disabled >
        
                                    @if ($errors->has('examtitle'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('examtitle') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
            
                                    <div class="col-md-6">
                                        
                                        <input type="file" class="form-control-file{{  $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="question" required autofocus>
                                        @if ($errors->has('question'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group row">
                                        <label for="columna" class="col-md-4 col-form-label text-md-right">{{ __('Column A') }}</label>
                
                                        <div class="col-md-6">
                                            <input id="columna" type="text" class="form-control{{ $errors->has('columna') ? ' is-invalid' : '' }}" name="columna" value="{{ old('columna') }}" required autofocus>
                
                                            @if ($errors->has('columna'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('columna') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="ca1" class="col-md-4 col-form-label text-md-right">{{ __('CA1') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="ca1" type="text" class="form-control{{ $errors->has('ca1') ? ' is-invalid' : '' }}" name="ca1" value="{{ old('ca1') }}" required autofocus>
                    
                                                @if ($errors->has('ca1'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('ca1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="ca2" class="col-md-4 col-form-label text-md-right">{{ __('CA2') }}</label>
                        
                                                <div class="col-md-6">
                                                    <input id="ca2" type="text" class="form-control{{ $errors->has('ca2') ? ' is-invalid' : '' }}" name="ca2" value="{{ old('ca2') }}" required autofocus>
                        
                                                    @if ($errors->has('ca2'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ca2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="ca3" class="col-md-4 col-form-label text-md-right">{{ __('CA3') }}</label>
                            
                                                    <div class="col-md-6">
                                                        <input id="ca3" type="text" class="form-control{{ $errors->has('ca3') ? ' is-invalid' : '' }}" name="ca3" value="{{ old('ca3') }}" required autofocus>
                            
                                                        @if ($errors->has('ca3'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('ca3') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="ca4" class="col-md-4 col-form-label text-md-right">{{ __('CA4') }}</label>
                                
                                                        <div class="col-md-6">
                                                            <input id="ca4" type="text" class="form-control{{ $errors->has('ca4') ? ' is-invalid' : '' }}" name="ca4" value="{{ old('ca4') }}" required autofocus>
                                
                                                            @if ($errors->has('ca4'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('ca4') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                        <div class="form-group row">
                                <label for="optiona" class="col-md-4 col-form-label text-md-right">{{ __('Option A') }}</label>
        
                                <div class="col-md-6">
                                    <input id="optiona" type="text" class="form-control{{ $errors->has('optiona') ? ' is-invalid' : '' }}" name="optiona" value="{{ old('optiona') }}" required autofocus>
        
                                    @if ($errors->has('optiona'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('optiona') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="optionb" class="col-md-4 col-form-label text-md-right">{{ __('Option B') }}</label>
        
                                <div class="col-md-6">
                                    <input id="optionb" type="text" class="form-control{{ $errors->has('optionb') ? ' is-invalid' : '' }}" name="optionb" value="{{ old('optionb') }}" required autofocus>
        
                                    @if ($errors->has('optionb'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('optionb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="crctanswer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
        
                                <div class="col-md-6">
                                    <input id="crctanswer" type="text" class="form-control{{ $errors->has('crctanswer') ? ' is-invalid' : '' }}" name="crctanswer" value="{{ old('crctanswer') }}" required autofocus>
        
                                    @if ($errors->has('crctanswer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('crctanswer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="col-md-4">
                                    <div class="form-group row">
                                            <label for="columnb" class="col-md-4 col-form-label text-md-right">{{ __('Column B') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="columnb" type="text" class="form-control{{ $errors->has('columnb') ? ' is-invalid' : '' }}" name="columnb" value="{{ old('columnb') }}" required autofocus>
                    
                                                @if ($errors->has('columnb'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('columnb') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="cb1" class="col-md-4 col-form-label text-md-right">{{ __('CB1') }}</label>
                        
                                                <div class="col-md-6">
                                                    <input id="cb1" type="text" class="form-control{{ $errors->has('cb1') ? ' is-invalid' : '' }}" name="cb1" value="{{ old('cb1') }}" required autofocus>
                        
                                                    @if ($errors->has('cb1'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cb1') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="cb2" class="col-md-4 col-form-label text-md-right">{{ __('CB2') }}</label>
                            
                                                    <div class="col-md-6">
                                                        <input id="cb2" type="text" class="form-control{{ $errors->has('cb2') ? ' is-invalid' : '' }}" name="cb2" value="{{ old('cb2') }}" required autofocus>
                            
                                                        @if ($errors->has('cb2'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('cb2') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="cb3" class="col-md-4 col-form-label text-md-right">{{ __('CB3') }}</label>
                                
                                                        <div class="col-md-6">
                                                            <input id="cb3" type="text" class="form-control{{ $errors->has('cb3') ? ' is-invalid' : '' }}" name="cb3" value="{{ old('cb3') }}" required autofocus>
                                
                                                            @if ($errors->has('cb3'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('cb3') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                            <label for="cb4" class="col-md-4 col-form-label text-md-right">{{ __('CB4') }}</label>
                                    
                                                            <div class="col-md-6">
                                                                <input id="cb4" type="text" class="form-control{{ $errors->has('cb4') ? ' is-invalid' : '' }}" name="cb4" value="{{ old('cb4') }}" required autofocus>
                                    
                                                                @if ($errors->has('cb4'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('cb4') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                                <label for="cb5" class="col-md-4 col-form-label text-md-right">{{ __('CB5') }}</label>
                                        
                                                                <div class="col-md-6">
                                                                    <input id="cb5" type="text" class="form-control{{ $errors->has('cb5') ? ' is-invalid' : '' }}" name="cb5" value="{{ old('cb5') }}" required autofocus>
                                        
                                                                    @if ($errors->has('cb5'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('cb5') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                            <div class="form-group row">
                                <label for="optionc" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>
        
                                <div class="col-md-6">
                                    <input id="optionc" type="text" class="form-control{{ $errors->has('optionc') ? ' is-invalid' : '' }}" name="optionc" value="{{ old('optionc') }}" required autofocus>
        
                                    @if ($errors->has('optionc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('optionc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="optiond" class="col-md-4 col-form-label text-md-right">{{ __('Option D') }}</label>
        
                                <div class="col-md-6">
                                    <input id="optiond" type="text" class="form-control{{ $errors->has('optiond') ? ' is-invalid' : '' }}" name="optiond" value="{{ old('optiond') }}" required autofocus>
        
                                    @if ($errors->has('optiond'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('optiond') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                            
                           
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn stlogin-btn">
                            {{ __('submit') }}
                        </button>
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                        
                    
                    </div>
                </div>
            </div>
        </div>
        </form>
    
@endsection
@section('deletemodal')
         <script src="{{ asset('js/deletemodal.js') }}"></script>
@endsection
       
<!-- Delete Model -->
<form action=""  class="remove-record-model" method="POST">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="custom-width-modalLabel">Delete Record</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h6>You Want You Sure Delete This Record ?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>

</form> 