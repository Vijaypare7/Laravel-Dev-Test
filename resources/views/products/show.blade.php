@extends('layouts.app')

@section('content')

    <?php
    $imgPath = asset('storage/No_Image_Available.jpg') ;
    if($product->images != ''){
        $imgPath = asset('storage/products/' . $product->images) ;
    }
    ?>

    <h1>Product Details</h1>

    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Description:</strong> {{ $product->description ?? "No description available" }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Sale Price:</strong> {{ $product->sale_price ?? '0.00' }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Slug:</strong> {{ $product->slug }}</p>
    <p><strong>Image:</strong> <img width="80px" height="80px" src="{{ $imgPath }}" alt="Example Image"> </p>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection
