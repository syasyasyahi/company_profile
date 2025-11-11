@extends('admin.app')
@section('title', 'About Create')
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
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="subtitle">
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Features</label>
            <div id="featurewrap">
                <div class="feature-item w-50">
                    <input type="text" class="form-control" placeholder="Input Features">
                    <button type="button" class="removeFeature btn btn-danger">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary">ADD</button>
        </div>
        <div class="mb-2">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" rows="5" cols="30">
        </div>
        <button type="submit" class="btn btn-info">ADD</button>
        <a href="{{ url('homeadmin') }}" class="btn btn-secondary">BACK</a>
    </form>
    <script>
        const wraper = document.querySelector('#featurewrap');
        const addBtn = document.querySelector('#addFeature');

        addBtn.addEventListener('click', function(){
            const newInpt = document.createElement('div');
            newInpt.classList.add('feature-item');
            newInpt.innerHTML = `<input type="text" class="form-control" placeholder="Input Features">
                    <button type="button" class="removeFeature btn btn-danger">Remove</button>
            `;
            wraper.appendChild(newInpt);
        })
    </script>
@endsection
