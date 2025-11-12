@extends('admin.app')
@section('title', 'Guide Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('guideadmin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Num</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Expertise</th>
                    <th>Social Media</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($guides as $index => $item)
                <tbody>
                    {{-- @foreach ($homes as $index => $v) --}}
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" alt="" width="120"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->expertise }}</td>
                        <td>
                            <ul>
                                @foreach ($item->social_media as $i)
                                    <li>{{ $i }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('guideadmin.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <form class="d-inline" action="{{ route('guideadmin.destroy', $item->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
            @endforeach
            {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
