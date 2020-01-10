@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit post</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- included form in form.blade.php -->
                        @include('post.form')
                    <!--// included form in form.blade.php -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection