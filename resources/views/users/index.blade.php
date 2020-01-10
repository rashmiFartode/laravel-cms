@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex  justify-content-end mb-3">
                <a href="" class="btn btn-info text-white">Create</a>
            </div>
            <div class="card">
                <div class="card-header">User</div>
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
                    @if(count($users) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                {{-- <th>Avatar</th> --}}
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Post count</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                {{-- <td><img src="{{ Gravatar::src($user->email) }}" height="40px" width="40x" style="border-radius:50%"> </td> --}}
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!$user->isAdmin())
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">Make Admin</button>
                                    </form>
                                    @endif
                                </td>
                                {{-- <td>{{ $user->posts->count() }}</td> --}}
                                {{-- <td>
                                    <a href="{{ route('users.edit', $user->id)  }}" class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})" data-toggle="modal"  @if($user->posts->count() > 0) disabled @endif data-target="#deleteModal">Delete</button>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h1>No users yet! </h1>
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
                    Are you sure you want to delete user?
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
        form.action = "/users/" + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
