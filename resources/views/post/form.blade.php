	<form action=" {{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="post" enctype="multipart/form-data">
	    @csrf
	    @if(isset($post))
	    @METHOD('PUT')
	    @endif

		<div class="form-group">
	        <label for='title'>Title</label>
	        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" id="title" value="{{ isset($post) ? $post->title :  old('title')}}" >
	        @error('title')<small class="text-danger">{{ $errors->first('title') }}</small>@enderror
	    </div>

	    <div class="form-group">
	        <label for='description'>Description</label>
	        <textarea class="form-control @error('description') is-invalid @enderror"  name="description" id="description" cols="30" rows="5" placeholder="Description">{{ isset($post) ? $post->description :  old('description')}}</textarea>
	        @error('description')<small class="text-danger">{{ $errors->first('description') }}</small>@enderror
	    </div>

	    <div class="form-group">
	        <label for='content'>Content</label>
	        <input id="content" type="hidden" name="content" class="form-control @error('content') is-invalid @enderror" value="{{ isset($post) ? $post->content :  old('content')}}">
  			<trix-editor input="content"></trix-editor>
	        @error('content')<small class="text-danger">{{ $errors->first('content') }}</small>@enderror
	    </div>

		<div class="form-group">
	        <label for='published_at'>Published at</label>
	        <input type="text" class="form-control @error('published_at') is-invalid @enderror" name="published_at" placeholder="Published at" id="published_at" value="{{ isset($post) ? $post->published_at :  old('published_at')}}" >
	        @error('published_at')<small class="text-danger">{{ $errors->first('published_at') }}</small>@enderror
	    </div>

	    @if(isset($post->image))
	    	<div class="form-group">
	    		<img src="{{ asset('storage/'. $post->image) }}" style="height:200px;width: 100% " >
	    	</div>
	    @endif
	    <div class="form-group">
	        <label for='image'>Image</label>
	        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Image" id="image" value="{{ isset($post) ? $post->image :  old('image')}}" >
	        @error('image')<small class="text-danger">{{ $errors->first('image') }}</small>@enderror
	    </div>
	    <div class="form-group">
	        <label for='category_id'>Category</label>
	        <select class="form-control" name="category_id" id="category_id">
				{{-- @if(isset($post)) --}}
					@foreach ($categories as $category)
					<option value="{{ $category->id }}"
						@if(isset($post))
							@if($category->id == $post->category_id) selected @endif
						@endif
						>{{$category->name}}</option>
					@endforeach
				{{-- @endif --}}
			</select>
        </div>

        @if ($tags->count() > 0)
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"
                    @isset($post)
                        @if ($post->hasTag($tag->id))
                            selected
                        @endif
                    @endisset
                    > {{$tag->name}} </option>
                @endforeach
            </select>
        </div>
        @endif

	    <div class="form-group">
	        <button class="btn btn-success" type="Submit">{{ isset($post) ? 'Update post' :  'Create post'}}</button>
	        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
	    </div>
	</form>
