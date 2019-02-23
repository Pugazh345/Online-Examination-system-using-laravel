<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __("e'Sac") }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/homestyle.css') }}">

    <!-- Styles -->
    

   <style>
       .conttop{
          margin-top: 100px;
       }
       .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
      }
      
      .switch input {display:none;}
      
      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }
      
      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }
      
      input:checked + .slider {
        background-color: #2196F3;
      }
      
      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }
      
      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }
      
      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }
      
      .slider.round:before {
        border-radius: 50%;
      }
  
    .hero {
        padding-top: 150px;
        background-image: url("../images/hero.jpg");
        background-size: cover;
        background-position: center center;
    }
   </style>
</head>
<body>
   
   <div class="wrapper ">
        <!-- Sidebar  -->
        <nav id="sidebar" class="col-md-2 hero">
            <div class="sidebar-header">
                
                <h3>{!! "e'Sac" !!}</h3>
            </div>

            

            <ul class="list-unstyled CTAs">
                    <li>
                    
                            <a href="{{ route('admin.dashboard') }}" class="download"> Home </a>
        
                        </li>
                        <li>
                            <a href="{{ route('admin.vcrbatch') }}" class="article">Add Batch</a>
                        </li>
                <li>
                    <a href="{{ route('admin.regstudent') }}" class="article"> Student Registration</a>
                </li>
                <li>
                    
                        <a href="{{ route('admin.vcrexam') }}" class="article">Add Exam</a>
    
                    </li>
                    <li>
                    
                        <a href="{{ route('admin.addqnexamdisp') }}" class="article">Add Questions</a>
    
                    </li>
                    <li>
                    
                            <a href="{{ route('admin.conductexamview') }}" class="article">Conduct Exam</a>
        
                        </li>
                
            </ul>
            
        </nav>
        <div id="content" class="col-md-10">
                
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" style="float:left;">
                            <i class="fas fa-align-left"></i>
                            {{-- <span>Toggle Sidebar</span> --}}
                        </button> 
                       
    
            
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                       @yield('rightnavcontent')
                 
                </div>
            </div>
        </nav>
        
     
        {{--  <main class="py-4">  --}}
            @yield('content')
        {{--  </main>  --}}
    </div>
        </div>
        </div>
   @yield('deletemodal')
   <script type="text/javascript">
    
    $(document).ready(function(){
        // For A Delete Record Popup
        $('.addqnbtn').click(function() {
    
            var examid = $(this).data('examid');
            var examtitle = $(this).attr('data-examtitle');

            $(".modal-body #examid").val( examid );
            $(".modal-body #examtitle").val( examtitle );
    
        });
    
    });
    
    </script>
    {{--  @if (count($errors) > 0)

    <script >
        $(document).ready(function() {
            $('#obj-modal').modal('show');
        });
        </script>
        @endif  --}}
</body>

</html>

