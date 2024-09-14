@extends('layouts.app')

@section('content')
    <h1>Create New Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Create Category</button>
    </form>
@endsection
