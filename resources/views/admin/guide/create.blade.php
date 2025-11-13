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
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Expertise</label>
            <input type="text" class="form-control" name="expertise">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Social Media</label>
            <input type="text" class="form-control" name="social_media" data-role="tagsinput" rows="5"
                cols="30">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Social Media Url</label>
            <input type="url" class="form-control" name="socmed_urls" data-role="tagsinput" rows="5"
                cols="30">
        </div>
        <button type="submit" class="btn btn-info">ADD</button>
        <a href="{{ url('guideadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
@endsection
