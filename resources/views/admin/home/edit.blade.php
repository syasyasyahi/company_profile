@extends('admin.app')
@section('title', 'Home Update')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
    <form action="{{ route('homeadmin.update', $home->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label for="" class="form-label">Image</label>
            <div>
                <img src="{{ asset('storage/' . $home->image) }}" width="120" alt="">
            </div>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Subtitle</label>
            <input type="text" class="form-control" value="{{ $home->subtitle }}" name="subtitle">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">title</label>
            <input type="text" class="form-control" value="{{ $home->title }}" name="title">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" value="{{ $home->description }}" name="description" rows="5" cols="30">
        </div>
        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ url('homeadmin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
