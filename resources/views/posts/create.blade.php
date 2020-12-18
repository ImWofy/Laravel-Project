@extends('layouts.app')

@section('content')
<title>{{auth()->user()->profile->title}} ({{$at='@'}}{{auth()->user()->name}}) • Blog Create post</title>

<div class="container">
   <form id="PostForm" action="/p" enctype="multipart/form-data" method="post">
   @csrf
    <div class="row">
        <div class="col-8 offset-2">
                <div class="row"><h1>Add New Post</h1></div>
          <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label ">Post Caption *</label>

                            
                                <textarea id="caption" type="textarea" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" rows="10" cols="15" placeholder="Text your post caption . . ." required autofocus></textarea>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="PostSpanMessage" class="text-danger" role="alert">
                                    </span>

                            
                        </div>
                        
                        <div class="row">
                        <label for="image" class="col-md-4 col-form-label ">Post Image *</label>
                            <input type="file" class="form-control-file" id="image" name="image" onchange="return imageValidation()">
                            @error('image')
                                    
                                        <strong style="color:red">{{ $message }}</strong>
                                    
                                @enderror
                                <div id="imagePreview" class="pt-2"></div> 

                        </div>


        </div>
    </div>
  </form>
  <div class="pt-4"style="margin-left: 170px;">
      <button id="PostpButton" class="btn btn-primary"  disabled="true" onclick="postValidation()">Add New Post</button>
 </div>

</div>
@endsection
