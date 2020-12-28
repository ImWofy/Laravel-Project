<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <link rel = "icon" href =  
"/svg/logo.svg" 
        type = "image/x-icon"> 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>function commentButtonStatus(){
        var c;
        if(document.getElementById('comment_textarea').value.match(/^ *$/) !== null)
        {

            document.getElementById('commentSendButton').disabled = true; 
            document.getElementById('commentSendButton').style.color = "lightblue";
        }
        else
        { 
            document.getElementById('commentSendButton').disabled = false; 
            document.getElementById('commentSendButton').style.color = "blue";

        }

        document.getElementById('lengthCounter').innerHTML =document.getElementById('comment_textarea').value.length +'/50'; 
        if(document.getElementById('comment_textarea').value.length>50)
        document.getElementById('lengthCounter').style.color="red";else document.getElementById('lengthCounter').style.color="black";
    }
    function checkCommentLength(){
        if(document.getElementById('comment_textarea').value.length>50)
        {
            document.getElementById('alert_message').style.display = "block";
            document.getElementById('commentSendButton').disabled = true; 
            document.getElementById('commentSendButton').style.color = "lightblue";
            document.getElementById('lengthCounter').innerHTML = document.getElementById('comment_textarea').value.length +'/50';


        }
            else {
            document.getElementById('alert_message').style.display = "none";
            document.getElementById('commentSendButton').disabled = false; 
            document.getElementById('commentSendButton').style.color = "blue";
            document.getElementById('lengthCounter').innerHTML ='0/50';
            document.getElementById( 'ss' ).scrollIntoView();
        }
         
    }

    function searchInput(){
        if(document.getElementById('searchInput').value.match(/^ *$/) !== null)
        {
            document.getElementById('sRes').style.display="none";
            document.getElementById('Main_search_div').style.display="none";

        }else{
            document.getElementById('sRes').style.display="block";
            document.getElementById('Main_search_div').style.display="block";
        }

    }
//delete func

function deleteAccMeth(){
        if(confirm("Are you sure!")){
            document.getElementById('deleteForm').submit();
        }
    }

    function deletePostMeth(){
        if(confirm("Are you sure!")){
            document.getElementById('deleteForm').submit();
        }
    }

        function deleteMyComment(){
        if(confirm("Are you sure!")){
            document.getElementById('deleteMyCommentForm').submit();
        }
        
        
    }
    
     function sharePostLink(link){
         
         var x = link;
         console.log(x);
        var Copy = prompt('Want copy the link for share ?',link);
        if(Copy){
        var dummy = $('<textarea>').val(x).appendTo('body').select()
        document.execCommand('copy')
        dummy.remove();


        }
        
        
    }

///login
    function checkLoginFields(){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{document.getElementById('LaR').submit();}
    }
    function checkLoginFieldsByEnter(event){
        if(event.keyCode==13){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{document.getElementById('LaR').submit();}
        }
    }
    ////


///register 
    function checkRegisterFields(){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8||document.getElementById('name').value.length<5||document.getElementById('email').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{
            if(document.getElementById('password').value!=document.getElementById('password-confirm').value){
            document.getElementById('alert_message_Pass').style.display="block";
            }
                else {    document.getElementById('LaR').submit();}
            
        }
    }

    function checkRegisterFieldsByEnter(event){
        if(event.keyCode==13){
        if(document.getElementById('national_id').value.length<10||document.getElementById('password').value.length<8||document.getElementById('name').value.length<5||document.getElementById('email').value.length<8){
        document.getElementById('alert_message').style.display="block";
        
        }else{
            if(document.getElementById('password').value!=document.getElementById('password-confirm').value){
            document.getElementById('alert_message_Pass').style.display="block";
            }
                else {    document.getElementById('LaR').submit();}
            
            }

        
        }
    }

///

//postValidation
function postValidation(){
if(document.getElementById('caption').value.match(/^ *$/) == null&&document.getElementById('caption').value.length<=150)
{document.getElementById('PostForm').submit();
}
else{
    document.getElementById('PostSpanMessage').innerHTML="<strong>There is a problem in Caption</strong>";

}

}

//image valid func
function imageValidation() { 
            var imageInput =  
                document.getElementById('image'); 
              
            var imagePath = imageInput.value; 
          
            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(imagePath)) { 
                alert('Invalid image type'); 
                imageInput.value = ''; 
                return false; 
                document.getElementById('PostpButton').disabled = true;

            }  
            else  
            { 
              
                // Image preview 
                if (imageInput.files && imageInput.files[0]) { 
                    var reader = new FileReader(); 
                    reader.onload = function(e) { 
                        document.getElementById( 
                            'imagePreview').innerHTML =  
                            '<img src="' + e.target.result 
                            + '" style="width:50%;" class="rounded"/>'; 
                    }; 
                      
                    reader.readAsDataURL(imageInput.files[0]); 
                    document.getElementById('PostpButton').disabled = false;

                } 
            } 
        }     </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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

    <style>
    pre {
	overflow-x: auto;
		white-space: pre-wrap;
		white-space: -moz-pre-wrap !important;
		white-space: -pre-wrap;
		white-space: -o-pre-wrap;
		word-wrap: break-word;
    }

    
    #image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}


    #middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
    
#hoverDiv:hover #image {
  opacity: 0.8;
}
#hoverDiv:active #image {
  opacity: 0.3;
}


#hoverDiv:hover #middle {
  opacity: 1;
}


#text {
  color: Black;
}


        
    
    
#HomeButtonHover:active {
    transition: .1s ease;

  opacity: 0.1;
}


#likeButton:active {
    transition: .1s ease;

  opacity: 0.1;
}
#Sharebutton:active {
    transition: .1s ease;

  opacity: 0.1;
}
#CommentButtonHover:active {
    transition: .1s ease;

  opacity: 0.1;
}
#CommentHover:active {
    transition: .1s ease;

  opacity: 0.1;
}
#navbarDropdown:active {
    transition: .1s ease;

  opacity: 0.1;
}
#blogButton:active {
    transition: .1s ease;

  opacity: 0.1;
}


</style>
</head>
<body>
    <div id="app" onclick="document.getElementById('Main_search_div').style.display='none';">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a id="blogButton" class="navbar-brand d-flex"  href="{{ url('/') }}">
                    <div><img src="/storage/blog.png" style="height:25px; border-right: 1px solid" class="pr-3"></div>
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!--search input-->
                    <search></search>
                    <!--search input-->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <div class="pr-3">
                       
                    
            </div>
                        <a id="HomeButtonHover" href="/" class="mr-4 " style=""><svg aria-label="Home" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48" width="22"><path d="M45.5 48H30.1c-.8 0-1.5-.7-1.5-1.5V34.2c0-2.6-2.1-4.6-4.6-4.6s-4.6 2.1-4.6 4.6v12.3c0 .8-.7 1.5-1.5 1.5H2.5c-.8 0-1.5-.7-1.5-1.5V23c0-.4.2-.8.4-1.1L22.9.4c.6-.6 1.6-.6 2.1 0l21.5 21.5c.3.3.4.7.4 1.1v23.5c.1.8-.6 1.5-1.4 1.5z"></path></svg></a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{Auth::user()->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:1.8rem;">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div id="Main_search_div" class="col pr-5" style="overflow-y: scroll; height: 10rem; position:absolute;z-index: 99999;display:none">
<div id="sRes" class=" ml-6 container bg-light rounded" style="width: 20rem;"></div></div>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
