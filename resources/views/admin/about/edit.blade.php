@extends('admin.app')
@section('title', 'About Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
    <form action="{{ route('aboutadmin.update', $about->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label for="" class="form-label">Image</label>
            <div classs="my-2">
                <img src="{{ asset('storage/'.$about->image) }}" width="120" alt="">
            </div>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{$about->title}}">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Features</label>
            <input type="text" class="form-control" data-role="tagsinput" value="{{ implode(',', $about->features) }}" name="features" placeholder="Input Features and Enter">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" rows="5" cols="30" value="{{$about->description}}">
        </div>
        <button type="submit" class="btn btn-info">Edit</button>
        <a href="{{ url('guideadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
@endsection
