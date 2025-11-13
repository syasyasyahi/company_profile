@extends('admin.app')
@section('title', 'Guide Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
    <form action="{{ route('guideadmin.update', $guide->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label for="" class="form-label">Image</label>
            <div classs="my-2">
                <img src="{{ asset('storage/' . $guide->image) }}" width="120" alt="">
            </div>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $guide->name ? $guide->name : null }}">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Expertise</label>
            <input type="text" class="form-control" name="expertise" value="{{ $guide->expertise ?? null }}">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Social Media</label>
            <input type="text" class="form-control" data-role="tagsinput"
                value="{{ $guide->social_media ? implode(',', $guide->social_media) : null }}" name="social_media"
                placeholder="Input Social Media and Enter">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Social Media Url</label>
            <input type="text" class="form-control" data-role="tagsinput"
                value="{{ $guide->socmed_urls ? implode(',', $guide->socmed_urls) : null }}" name="socmed_urls"
                placeholder="Input Social Media Url and Enter">
        </div>
        <button type="submit" class="btn btn-info">Edit</button>
        <a href="{{ url('guideadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
@endsection
