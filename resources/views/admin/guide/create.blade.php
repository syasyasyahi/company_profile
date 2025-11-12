@extends('admin.app')
@section('title', 'Guide Create')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
    <form action="{{ route('guideadmin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="" class="form-label">image</label>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">expertise</label>
            <input type="text" class="form-control" name="expertise">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">social media</label>
            <input type="text" class="form-control" name="social_media" data-role="tagsinput" rows="5" cols="30">
        </div>
        <button type="submit" class="btn btn-info">ADD</button>
        <a href="{{ url('homeadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
@endsection
