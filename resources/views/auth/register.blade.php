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
         ///register 
    function checkRegisterFields(){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8||document.getElementById('name').value.length<5||document.getElementById('email').value.length<8){
        document.getElementById('alert_message').style.display="block";
         document.getElementById('script_Validate').style.display="block";


        if(document.getElementById('national_id').value.length<10)
        document.getElementById('script_Validate').innerHTML='Id must be 10 fields at least.';
        else if(document.getElementById('name').value.length<5)
        document.getElementById('script_Validate').innerHTML='Name must be 5 fields at least.';
        else if(document.getElementById('password').value.length<8)
        document.getElementById('script_Validate').innerHTML='Password must be 8 fields at least.';
        else if (document.getElementById('email').value.length<8)
        document.getElementById('script_Validate').innerHTML='Email must be 8 fields at least.';

        
        }else{
            if(document.getElementById('password').value!=document.getElementById('password-confirm').value){
            document.getElementById('alert_message_Pass').style.display="block";
            }
                else {    document.getElementById('register-form').submit();}
            
        }
        
    }

    function checkRegisterFieldsByEnter(event){
        if(event.keyCode==13){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8||document.getElementById('name').value.length<5||document.getElementById('email').value.length<8){
        document.getElementById('alert_message').style.display="block";
        

        document.getElementById('script_Validate').style.display="block";


        if(document.getElementById('national_id').value.length<10)
        document.getElementById('script_Validate').innerHTML='Id must be 10 fields at least.';
        else if(document.getElementById('name').value.length<5)
        document.getElementById('script_Validate').innerHTML='Name must be 5 fields at least.';
        else if(document.getElementById('password').value.length<8)
        document.getElementById('script_Validate').innerHTML='Password must be 8 fields at least.';
        else if (document.getElementById('email').value.length<8)
        document.getElementById('script_Validate').innerHTML='Email must be 8 fields at least.';


        }else{
            if(document.getElementById('password').value!=document.getElementById('password-confirm').value){
            document.getElementById('alert_message_Pass').style.display="block";
            }
                else {    document.getElementById('register-form').submit();}
            
            }

        
        }
    }

///


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

 <!-- Sign up form -->
 <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                        @csrf
                        <!--Alert if client didnt fill the feilds-->
                        <button id="script_Validate" class="alert alert-danger" style="display:none;" onclick="this.style.display='none';"></button>
                            <!--name-->
                            <div class="form-group">
                            
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" required autocomplete="name" autofocus onkeypress="checkRegisterFieldsByEnter(event)"/>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            
                            </div>
                            <!--national_id-->
                            <div class="form-group">
                                <label for="national_id"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="national_id" id="national_id" placeholder="National_Id" class="{{ $errors->has('national_id') ? ' is-invalid' : '' }}" required onkeypress="checkRegisterFieldsByEnter(event)"/>
                               
                                @if ($errors->has('national_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('national_id') }}</strong>
                                    </span>
                                @endif
                            
                            </div>
                            <!--email-->
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" onkeypress="checkRegisterFieldsByEnter(event)"/>
                           
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!--pass-->
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" required onkeypress="checkRegisterFieldsByEnter(event)"/>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!--confirm-->
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="password-confirm" placeholder="Repeat your password" required autocomplete="new-password" onkeypress="checkRegisterFieldsByEnter(event)"/>
                             
                            </div>
                            <!--check
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            -->
                        </form>
                        <!--button-->
                        <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" onclick="checkRegisterFields()"/>
                            </div>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('vendorImg/login.png') }}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
                        <!--alert Cant reg-->
                <div id="alert_message_Pass" class="myalert rounded">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                            <strong>Note!</strong> Confirm Your Password Please.
                            </div>
                        <!--alert Cant reg-->
                        <div id="alert_message" class="myalert rounded">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                            <strong>Note!</strong> Please Fill The Fields, Name must be 5 fields at least, id must be 10 fields at least, Password must be 8 fields at least, Email must be 8 fields at least..
                            </div>
            </div>
        </section>
        </div>
</body>
</html>