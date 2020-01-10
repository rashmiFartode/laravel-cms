@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-info text-white">Create Post</a>
            </div>
            <div class="card">
                <div class="card-header">Post</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($posts) > 0)
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>published_at</th>
                                <th>category</th>
                                <th>Action      </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><img src="{{ empty($post->image) ? asset('storage/posts/no-image.png') : asset('storage/' . $post->image) }}" style="width: 80px;height: 70px" alt="image{{ $i }}"></td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->published_at }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @if(!$post->trashed())

                                    <a href="{{ route('posts.edit', $post->id)  }}" class="btn btn-info btn-sm">Edit</a>

                                    @else

                                    <form action="{{ route('restore-posts', $post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-info btn-sm" type="submit">Restore</button>
                                    </form>
                                    @endif

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"> {{ $post->trashed()?'Delete':'Trash'}}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h2> Not posts yets</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
