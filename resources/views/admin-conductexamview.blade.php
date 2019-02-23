@extends('layouts.admin-layout')
@section('rightnavcontent')

<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @else
        <li class="nav-item dropdown">
            {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a> --}}

            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                <a class="btn btn-danger" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            {{-- </div> --}}
        </li>
    @endguest
</ul>
@endsection

@section('content')

        <div class="col-lg-12">
             
            <div class="card">
                <div class="card-header formheader">Conduct Exam</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.conductexam') }}" aria-label="{{ __('conductexam') }}">
                        @csrf

                       
                        <div class="form-group row">
                                <label for="examidfk" class="col-md-4 col-form-label text-md-right">{{ __('Exam') }}</label>
                    
                                <div class="col-md-6">
                                                      
                                <select class="form-control{{ $errors->has('sub_idfk') ? ' is-invalid' : '' }} btn btn-outline-secondary dropdown-toggle" name="examidfk">
                                    
                                  
                                  @foreach($exams as $exam)
                                  
                                  <option  value={{$exam->id}}> {{$exam->id}} | {{$exam->title}}</option>
                                  <hr>
                                  @endforeach
                                </select>         
                                @if ($errors->has('examidfk'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('examidfk') }}</strong>
                                                        </span>
                                                    @endif   
                          </div>
                        </div>
                        <div class="form-group row">
                                <label for="batch" class="col-md-4 col-form-label text-md-right">{{ __('batch') }}</label>
                    
                                <div class="col-md-6">
                                                      
                                <select class="form-control{{ $errors->has('batch') ? ' is-invalid' : '' }} btn btn-outline-secondary dropdown-toggle" name="batch">
                                    
                                  
                                  @foreach($batches as $batch)
                                  
                                  <option  value={{$batch->batch}}> {{$batch->id}} | {{$batch->batch}}</option>
                                  <hr>
                                  @endforeach
                                </select>         
                                @if ($errors->has('batch'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('batch') }}</strong>
                                                        </span>
                                                    @endif   
                          </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn stlogin-btn">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
            @if (session('storestatus'))
               <div class="alert alert-success" role="alert">
                 <span style="color:green"> {{ session('storestatus') }}</span>
               </div>
            @endif
            <br>
            
        </div>
    </div>
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
    
    
                        {{--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>  --}}
                      {{--  <a  data-toggle="modal" data-target="#questiontypemodal" data-examid="{{$exam->id}}" data-examtitle="{{$exam->title}}" class="addqnbtn btn btn-primary">Add Questions</a>   --}}
                      
                    </div>
                    <div class="card-footer formheader text-muted">
                           Updated On {{$exam->updated_at}}
                    </div>
                  </div>
                </div>
    
                @endforeach
                </div>
                <hr>
                <h4>Exams Available to students</h4>
                <hr>
                <table class="table  table-striped" border="2px">
                    <tr class="formheader"><th>Exam Id</th><th>Batch Id</th><th>Action</th></tr>
            @foreach($conductexam as $ce)
            <tr><td> {{$ce->examidfk}} </td><td>{{$ce->batchfk}}</td>
                <td>
                    <a class="btn btn-danger waves-effect waves-light remove-record text-white" data-toggle="modal" data-url="{!! URL::route('admin.deleteconductedexam', $ce->id) !!}" data-sub_id="{{$ce->id}}" data-target="#custom-width-modal">Delete</a>
                </td>
            </tr>
            @endforeach
</div>
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
@endsection
 @section('deletemodal')
   <script src="{{ asset('js/deletemodal.js') }}"></script>
@endsection