@extends('admin.home')

@section('subpage-contents')
    <div class="alert alert-danger">
        <strong>Zamítnuto!</strong> {{ $message }}
    </div>
@endsection