@extends('admin.app')
@section('title', 'About Menu')
@section('content')
   <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('aboutadmin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Features</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ( $homes as $index => $v) --}}
                <tr>
                    <td></td>
                    <td><img src="" alt="" width="120"></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="" class="btn btn-success">Edit</a>
                        <form class="d-inline" action="" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
