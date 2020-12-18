@extends('layouts.app')

@section('content')
<title>{{$user->profile->title}} ({{$at='@'}}{{$user->name}}) • Blog Update profile</title>

<div class="container">
<form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
   @csrf
   @method('PATCH')
    <div class="row">
        <div class="col-8 offset-2">
                <div class="row"><h1>Edit Profile</h1></div>
          <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label ">Title *</label>

                            
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ??$user->profile->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label ">Discription *</label>

                            
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" rows="10" cols="15" placeholder="Text your description . . ."  required required autocomplete="description" autofocus>{{ old('description') ??$user->profile->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label ">URL *</label>

                            
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ??$user->profile->url }}" required autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label ">Gender</label>

                            
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                @if($user->profile->gender=='female')
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        @elseif($user->profile->status==null)
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    @else
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    @endif
  
</select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label ">Privacy status</label>

                            
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                  @if($user->profile->status=='private')
                                        <option value="private">Private</option>
                                        <option value="public">Public</option>
                                        @elseif($user->profile->status==null)
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    @else
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                    @endif

  
</select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        
                        <div class="row">
                        <label for="image" class="col-md-4 col-form-label ">Profile Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" onchange="return imageValidation()">
                            @error('image')
                                    
                                        <strong style="color:red">{{ $message }}</strong>
                                    
                                @enderror
                        </div>

                        <div class="row pt-4">
                            <button id="PostpButton" class="btn btn-primary">Save Profile</button>
                        </div>

        </div>
    </div>
  </form>
  </div>
@endsection
