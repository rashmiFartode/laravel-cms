	<form action=" {{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" method="post">
	    @csrf
	    @if(isset($tag))
	    @METHOD('PUT')
	    @endif
		<div class="form-group">
	        <label for='name'>Name</label>
	        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" id="name" value="{{ isset($tag) ? $tag->name :  old('name')}}" >
	        <small class="text-danger">{{ $errors->first('name') }}</small>
	    </div>
	    <div class="form-group">
	        <button class="btn btn-success" type="Submit">{{ isset($tag) ? 'Update Catgory' :  'Create tag'}}</button>
	        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
	    </div>
	</form>
