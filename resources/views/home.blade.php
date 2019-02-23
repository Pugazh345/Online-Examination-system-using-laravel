@extends('layouts.student-layout')

@section('title',"Esac exams")
@section('frommain')

<div class="container fwrap">
    <div class="container">
                @if(!empty($result))
                   <h5>You have completed Your exam and Your score is {{$result->marks}} </h5>
                @else
                @if ($batches->isEmpty())
                <h5 class="text-center">You dont have exam today</h5>
                @else 
                {{--  @foreach ($exam as $exam)  --}}
                    
                 <div class="card text-center">
                    <div class="card-header formheader">
                  <h5>{{ $exam->title }} </h5>
                      
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Important Instructions for Exam</h5>
                      <p class="card-text"> <h6> {{ $exam->instructions }} </h6></p>
                      <p class="card-text"> <h6> Total number of questions {{ $exam->noofqns }} Mark </h6></p>
                      <p class="card-text"> <h6> Each Question Carries {{ $exam->mark }} Mark </h6></p>
                      <p class="card-text"> <h6> Duration {{ $exam->time }} Minutes </h6></p>
                      <p class="card-text bg-danger text-white">If failed to click submit button before the given time, Submission wont be considered and mark will be 0</p>
                      <a href="{{ route('user.startexam',$exam->id) }}" class="btn btn-success startexam">Start Exam</a>
                    </div>
                    <div class="card-footer  formheader">
                      All the Best!
                    </div>
                  </div>
                  {{--  @endforeach  --}}
                  @endif
                  @endif
              </div>

</div>

        @endsection