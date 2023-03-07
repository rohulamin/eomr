<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Type OMR Form entry from Exam Center</title>
    <link href="{{asset('bootstrap-3.3.7/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap-3.3.7/dist/css/bootstrap-theme.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('style-main.css')}}">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<script src="{{asset('select2/dist/js/select2.min.js')}}" type='text/javascript'></script>

        <link href="{{asset('select2/dist/css/select2.min.css')}}" rel='stylesheet' type='text/css'>

<script type="text/javascript" src="{{asset('jquery.min.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style type="text/css">
     .error{ color:red; } 
  .alert {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid transparent;
    border-radius: 4px;
}

#login-section{

   overflow: auto;
    width: 80%;
    background-image: linear-gradient(green, yellow);
    margin: 2%;
    margin-left: 10%;
}
#morningtune{
    color: #C71;
    background-color: #EEC;
    padding: 10px;
    margin-bottom: 10px;
}
#logimg{
    background-image: url('{{ asset("img/images.jpg")}}');
}

</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
  </head>
<body style="background-image: url('{{ asset("img/bg.png")}}');"> 
<div> 

<header id="masthead" class="site-header" role="banner"><!--Start Header-->
            <section class="header">
               
                <div class="container"><!--Start Website Heading-->
                    <div class="row">
                        <div class="col-sm-3">
            <a href="{{URL::to('/')}}"><img class="img-responsive logo" src="{{URL::to('img/iau-logo.png')}}" alt="logo"></a>
                        </div>
                        <div class="col-sm-6">
                            <h1 class="title text-center kalpurush"><a href="{{URL::to('/')}}">ইসলামি আরবি বিশ্ববিদ্যালয়</a></h1>
                            <h2 class="title text-center"><a href="{{URL::to('/')}}">Islamic Arabic University</a></h2>
                        </div>
                        <div class="col-sm-3 social">

                        </div>
                    </div>
                </div><!--End Website Heading-->                
            </section>
        </header>


 <!--  <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest
            </ul>
  
        </div>
 -->



<div id="content" class="site-content" style="background-color: #fff; width: 97%; margin-right: 1%; margin-left: 1%;margin-top: 10px;margin-bottom: 10px;">
                <section class="main-content">
                    <div class="container">
                      
@guest
       <button type="submit" id="" class="btn btn-primary form-control" onclick="goToRegistrartion()">Register</button>
       <button type="submit" id="" class="btn btn-primary form-control" onclick="goToLogin()">Login  </button>
       @else
        <button type="submit" id="" class="btn btn-primary form-control" onclick="goToHome()">Logout</button>

        @endguest
                            @yield('content')
                       
                    </div>
                </section>
            </div>


<script type="text/javascript">
    
        function goToLogin(){
        window.location.href = "login";

        }

          function goToRegistrartion() {
              window.location.href = "registration";
            }
        function goToHome(){
         window.location.href = "{{url('logout')}}";   
        }
        function goToDash(){
         window.location.href = "{{url('dashboard')}}";   
        }


</script>

<footer id="colophon" class="site-footer" role="contentinfo"><!-- Start Footer -->
                <section class="footer">
                    <div class="footer-bottom text-center small"><!-- Start Copyright -->
                        <h4>Islamic Arabic University</h4>
                        All rights reserved. Copyright © ICT Section, <a href="{{url('/')}}">Islamic Arabic University</a>
                    </div><!-- End Copyright -->

                </section>
            </footer>

   </div>
</body>
</html>