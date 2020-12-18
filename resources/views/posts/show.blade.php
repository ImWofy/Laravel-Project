@extends('layouts.app')

@section('content')
<title>Blog photo by {{$post->user->profile->title}}</title>
<div class="container card mb-3" style="max-width: 65.5rem;">

  <div class="row">
    <div class="col-7">
      <img src="/storage/{{$post->image}}" class="card-img ">
    </div>
    <div>
    <div class="pt-3" >
    <a href="/profile/{{ $post->user->id }}" class="font-weight-bold text-dark" style="text-decoration: none;"> 
                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:1.8rem;"> 
                {{$post->user->name}} &nbsp;•
                </a>
                @can('update', $post->user->profile)
                 
                  <button class=" btn text-danger" onclick="deletePostMeth()">Delete this Post</button>
                  
                @endcan
                <hr style="width:26.5rem;"></div>

                

                <div style="overflow-y: scroll; -ms-overflow-style: none; scrollbar-width: none; height: 20rem;width: 27.2rem;">
                <!--poster Caption-->
                <a href="/profile/{{$post->user->id}}" class="text-dark" style="text-decoration: none;"><pre style="font-family:verdana"><img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:1.8rem;"><strong> {{$post->user->name}}</a></strong> {{$post->caption}}</pre></a>
                <!--poster Caption-->
@foreach($post->comments as $comment)

<pre style="font-family:verdana"><span class="font-weight-bold"><a href="/profile/{{$comment->user->id}}" class="text-dark" style="text-decoration: none;"><img src="{{$comment->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:1.8rem;"> {{$comment->user->name}}</a></span> {{$comment->comment}}@if(auth()->user()->id==$comment->user_id&&auth()->user()->id!=$post->user_id) • <a class=" text-danger" href="/p/{{$post->id}}/delete/{{$comment->id}}" onclick="this.style.display='none'">Delete</a> @endif</pre>

@endforeach
<span id="commentdive"></span>
<br  id="ss"/>
</div>
@if(auth()->user()->id==$post->user_id)
<a href="/p/{{$post->id}}/comments" class="text-secondary font-weight-bold" style="text-decoration: none;">View all <span  id="commentsCount">{{$post->comments->count()}}</span> comments and edit</a>       @endif       
              <hr/>
              
              <div class="card-title ">
              @if(!$post->checkLikes($post->likes,auth()->user()->id)['found'])
<!-- like-->
<like post-id="{{$post->id}}" status="0" like="" count="{{$post->likes->count()}}"></like>
@else
<!-- unlike-->
<like post-id="{{$post->id}}" status="1" like="{{$post->checkLikes($post->likes,auth()->user()->id)['like']}}" count="{{$post->likes->count()}}"></like>
@endif
                    <button style="background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;" onclick="document.getElementById('comment_textarea').select()" class="pl-2" id="CommentButtonHover"><svg aria-label="Comment" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg></button>
                     <button style="background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;" onclick="alert('127.0.0.1:8000/p/{{$post->id}}')" class="pl-2"id="Sharebutton"><svg aria-label="Share Post" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z"></path></svg></button>
              </div>
              <a  class="font-weight-bold text-dark" style="text-decoration: none;" href="/p/{{$post->id}}/likes"><span id="likeCount_{{$post->id}}" class="font-weight-bold">{{$post->likes->count()}} </span><strong> likes</strong></a> <br/>
              <small class="text-secondary">{{date_format($post->created_at,'M/d/Y')}}</small>

              
<hr/>
<showcomment post-id="{{$post->id}}" img="{{auth()->user()->profile->profileImage()}}"></showcomment>
  <div id="alert_message" class="myalert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Note!</strong> Please type less than 50 letters.
</div>

                </div>
                



  </div>
  
</div>








</div>


                  

     
   
<form id="deleteForm" action="/p/delete/{{$post->id}}" enctype="multipart/form-data" method="post" >
   @csrf
   
   </form>
@endsection
