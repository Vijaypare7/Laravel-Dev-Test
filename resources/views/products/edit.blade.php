@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" >
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ $product->sale_price }}">
            @error('sale_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" >
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="images">Product Images</label>
            <input type="file" class="form-control-file" id="images" name="images">
            @error('images')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Product</button>
    </form>
@endsection
