<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel = "icon" href =  
"/svg/logo.svg" 
        type = "image/x-icon"> 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('MyForm/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('MyForm/css/style.css') }}">

    <script>
         function checkLoginFields(){
        if(document.getElementById('your_name').value.length<10||document.getElementById('your_pass').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{document.getElementById('login-form').submit();}
    }
    function checkLoginFieldsByEnter(event){
        if(event.keyCode==13){
        if(document.getElementById('your_name').value.length<10||document.getElementById('your_pass').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{document.getElementById('login-form').submit();}
        }
    }

    </script>
     <style>
    
    .myalert {
      padding: 20px;
      background-color: #2E2E2E;
      color: white;
      display:none;
    }
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
    }
    </style>
</head>
<body>

    <div class="main">

        

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                

                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('vendorImg/login.png') }}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form" action="/login/national_id">
                        @csrf
                        <!--message if wronge login-->
                                @if(session('message'))

                                <div class="alert alert-danger">{{session('message')}}</div>

                                @endif
                            <div class="form-group">
                                <label for="national_id"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="national_id" id="your_name" placeholder="National_Id" required autocomplete="national_id" autofocus onkeypress="checkLoginFieldsByEnter(event)"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password" required autocomplete="current-password"  onkeypress="checkLoginFieldsByEnter(event)"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" {{ old('remember') ? 'checked' : '' }}/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            
                        </form>
                        <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" onclick="checkLoginFields()"/>
                            </div>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="{{ url('/auth/redirect/facebook') }}"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            </ul>
                        </div>
                         <!--pass req-->

                         @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                    </div>
                </div>
                <!--alert Cant Login-->
                <div id="alert_message" class="myalert rounded">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Note!</strong> Please Fill The Fields.
                    </div>
            </div>
        </section>

    </div>
</body>
</html>