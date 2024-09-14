@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Category</button>
    </form>
@endsection
