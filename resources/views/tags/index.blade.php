@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex  justify-content-end mb-3">
                <a href="{{ route('tags.create') }}" class="btn btn-info text-white">Create</a>
            </div>
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(count($tags) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Name</th>
                                <th>Post count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->posts->count() }}</td>
                                <td>
                                    <a href="{{ route('tags.edit', $tag->id)  }}" class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})" data-toggle="modal"  @if($tag->posts->count() > 0) disabled @endif data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h1>No tags yet! </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form method="post" id="deleteTagForm">
        @csrf
        @METHOD("DELETE")
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-bold">
                    Are you sure you want to delete tag?
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function handleDelete(id)
    {
        var form = document.getElementById('deleteTagForm');
        form.action = "/tags/" + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
