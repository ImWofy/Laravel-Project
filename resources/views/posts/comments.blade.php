@extends('layouts.app')

@section('content')
<title>{{$post->user->profile->title}} (Post {{$post->id}}) • Blog Edit Comments</title>
<div class="container">
    <a href="/p/{{$_GET['post_id']}}" style="text-decoration: none;">< back</a>
    <br>
    <br>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Profile</th>
      <th scope="col">Comment</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>
  @if(isset($_GET['page'])&&$_GET['page']!=1)
  <span style="display:none;">{{$counter=5*$_GET['page']-4}}</span>
  @endif
      @foreach($comments as $comment)
      <tr>
          
      <th scope="row">{{$counter++}}</th>

          <td>
          <a href="/profile/{{ $comment->user->id }}" style="text-decoration: none;">
          <img src="{{$comment->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:30px;">
                            <span class="pl-2 text-dark font-weight-bold">{{ $comment->user->name }}</span>
                        </a>
                         </td>
                         
      
     
    
    <td><div style="width:15rem"><pre style="font-family:verdana;">{{$comment->comment}}</pre></div></td>
    @if(auth()->user()->id==$comment->user_id||auth()->user()->id==$comment->post->user_id)
    <td><a href="/p/{{$comment->post->id}}/delete/{{$comment->id}}" class="btn btn-danger" onclick="this.style.display='none'">Delete</a></td>
    @endif
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection