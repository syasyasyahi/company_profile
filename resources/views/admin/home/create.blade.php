@extends('admin.app')
@section('title', 'Home Create')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
    <form action="{{ route('homeadmin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Subtitle</label>
            <input type="text" class="form-control" name="subtitle">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" rows="5" cols="30">
        </div>
        <button type="submit" class="btn btn-info">ADD</button>
        <a href="{{ url('homeadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
@endsection
