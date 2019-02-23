@extends('layouts.student-layout')

@section('title',"Esac exams")
@section('frommain')
<div class="container fwrap">
    <div class="container">

        @if (session('success'))
        <div class="alert alert-success" role="alert">
          <span style="color:green"> {{ session('success') }}</span>
        </div>
        @endif
        
        @if (session('failed'))
        <div class="alert alert-danger" role="alert">
          <span style="color:red"> {{ session('failed') }}</span>
        </div>
        @endif
              </div>

</div>
        @endsection