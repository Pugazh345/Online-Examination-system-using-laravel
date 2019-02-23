<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/site.js') }}"></script>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}">
    


   
    </head>
    <body>
         
      <nav class="navbar navbar-expand-sm bg-dark justify-content-center">
        <ul class="navbar-nav">
         
          <li class="nav-item">
            <a class="nav-link navbar-brand-logo" href="#">{!! "e'Sac Exams" !!}</a>
          </li>
          
        </ul>
        <ul  class="navbar-nav ml-auto login btn navlogin ">
                     
            {{-- <ul class="navbar-nav ml-auto"> --}}
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
                            <a class="btn btn-danger" href="{{ route('user.logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
            
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        {{-- </div> --}}
                    </li>
                @endguest
            {{-- </ul> --}}
         </ul>  
      </nav>
                  @yield('frommain')
                  <!-- Footer -->
        <footer class="page-footer font-small indigo">
        
       
            <!-- Copyright -->
            <div class="footer-copyright text-center py-2">
             <p class="text-center">© 2018 Copyright: {!! "e'sac" !!}.</p>
             <p class="credits">Designed And Developed By <a href="http://bswin.in/"> BSWIN</a></p>
            </div>
            <!-- Copyright -->
        
          </footer>
          <!-- Footer -->
         
    </body>
    
<script>
    $(document).ready(function(){
    function toggleIcon(e) {
      $(e.target)
          .prev('.panel-heading')
          .find(".more-less")
          .toggleClass('fas fa-plus fas fa-minus');
          
  }
  $('.panel-group').on('hidden.bs.collapse', toggleIcon);
  $('.panel-group').on('shown.bs.collapse', toggleIcon);
});
</script>

          </html>
