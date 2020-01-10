	<form action=" {{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="post">
	    @csrf
	    @if(isset($category))
	    @METHOD('PUT')
	    @endif
		<div class="form-group">
	        <label for='name'>Name</label>
	        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" id="name" value="{{ isset($category) ? $category->name :  old('name')}}" >
	        <small class="text-danger">{{ $errors->first('name') }}</small>
	    </div>
	    <div class="form-group">
	        <button class="btn btn-success" type="Submit">{{ isset($category) ? 'Update Catgory' :  'Create category'}}</button>
	        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
	    </div>
	</form>