@extends('layouts.student-layout')

@section('title',"Esac exams")
@section('frommain')

<div class="container fwrap" id="fwrap">
    {{-- @foreach ($obj as $ob)
                        
    <div class="card text-center">
       <div class="card-header formheader float-left">
     <h5>Question {{ $ob->id }} </h5>
         
       </div>
    </div>
    @endforeach
    {!! $obj->links() !!}  
        --}}
    <div class="container">
        @if (session('fail'))
        <div class="alert alert-danger" role="alert">
          <span style="color:red"> {{ session('fail') }}</span>
        </div>
        @else

        <div id='timer' style="float: right;">
  
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
        
            $("#timer").children().attr("disabled",false);
            timerimg();
           setTimeout(function() {
                   $("form").submit();
        
                },{{ $duration->time }}*60000);
        
        
        function timerimg(){
          var myCountdownTest = new Countdown({
                                  time: {{ $duration->time }}*60, 
                                  width:200, 
                                  height:80, 
                                  rangeHi:"minute",
                                  target    : "timer",
                                  });
            }
          
        });
            </script>
          <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#seca">Section A </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#secb">Section B</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#secc">Section C</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#secd">Section D</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#sece">Section E</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#secf">Section F</a>
        </li>
      </ul>
      <form method="POST" action="{{ route('user.submitexam') }}" aria-label="{{ __('submitexam') }}">
          @csrf
      <input type="hidden" value="{{ $examid }}" name="examid">
      <div class="tab-content">
        <div id="seca" class="tab-pane container  active">
          

              <div class="tab-content">
              @foreach ($obj as $key=>$ob)
              @if($key==0)
              <div class="tab-pane container active show" id="{{ $key+1 }}">

                  <div class="card text-center w-100" >
                     <div class="card-header formheader float-left">
                   <h5>Question {{ $ob->id }} </h5>
                       
                     </div>
                     <div class="card-body funkyradio ">
                       <h5 class="card-text float-left">{{ $ob->question }}</h5>
                         <div class="text-md-left funkyradio-primary ">
 
                             <input id="opta{{ $ob->id }}" type="radio" value="1" class="form-control{{ $errors->has('opta$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('opta$ob->id') }}" >
                             <label for="opta{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiona }}</label>
 
                             @if ($errors->has('opta$ob->id'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('opta$ob->id') }}</strong>
                                 </span>
                             @endif
                         
                     </div> 
                     <div class="text-md-left funkyradio-primary ">
 
                         <input id="optb{{ $ob->id }}" type="radio" value="2" class="form-control{{ $errors->has('optb$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optb$ob->id') }}" >
                         <label for="optb{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionb }}</label>
 
                         @if ($errors->has('optb$ob->id'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('optb$ob->id') }}</strong>
                             </span>
                         @endif
                     
                 </div> 
                 <div class="text-md-left funkyradio-primary ">
 
                     <input id="optc{{ $ob->id }}" type="radio" value="3" class="form-control{{ $errors->has('optc$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optc$ob->id') }}" >
                     <label for="optc{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionc }}</label>
 
                     @if ($errors->has('optc$ob->id'))
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('optc$ob->id') }}</strong>
                         </span>
                     @endif
                 
             </div> 
             <div class="text-md-left funkyradio-primary ">
 
                 <input id="optd{{ $ob->id }}" type="radio" value="4" class="form-control{{ $errors->has('optd$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optd$ob->id') }}" >
                 <label for="optd{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiond }}</label>
 
                 @if ($errors->has('optd$ob->id'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('optd$ob->id') }}</strong>
                     </span>
                 @endif
             
         </div> 
                     </div>
                     <div class="card-footer  formheader">
                       All the Best!
                     </div>
                   </div>
                 </div> 
           
              @else
                        <div class="tab-pane fade container" id="{{ $key+1 }}">

                 <div class="card text-center " >
                    <div class="card-header formheader float-left">
                  <h5>Question {{ $ob->id }} </h5>
                      
                    </div>
                    <div class="card-body funkyradio ">
                      <h5 class="card-text float-left">{{ $ob->question }}</h5>
                        <div class="text-md-left funkyradio-primary ">

                            <input id="opta{{ $ob->id }}" type="radio" value="1" class="form-control{{ $errors->has('opta$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('opta$ob->id') }}" >
                            <label for="opta{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiona }}</label>

                            @if ($errors->has('opta$ob->id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('opta$ob->id') }}</strong>
                                </span>
                            @endif
                        
                    </div> 
                    <div class="text-md-left funkyradio-primary ">

                        <input id="optb{{ $ob->id }}" type="radio" value="2" class="form-control{{ $errors->has('optb$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optb$ob->id') }}" >
                        <label for="optb{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionb }}</label>

                        @if ($errors->has('optb$ob->id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('optb$ob->id') }}</strong>
                            </span>
                        @endif
                    
                </div> 
                <div class="text-md-left funkyradio-primary ">

                    <input id="optc{{ $ob->id }}" type="radio" value="3" class="form-control{{ $errors->has('optc$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optc$ob->id') }}" >
                    <label for="optc{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionc }}</label>

                    @if ($errors->has('optc$ob->id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('optc$ob->id') }}</strong>
                        </span>
                    @endif
                
            </div> 
            <div class="text-md-left funkyradio-primary ">

                <input id="optd{{ $ob->id }}" type="radio" value="4" class="form-control{{ $errors->has('optd$ob->id') ? ' is-invalid' : '' }}" name="opt{{ $ob->id }}" value="{{ old('optd$ob->id') }}" >
                <label for="optd{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiond }}</label>

                @if ($errors->has('optd$ob->id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('optd$ob->id') }}</strong>
                    </span>
                @endif
            
        </div> 
                    </div>
                    <div class="card-footer  formheader">
                      All the Best!
                    </div>
                  </div>
                </div> 
                  @endif
                   @endforeach
              </div>
                   <hr>
                   <ul class="nav nav-tabs pagination pagination-lg">
                      <!--<li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#1">1</a></li>-->
          
                      @for ($i = 1; $i<=$objcount ; $i++)
                        
                            
                            <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#{{$i}}">{{$i}}</a></li>
                          
                          @endfor 
                        </ul>
                   
              </div>

        
      <div id="secb" class="tab-pane fade">
        

          <div class="tab-content">
              @foreach ($objimg as $key=>$obi)
              @if($key==0)
              <div class="tab-pane container active show" id="obi{{ $key+1 }}">

                  <div class="card text-center w-100" >
                     <div class="card-header formheader float-left">
                   <h5>Question {{ $obi->id }} </h5>
                     </div>
                     <div class="card-body funkyradio ">
                       {{-- <h5 class="card-text float-left">{{ $obi->question }}</h5> --}}
                   <img src="{{ asset('storage/app/public/')}}{{ $obi->question }}" class="w-100" alt="">

                         <div class="text-md-left funkyradio-primary ">
 
                             <input id="optia{{ $obi->id }}" type="radio" value="1" class="form-control{{ $errors->has('optia$obi->id') ? ' is-invalid' : '' }}" name="opti{{ $obi->id }}" value="{{ old('optia$obi->id') }}" >
                             <label for="optia{{ $obi->id }}" class="col-md-4  ">{{ $obi->optiona }}</label>
 
                             @if ($errors->has('optia$obi->id'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('optia$obi->id') }}</strong>
                                 </span>
                             @endif
                         
                     </div> 
                     <div class="text-md-left funkyradio-primary ">
 
                         <input id="optib{{ $obi->id }}" type="radio" value="2" class="form-control{{ $errors->has('optib$obi->id') ? ' is-invalid' : '' }}" name="opti{{ $obi->id }}" value="{{ old('optib$obi->id') }}" >
                         <label for="optib{{ $obi->id }}" class="col-md-4  ">{{ $obi->optionb }}</label>
 
                         @if ($errors->has('optib$obi->id'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('optib$obi->id') }}</strong>
                             </span>
                         @endif
                     
                 </div> 
                 <div class="text-md-left funkyradio-primary ">
 
                     <input id="optic{{ $obi->id }}" type="radio" value="3" class="form-control{{ $errors->has('optic$obi->id') ? ' is-invalid' : '' }}" name="opti{{ $obi->id }}" value="{{ old('optic$obi->id') }}" >
                     <label for="optic{{ $obi->id }}" class="col-md-4  ">{{ $obi->optionc }}</label>
 
                     @if ($errors->has('optic$obi->id'))
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('optic$obi->id') }}</strong>
                         </span>
                     @endif
                 
             </div> 
             <div class="text-md-left funkyradio-primary ">
 
                 <input id="optid{{ $obi->id }}" type="radio" value="4" class="form-control{{ $errors->has('optid$obi->id') ? ' is-invalid' : '' }}" name="opti{{ $obi->id }}" value="{{ old('optid$obi->id') }}" >
                 <label for="optid{{ $obi->id }}" class="col-md-4  ">{{ $obi->optiond }}</label>
 
                 @if ($errors->has('optid$obi->id'))
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('optid$obi->id') }}</strong>
                     </span>
                 @endif
             
         </div> 
                     </div>
                     <div class="card-footer  formheader">
                       All the Best!
                     </div>
                   </div>
                 </div> 
           
              @else
                        <div class="tab-pane fade container" id="obi{{ $key+1 }}">

                 <div class="card text-center " >
                    <div class="card-header formheader float-left">
                  <h5>Question {{ $obi->id }} </h5>
                      
                    </div>
                    <div class="card-body funkyradio ">
                      {{-- <h5 class="card-text float-left">{{ $obi->question }}</h5> --}}
                   <img src="{{ asset('storage/')}}{{ $obi->question }}" class="w-100" alt="">

                        <div class="text-md-left funkyradio-primary ">

                            <input id="optia{{ $obi->id }}" type="radio" value="1" class="form-control{{ $errors->has('optia$ob->id') ? ' is-invalid' : '' }}" name="opti{{ $ob->id }}" value="{{ old('optia$ob->id') }}" >
                            <label for="optia{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiona }}</label>

                            @if ($errors->has('optia$ob->id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('optia$ob->id') }}</strong>
                                </span>
                            @endif
                        
                    </div> 
                    <div class="text-md-left funkyradio-primary ">

                        <input id="optib{{ $ob->id }}" type="radio" value="2" class="form-control{{ $errors->has('optib$ob->id') ? ' is-invalid' : '' }}" name="opti{{ $ob->id }}" value="{{ old('optib$ob->id') }}" >
                        <label for="optib{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionb }}</label>

                        @if ($errors->has('optb$ob->id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('optb$ob->id') }}</strong>
                            </span>
                        @endif
                    
                </div> 
                <div class="text-md-left funkyradio-primary ">

                    <input id="optic{{ $ob->id }}" type="radio" value="3" class="form-control{{ $errors->has('optic$ob->id') ? ' is-invalid' : '' }}" name="opti{{ $ob->id }}" value="{{ old('optic$ob->id') }}" >
                    <label for="optic{{ $ob->id }}" class="col-md-4  ">{{ $ob->optionc }}</label>

                    @if ($errors->has('optic$ob->id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('optic$ob->id') }}</strong>
                        </span>
                    @endif
                
            </div> 
            <div class="text-md-left funkyradio-primary ">

                <input id="optid{{ $ob->id }}" type="radio" value="4" class="form-control{{ $errors->has('optid$ob->id') ? ' is-invalid' : '' }}" name="opti{{ $ob->id }}" value="{{ old('optid$ob->id') }}" >
                <label for="optid{{ $ob->id }}" class="col-md-4  ">{{ $ob->optiond }}</label>

                @if ($errors->has('optid$ob->id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('optid$ob->id') }}</strong>
                    </span>
                @endif
            
        </div> 
                    </div>
                    <div class="card-footer  formheader">
                      All the Best!
                    </div>
                  </div>
                </div> 
                  @endif
                   @endforeach
              </div>
                   <hr>
                   <ul class="nav nav-tabs pagination pagination-lg">
                      <li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#obi1">1</a></li>
          
                      @for ($i = 2; $i<=$objimgcount ; $i++)
                        
                            
                            <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#obi{{$i}}">{{$i}}</a></li>
                          
                          @endfor 
                        </ul> 
        </div> 
        <div id="secc" class="tab-pane fade">
        
            <div class="tab-content">
                @foreach ($fillup as $key=>$fill)
                @if($key==0)
                <div class="tab-pane container active show" id="fill{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                       <div class="card-header formheader float-left">
                     <h5>Question {{ $fill->id }} </h5>
                       </div>
                       <div class="card-body ">
                         <h4 class="card-title float-left">{{ $fill->question }}</h4>
                     
  
                       <div class="form-group row text-md-left w-100">
                          <label for="fillans{{ $fill->id }}" class="col-md-4  "><h5>Answer:</h5></label>

                          <div class="col-md-6">
                              <input id="fillans{{ $fill->id }}" type="text"  class="form-control{{ $errors->has('fillans$fill->id') ? ' is-invalid' : '' }}" name="fillans{{ $fill->id }}" value="{{ old('fillans$fill->id') }}" >
                              @if ($errors->has('fillans$fill->id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('fillans$fill->id') }}</strong>
                              </span>
                          @endif
                          </div>
                      </div>
                       </div>
                       <div class="card-footer  formheader">
                         All the Best!
                       </div>
                     </div>
                   </div> 
             
                @else
                <div class="tab-pane container fade" id="fill{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                        <div class="card-header formheader float-left">
                      <h5>Question {{ $fill->id }} </h5>
                        </div>
                        <div class="card-body ">
                          <h4 class="card-title float-left">{{ $fill->question }}</h4>
                      
   
                        <div class="form-group row text-md-left w-100">
                           <label for="fillans{{ $fill->id }}" class="col-md-4  "><h5>Answer:</h5></label>
 
                           <div class="col-md-6">
                               <input id="fillans{{ $fill->id }}" type="text"  class="form-control{{ $errors->has('fillans$fill->id') ? ' is-invalid' : '' }}" name="fillans{{ $fill->id }}" value="{{ old('fillans$fill->id') }}" >
                               @if ($errors->has('fillans$fill->id'))
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('fillans$fill->id') }}</strong>
                               </span>
                           @endif
                           </div>
                       </div>
                        </div>
                        <div class="card-footer  formheader">
                          All the Best!
                        </div>
                      </div>
                   </div> 
                       
                    @endif
                     @endforeach
                </div>
                     <hr>
                     <ul class="nav nav-tabs pagination pagination-lg">
                        <li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#fill1">1</a></li>            
                        @for ($i = 2; $i<=$fillupcount ; $i++)                                                        
                              <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#fill{{$i}}">{{$i}}</a></li>                            
                        @endfor 
                          </ul>
            
        </div>
        <div id="secd" class="tab-pane fade">
            <div class="tab-content">
                @foreach ($fillupimg as $key=>$filli)
                @if($key==0)
                <div class="tab-pane container active show" id="filli{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                       <div class="card-header formheader float-left">
                     <h5>Question {{ $filli->id }} </h5>
                       </div>
                       <div class="card-body ">
                         {{-- <h4 class="card-title float-left">{{ $filli->question }}</h4> --}}
                     
                         <img src="{{ asset('storage/app/public/')}}{{ $filli->question }}" class="w-100" alt="">
                       <div class="form-group row text-md-left w-100">
                          <label for="fillians{{ $filli->id }}" class="col-md-4  "><h5>Answer:</h5></label>

                          <div class="col-md-6">
                              <input id="fillians{{ $filli->id }}" type="text"  class="form-control{{ $errors->has('fillians$filli->id') ? ' is-invalid' : '' }}" name="fillians{{ $filli->id }}" value="{{ old('fillians$filli->id') }}" >
                              @if ($errors->has('fillians$filli->id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('fillians$filli->id') }}</strong>
                              </span>
                          @endif
                          </div>
                      </div>
                       </div>
                       <div class="card-footer  formheader">
                         All the Best!
                       </div>
                     </div>
                   </div> 
             
                @else
                <div class="tab-pane container fade" id="filli{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                        <div class="card-header formheader float-left">
                      <h5>Question {{ $filli->id }} </h5>
                        </div>
                        <div class="card-body ">
                          
    <img src="{{ asset('storage/app/public/')}}{{ $filli->question }}" class="w-100" alt="">
                        <div class="form-group row text-md-left w-100">
                           <label for="fillians{{ $filli->id }}" class="col-md-4  "><h5>Answer:</h5></label>
 
                           <div class="col-md-6">
                               <input id="fillians{{ $fill->id }}" type="text"  class="form-control{{ $errors->has('fillians$filli->id') ? ' is-invalid' : '' }}" name="fillians{{ $filli->id }}" value="{{ old('fillians$filli->id') }}" >
                               @if ($errors->has('fillians$filli->id'))
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('fillians$filli->id') }}</strong>
                               </span>
                           @endif
                           </div>
                       </div>
                        </div>
                        <div class="card-footer  formheader">
                          All the Best!
                        </div>
                      </div>
                   </div> 
                       
                    @endif
                     @endforeach
                </div>
                     <hr>
                     <ul class="nav nav-tabs pagination pagination-lg">
                        <li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#filli1">1</a></li>
            
                        @for ($i = 2; $i<=$fillupimgcount ; $i++)
                          
                              
                              <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#filli{{$i}}">{{$i}}</a></li>
                            
                            @endfor 
                          </ul>   
              
        </div>
        
        <div id="sece" class="tab-pane fade">
            <div class="tab-content">
                @foreach ($mtf as $key=>$mt)
                @if($key==0)
                <div class="tab-pane container active show" id="{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                       <div class="card-header formheader float-left">
                     <h5>Question {{ $mt->id }} </h5>
                         
                       </div>
                       <div class="card-body funkyradio ">
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
                         
                         <div class="text-md-left funkyradio-primary ">
   
                               <input id="mtfa{{ $mt->id }}" type="radio" value="1" class="form-control{{ $errors->has('mtfa$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfa$mt->id') }}" >
                               <label for="mtfa{{ $mt->id }}" class="col-md-4  ">{{ $mt->optiona }}</label>
   
                               @if ($errors->has('mtfa$mt->id'))
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('mtfa$mt->id') }}</strong>
                                   </span>
                               @endif
                           
                       </div> 
                       <div class="text-md-left funkyradio-primary ">
   
                           <input id="mtfb{{ $mt->id }}" type="radio" value="2" class="form-control{{ $errors->has('mtfb$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfb$mt->id') }}" >
                           <label for="mtfb{{ $mt->id }}" class="col-md-4  ">{{ $mt->optionb }}</label>
   
                           @if ($errors->has('mtfb$mt->id'))
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('mtfb$mt->id') }}</strong>
                               </span>
                           @endif
                       
                   </div> 
                   <div class="text-md-left funkyradio-primary ">
   
                       <input id="mtfc{{ $mt->id }}" type="radio" value="3" class="form-control{{ $errors->has('mtfc$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfc$mt->id') }}" >
                       <label for="mtfc{{ $mt->id }}" class="col-md-4  ">{{ $mt->optionc }}</label>
   
                       @if ($errors->has('mtfc$mt->id'))
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('mtfc$mt->id') }}</strong>
                           </span>
                       @endif
                   
               </div> 
               <div class="text-md-left funkyradio-primary ">
   
                   <input id="mtfd{{ $mt->id }}" type="radio" value="4" class="form-control{{ $errors->has('mtfd$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfd$mt->id') }}" >
                   <label for="mtfd{{ $mt->id }}" class="col-md-4  ">{{ $mt->optiond }}</label>
   
                   @if ($errors->has('mtfd$mt->id'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('mtfd$mt->id') }}</strong>
                       </span>
                   @endif
               
           </div> 
                       </div>
                       <div class="card-footer  formheader">
                         All the Best!
                       </div>
                     </div>
                   </div> 
             
                @else
                          <div class="tab-pane fade container" id="{{ $key+1 }}">
  
                   <div class="card text-center " >
                      <div class="card-header formheader float-left">
                    <h5>Question {{ $mt->id }} </h5>
                        
                      </div>
                      <div class="card-body funkyradio ">
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
                         
                          <div class="text-md-left funkyradio-primary ">
  
                              <input id="mtfa{{ $mt->id }}" type="radio" value="1" class="form-control{{ $errors->has('mtfa$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfa$mt->id') }}" >
                              <label for="mtfa{{ $mt->id }}" class="col-md-4  ">{{ $mt->optiona }}</label>
  
                              @if ($errors->has('mtfa$mt->id'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('mtfa$mt->id') }}</strong>
                                  </span>
                              @endif
                          
                      </div> 
                      <div class="text-md-left funkyradio-primary ">
  
                          <input id="mtfb{{ $mt->id }}" type="radio" value="2" class="form-control{{ $errors->has('mtfb$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfb$mt->id') }}" >
                          <label for="mtfb{{ $mt->id }}" class="col-md-4  ">{{ $mt->optionb }}</label>
  
                          @if ($errors->has('mtfb$mt->id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('mtfb$mt->id') }}</strong>
                              </span>
                          @endif
                      
                  </div> 
                  <div class="text-md-left funkyradio-primary ">
  
                      <input id="mtfc{{ $mt->id }}" type="radio" value="3" class="form-control{{ $errors->has('mtfc$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfc$mt->id') }}" >
                      <label for="mtfc{{ $mt->id }}" class="col-md-4  ">{{ $mt->optionc }}</label>
  
                      @if ($errors->has('mtfc$mt->id'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('mtfc$mt->id') }}</strong>
                          </span>
                      @endif
                  
              </div> 
              <div class="text-md-left funkyradio-primary ">
  
                  <input id="mtfd{{ $mt->id }}" type="radio" value="4" class="form-control{{ $errors->has('mtfd$mt->id') ? ' is-invalid' : '' }}" name="mtf{{ $mt->id }}" value="{{ old('mtfd$mt->id') }}" >
                  <label for="mtfd{{ $mt->id }}" class="col-md-4  ">{{ $mt->optiond }}</label>
  
                  @if ($errors->has('mtfd$mt->id'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('mtfd$mt->id') }}</strong>
                      </span>
                  @endif
              
          </div> 
                      </div>
                      <div class="card-footer  formheader">
                        All the Best!
                      </div>
                    </div>
                  </div> 
                    @endif
                     @endforeach
                </div>
                     <hr>
                     <ul class="nav nav-tabs pagination pagination-lg">
                        <li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#1">1</a></li>
            
                        @for ($i = 2; $i<=$mtfcount ; $i++)
                          
                              
                              <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#{{$i}}">{{$i}}</a></li>
                            
                            @endfor 
                          </ul>  
        </div>
        <div id="secf" class="tab-pane fade">
            <div class="tab-content">
                @foreach ($mtfimg as $key=>$mti)
                @if($key==0)
                <div class="tab-pane container active show" id="{{ $key+1 }}">
  
                    <div class="card text-center w-100" >
                       <div class="card-header formheader float-left">
                     <h5>Question {{ $mti->id }} </h5>
                         
                       </div>
                       <div class="card-body funkyradio ">
                         {{-- <h5 class="card-text float-left">{{ $mti->question }}</h5> --}}
                         <img src="{{ asset('storage/app/public/')}}{{ $mti->question }}" class="w-100" alt="">
                         <table class="table">
                            <thead class="formheader">
                              <tr>
                                <th>{{ $mti->columna }}</th>
                                <th>{{ $mti->columna }}</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $mti->ca1 }}</td>
                                <td>{{ $mti->cb1 }}</td>
                                
                              </tr>
                              <tr>
                                  <td>{{ $mti->ca2 }}</td>
                                  <td>{{ $mti->cb2 }}</td>
                                  
                              </tr>
                              <tr>
                                  <td>{{ $mti->ca3 }}</td>
                                  <td>{{ $mti->cb3 }}</td>
                                  
                              </tr>
                              
                              <tr>
                                  <td>{{ $mti->ca4 }}</td>
                                  <td>{{ $mti->cb4 }}</td>
                                  
                              </tr>
                              
                              <tr>
                                  <td></td>
                                  <td>{{ $mti->cb5 }}</td>
                                  
                              </tr>
                            </tbody>
                          </table>
                         
                         <div class="text-md-left funkyradio-primary ">
   
                               <input id="mtfia{{ $mti->id }}" type="radio" value="1" class="form-control{{ $errors->has('mtfia$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfia$mti->id') }}" >
                               <label for="mtfia{{ $mti->id }}" class="col-md-4  ">{{ $mti->optiona }}</label>
   
                               @if ($errors->has('mtfia$mti->id'))
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('mtfia$mti->id') }}</strong>
                                   </span>
                               @endif
                           
                       </div> 
                       <div class="text-md-left funkyradio-primary ">
   
                           <input id="mtfib{{ $mti->id }}" type="radio" value="2" class="form-control{{ $errors->has('mtfib$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfib$mti->id') }}" >
                           <label for="mtfib{{ $mti->id }}" class="col-md-4  ">{{ $mti->optionb }}</label>
   
                           @if ($errors->has('mtfib$mti->id'))
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('mtfib$mti->id') }}</strong>
                               </span>
                           @endif
                       
                   </div> 
                   <div class="text-md-left funkyradio-primary ">
   
                       <input id="mtfic{{ $mti->id }}" type="radio" value="3" class="form-control{{ $errors->has('mtfic$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfic$mti->id') }}" >
                       <label for="mtfic{{ $mti->id }}" class="col-md-4  ">{{ $mti->optionc }}</label>
   
                       @if ($errors->has('mtfic$mti->id'))
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('mtfic$mti->id') }}</strong>
                           </span>
                       @endif
                   
               </div> 
               <div class="text-md-left funkyradio-primary ">
   
                   <input id="mtfid{{ $mti->id }}" type="radio" value="4" class="form-control{{ $errors->has('mtfid$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfid$mti->id') }}" >
                   <label for="mtfid{{ $mti->id }}" class="col-md-4  ">{{ $mti->optiond }}</label>
   
                   @if ($errors->has('mtfid$mti->id'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('mtfid$mti->id') }}</strong>
                       </span>
                   @endif
               
           </div> 
                       </div>
                       <div class="card-footer  formheader">
                         All the Best!
                       </div>
                     </div>
                   </div> 
             
                @else
                          <div class="tab-pane fade container" id="{{ $key+1 }}">
  
                   <div class="card text-center " >
                      <div class="card-header formheader float-left">
                    <h5>Question {{ $mti->id }} </h5>
                        
                      </div>
                      <div class="card-body funkyradio ">
                        {{-- <h5 class="card-text float-left">{{ $mti->question }}</h5> --}}
                        <img src="{{ asset('storage/app/public/')}}{{ $mti->question }}" class="w-100" alt="">
                        <table class="table">
                            <thead class="formheader">
                              <tr>
                                <th>{{ $mti->columna }}</th>
                                <th>{{ $mti->columna }}</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $mti->ca1 }}</td>
                                <td>{{ $mti->cb1 }}</td>
                                
                              </tr>
                              <tr>
                                  <td>{{ $mti->ca2 }}</td>
                                  <td>{{ $mti->cb2 }}</td>
                                  
                              </tr>
                              <tr>
                                  <td>{{ $mti->ca3 }}</td>
                                  <td>{{ $mti->cb3 }}</td>
                                  
                              </tr>
                              
                              <tr>
                                  <td>{{ $mti->ca4 }}</td>
                                  <td>{{ $mti->cb4 }}</td>
                                  
                              </tr>
                              
                              <tr>
                                  <td></td>
                                  <td>{{ $mti->cb5 }}</td>
                                  
                              </tr>
                            </tbody>
                          </table>
                         
                          <div class="text-md-left funkyradio-primary ">
  
                              <input id="mtfia{{ $mti->id }}" type="radio" value="1" class="form-control{{ $errors->has('mtfia$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfia$mti->id') }}" >
                              <label for="mtfia{{ $mti->id }}" class="col-md-4  ">{{ $mti->optiona }}</label>
  
                              @if ($errors->has('mtfia$mti->id'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('mtfia$mti->id') }}</strong>
                                  </span>
                              @endif
                          
                      </div> 
                      <div class="text-md-left funkyradio-primary ">
  
                          <input id="mtfib{{ $mti->id }}" type="radio" value="2" class="form-control{{ $errors->has('mtfib$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfib$mti->id') }}" >
                          <label for="mtfib{{ $mti->id }}" class="col-md-4  ">{{ $mti->optionb }}</label>
  
                          @if ($errors->has('mtfib$mti->id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('mtfib$mti->id') }}</strong>
                              </span>
                          @endif
                      
                  </div> 
                  <div class="text-md-left funkyradio-primary ">
  
                      <input id="mtfic{{ $mti->id }}" type="radio" value="3" class="form-control{{ $errors->has('mtfic$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfic$mti->id') }}" >
                      <label for="mtfic{{ $mti->id }}" class="col-md-4  ">{{ $mti->optionc }}</label>
  
                      @if ($errors->has('mtfic$mti->id'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('mtfic$mti->id') }}</strong>
                          </span>
                      @endif
                  
              </div> 
              <div class="text-md-left funkyradio-primary ">
  
                  <input id="mtfid{{ $mti->id }}" type="radio" value="4" class="form-control{{ $errors->has('mtfid$mti->id') ? ' is-invalid' : '' }}" name="mtfi{{ $mti->id }}" value="{{ old('mtfid$mti->id') }}" >
                  <label for="mtfid{{ $mti->id }}" class="col-md-4  ">{{ $mti->optiond }}</label>
  
                  @if ($errors->has('mtfid$mti->id'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('mtfid$mti->id') }}</strong>
                      </span>
                  @endif
              
          </div> 
                      </div>
                      <div class="card-footer  formheader">
                        All the Best!
                      </div>
                    </div>
                  </div> 
                    @endif
                     @endforeach
                </div>
                     <hr>
                     <ul class="nav nav-tabs pagination pagination-lg">
                        <li class="page-item"><a class="nav-link active show page-link " data-toggle="tab" href="#1">1</a></li>
            
                        @for ($i = 2; $i<=$mtfimgcount ; $i++)
                          
                              
                              <li class="page-item"><a class="nav-link page-link" data-toggle="tab" href="#{{$i}}">{{$i}}</a></li>
                            
                            @endfor 
                          </ul>  
        </div>

      
      </div>
      </div>
      <button type="submit" class="btn  btn-success float-right">
          {{ __('Finish Exam') }}
      </button>
    </div>
  </form>
 
  @endif

</div>
</div>       

    @endsection