@extends('layouts.app')

@section('content')
<title>{{$post->user->profile->title}} (Post {{$post->id}}) • Blog Likes</title>

<div class="container">
    <a href="/p/{{$_GET['post_id']}}" style="text-decoration: none;">< back</a>
    <br>
    <br>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Profile</th>
      
      
    </tr>
  </thead>
  <tbody>
  @if(isset($_GET['page'])&&$_GET['page']!=1)
  <span style="display:none;">{{$counter=5*$_GET['page']-4}}</span>
  @endif
      @foreach($likes as $like)
      <tr>
          
      <th scope="row">{{$counter++}}</th>

          <td>
          <a href="/profile/{{ $like->user->id }}" style="text-decoration: none;">
          <img src="{{$like->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:30px;">
                            <span class="pl-2 text-dark font-weight-bold">{{ $like->user->name }}</span>
                        </a>
                         </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection