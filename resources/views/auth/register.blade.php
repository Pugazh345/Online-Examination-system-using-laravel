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
        <li class="nav-item">
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

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header formheader">{{ __('Student Registration Form') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userid" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="userid" type="text" class="form-control{{ $errors->has('userid') ? ' is-invalid' : '' }}" name="userid" value="{{ old('userid') }}" required>

                                @if ($errors->has('userid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="mobilenum" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
    
                                <div class="col-md-6">
                                    <input id="mobilenum" type="tel" class="form-control" name="mobilenum" required>
                                    @if ($errors->has('mobilenum'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobilenum') }}</strong>
                                    </span>
                                @endif
                                </div>
                               
                            </div>
                            
                               
                            <div class="form-group row">
                                <label for="batch" class="col-md-4 col-form-label text-md-right">{{ __('Batch 
                                    No') }}</label>
                    
                                <div class="col-md-6">
                                                      
                                <select class="form-control{{ $errors->has('batch') ? ' is-invalid' : '' }} btn btn-outline-secondary dropdown-toggle" name="batch">
                                    
                                  
                                  @foreach($batches as $batch)
                                  
                                  <option  value={{$batch->batch}}>{{$batch->id}} | {{$batch->batch}} </option>
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
                                    {{ __('Register') }}
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
            <div>
                    <h4>Students List</h4>
                    <hr>
                    <table class="table table-striped w-100" border="2px">


                        <tr class="formheader text-center"><th>Id</th><th>Name</th><th>User Id</th><th>Batch Id</th><th>E-Mail Address</th><th>Mobile No</th><th colspan="2">Action</th></tr>
                        @if (@users)
                            
                @foreach($users as $user)
                    
                
                <tr><td> {{$user->id}} </td><td>{{$user->name}}</td><td>{{$user->userid}}</td><td>{{$user->batchfk}}</td><td>{{$user->email}}</td><td>{{$user->mobilenumber}}</td><td><a class="btn btn-primary waves-effect waves-light edit-record float-right text-white " data-toggle="modal" data-url="{!! URL::route('admin.editstudent', $user->id) !!}" data-sub_id="{{$user->id}}" data-target="#edit-record-modal">Change Password</a> </td> <td> <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletestudent', $user->id) !!}" data-sub_id="{{$user->id}}" data-target="#custom-width-modal">Delete</a></td>
                    
                </tr>
    
    
    @endforeach
    @endif

</table>
                </div>
                @if (session('success'))
               <div class="alert alert-success" role="alert">
                 <span style="color:green"> {{ session('success') }}</span>
               </div>
            @endif
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
                    <h6>You Want You Sure Delete This Record?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>

</form>

<!-- Edit Modal -->
<form action=""  class="edit-record-model" method="POST">
    <div id="edit-record-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-record-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="edit-record-modalLabel">Edit Record</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
           
                    
           
                

                  <div class="form-group row">
                    <label for="edpassword" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="edpassword" type="password" class="form-control{{ $errors->has('edpassword') ? ' is-invalid' : '' }}" name="edpassword" required>

                        @if ($errors->has('edpassword'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('edpassword') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edpassword-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="edpassword-confirm" type="password" class="form-control" name="edpassword_confirmation" required>
                    </div>
                </div>  
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Make Changes</button>
                </div>
            </div>
        </div>
    </div>

</form>

<a class="btn btn-success" href="{{ route("admin.export") }}" >Download Student List</a>


@endsection

@section('deletemodal')
<script  src="{{ asset('js/deletemodal.js') }}"></script>
@endsection




