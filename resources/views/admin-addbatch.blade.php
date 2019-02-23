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
                <div class="card-header formheader">Add Batch</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.crbatch') }}" aria-label="{{ __('Addbatch') }}">
                        @csrf

                       

                        <div class="form-group row">
                            <label for="batch" class="col-md-4 col-form-label text-md-right">{{ __('Batch No') }}</label>

                            <div class="col-md-6">
                                <input id="batch" type="text" class="form-control{{ $errors->has('batch') ? ' is-invalid' : '' }}" name="batch" value="{{ old('batch') }}" required autofocus>

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
            <div>
                <h4>Batches</h4>
                <hr>
                <table class="table  table-striped" border="2px">
                    <tr class="formheader"><th>S.No</th><th>Batch</th> <th>Action</th> </tr>
            @foreach($batches as $batch)
            <tr><td> {{$batch->id}} </td><td>{{$batch->batch}}</td>
               <td> 
                    <a class="btn btn-danger waves-effect waves-light remove-record float-right text-white" data-toggle="modal" data-url="{!! URL::route('admin.deletebatch', $batch->id) !!}" data-sub_id="{{$batch->id}}" data-target="#custom-width-modal">Delete</a>

               </td>
            </tr>

@endforeach
                </table>
            </div>
        </div>
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
@endsection
@section('deletemodal')
         <script src="{{ asset('js/deletemodal.js') }}"></script>
@endsection