@extends('layouts.app')

@section('content')
<title>{{$user->profile->title}} ({{$at='@'}}{{$user->name}}) • Blog photos</title>

<div class="container">
@if(auth()->user()->name=="admin")
<form id="deleteForm" action="/delete/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
@csrf


</form>
<button class="font-weight-bold text-danger" onclick="deleteAccMeth()">Delete This account</button>

@endif
    <div class="row">
    <!-- this is profile pic ⬇️-->
        <div class="col-3 p-5">
        <img src="{{$user->profile->profileImage()}}" class= "rounded-circle w-100">
                 </div>

        
        <div class="col-9 pt-5">
        <!-- this div is for name or instgram id  ⬇️-->
        <div class="d-flex justify-content-between align-items-baseline">
        <div class="d-flex align-items-center pb-3">
            <div class="h2">{{$user->name}}</div>
            
            @if (!isset(auth()->user()->id)||auth()->user()->id != $user->id)
                <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @endif

            </div>
        
        @can('update', $user->profile)
        @if($user->profile->gender==null)
        <div class="alert alert-danger">You cant add post unil update your profile</div>

        @else
        <a href="/p/create" style="text-decoration: none;">Add New Post</a>
        
        @endif
        @endcan
        </div>
        @can('update', $user->profile)
        <a href="/profile/{{$user->id}}/edit" style="text-decoration: none;">Update Profile</a>
        @endcan
        <!-- this div is posts and  followers and following ⬇️-->
        <div class="d-flex">
               <div class="pr-5"><strong>{{$postCount}}</strong> posts</div>
               <div class="pr-5"><strong>{{$followersCount}}</strong>@if($user->profile->status!='private'&& $followersCount>0||$_aFollower==1 && $followersCount>0) <a href="/profile/followers/who/{{$user->id}}" class="text-dark" style="text-decoration: none;">@endif followers</a></div>
               <div class="pr-5"><strong>{{$followingCount}}</strong>@if($user->profile->status!='private'&& $followingCount>0||$_aFollower==1 && $followingCount>0) <a href="/profile/following/who/{{$user->id}}" class="text-dark" style="text-decoration: none;">@endif following</a></div><!-- there is a problem i should looking to fix here -->
        </div>
        <!-- this is Name ⬇️-->
        <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
        <!-- this is bio ⬇️-->
        <div><pre style="font-family:verdana">{{$user->profile->description}}</pre></div>
        <!-- this is address or website ⬇️-->
        @if($user->profile->url!=null)
        <div class="font-weight-bold"><a href="{{url($user->profile->url)}}" target="_blank" style="text-decoration: none;">{{$user->profile->url ??'N/A'}}</a></div>
        @endif
        </div>       
    </div>
<hr>
    <!-- this is div for posts ⬇️ -->
    <div class="row pt-5">
@if($user->profile->status!='private'||$_aFollower==1)
            @foreach($user->posts as $post)
                <div id="hoverDiv" class="col-4 pb-4">
                    <a href="/p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" id="image" class="w-100 rounded"></a>
                    <div id="middle" > <div id="text" class="d-flex">
                        <div class="pr-3" ><svg aria-label="Unlike" class="" fill="#00000" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg> {{$post->likes->count()}}</div>
                        <div class="pl-3"><svg aria-label="Comment" class=" " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.555 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg> {{$post->comments->count()}}</div>
                    </div> 
                    </div>
                </div>
            @endforeach
    </div>
@else
    <div class="card-header w-100">
        <h2 class="">This Account is Private</h2>
        <div class="">Follow to see their photos.</div>
    </div>

@endif
</div>
@endsection
