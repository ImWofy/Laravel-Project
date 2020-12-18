@extends('layouts.app')

@section('content')
<title>{{$user->profile->title}} ({{$at='@'}}{{$user->name}}) • Blog Following</title>

<div class="container">
    <a href="/profile/{{$_GET['profile_id']}}"style="text-decoration: none;">< back</a>
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
      @foreach($followers as $follower)
      <tr>
          
      <th scope="row">{{$counter++}}</th>

          <td>
          <a href="/profile/{{ $follower->user->id }}" style="text-decoration: none;">
          <img src="{{$follower->profileImage()}}" class="rounded-circle w-100" style="max-width:30px;">
                            <span class="pl-2 text-dark font-weight-bold">{{ $follower->user->name }}</span>
                        </a>
                         </td>
      
     
    
    
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection