@extends('layouts.app')

@section('content')
<title>Explore</title>
    @foreach($posts as $post)
                 @for($i=0;$i < auth()->user()->following->count();$i++)
                  @if(auth()->user()->following[$i]->id==$post->user->profile->id&&$post->user->profile->status=='private')
                 <small style="display:none;">{{$_aFollower=1}}</small>
                   @endif
                   @endfor
    @if($post->user->profile->status!='private'||auth()->user()->id==$post->user_id||isset($_aFollower)&&$_aFollower==1)
    <small style="display:none;">{{$_aFollower=0}}</small>
    <small style="display:none">{{$post->viewsInc($post)}}</small>
    <div class="pt-5">
    <div class="card container" style="width: 40rem;">
 <div class="card-header" style="background-color:white;">
        <a href="/profile/{{ $post->user->id }}" class="font-weight-bold text-dark p-2" style="text-decoration: none;"> 
                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:2rem;"> 
                {{$post->user->name}}
                </a>
                </div>
         <div>
              <img src="/storage/{{ $post->image}}" class="card-img-top rounded ">
        </div>

<div class="card-title pt-2">

@if(!$post->checkLikes($post->likes,auth()->user()->id)['found'])
<!-- like-->
<like post-id="{{$post->id}}" status="0" like="" count="{{$post->likes->count()}}"></like>
@else
<!-- unlike-->
<like post-id="{{$post->id}}" status="1" like="{{$post->checkLikes($post->likes,auth()->user()->id)['like']}}" count="{{$post->likes->count()}}"></like>
@endif
    <a id="CommentHover" href="/p/{{$post->id}}" style="text-decoration: none;"  class="pl-2"><svg aria-label="Comment" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg></a>
    <button style="background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;" onclick="sharePostLink('127.0.0.1:8000/p/{{$post->id}}')" class="pl-2" id="Sharebutton"><svg aria-label="Share Post" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z"></path></svg></button>
<div class="font-weight-bold">{{$post->views}} views , 
@if($post->likes->count()>0)
<a  class="font-weight-bold text-dark" style="text-decoration: none;" href="/p/{{$post->id}}/likes">
@endif
<span id="likeCount_{{$post->id}}">{{$post->likes->count()}}</span> likes</a></div>
</div>

  <div class="card-text">
        <a href="/profile/{{ $post->user->id }}" class="font-weight-bold text-dark" style="text-decoration: none;">
        <pre style="font-family:verdana"><strong>{{$post->user->name}}</a></strong> {{$post->caption}}</pre>
        <!--this for other first 2 comments-->
        @if($post->comments->count()>2)
        <span style="display:none">{{$count=2}}</span>
        @else
        <span style="display:none">{{$count=$post->comments->count()}}</span>
        @endif
        <a href="/p/{{$post->id}}" class="text-secondary font-weight-bold" style="text-decoration: none;">View all <span  id="commentsCount{{$post->id}}">{{$post->comments->count()}}</span> comments</a>
        @for($x=0; $x<$count; $x++)
@if(isset($post->comments[$x]->user_id)&&$post->comments[$x]->user_id!=$post->user_id&&auth()->user()->id!=$post->comments[$x]->user_id)
<pre style="font-family:verdana"><span class="font-weight-bold"><a href="/profile/{{$post->comments[$x]->user->id}}" class="text-dark" style="text-decoration: none;">{{$post->comments[$x]->user->name}}</a></span> {{$post->comments[$x]->comment}}</pre>
@else
@if($post->comments->count()>$count)
<small style="display:none">{{$count++}}</small>
@endif
@endif
@endfor

<!--this for auth 2 comments-->
{{$authCommentsCount=null}}
@for($x=0; $x<$post->comments->count(); $x++)
@if($post->comments[$x]->user->id==auth()->user()->id && $authCommentsCount < 2)
<small style="display:none">{{$authCommentsCount++}}</small>
<pre style="font-family:verdana"><span class="font-weight-bold"><a href="/profile/{{$post->comments[$x]->user->id}}" class="text-dark" style="text-decoration: none;">{{$post->comments[$x]->user->name}}</a></span> {{$post->comments[$x]->comment}}</pre>
@endif
@endfor
<span id="commentdive{{$post->id}}"></span>
<br/>
<small class="text-secondary">{{date_format($post->created_at,'M/d/Y')}}</small>


  </div>



  <comment post-id="{{$post->id}}"></comment>


 </div>
</div>
@endif
    @endforeach

@endsection