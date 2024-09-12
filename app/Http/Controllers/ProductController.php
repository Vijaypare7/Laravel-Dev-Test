<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Events\ProductCreated;
use App\Jobs\GenerateProductPdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'images' => 'nullable',
        ]);

        $data = $request->all();
        if ($request->hasFile('images')) {

            $file = $request->file('images');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $fileName);

            $data['images'] = $fileName;
        }

        $product = Product::create($data);

        // Dispatch the event
        event(new ProductCreated($product));

        // Dispatch the job to generate PDF
        GenerateProductPdf::dispatch($product);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'images' => 'nullable',
        ]);

        $data = $request->all();
        if ($request->hasFile('images')) {

            $oldImagePath = 'public/products/' . $product->images;

            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $file = $request->file('images');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $fileName);

            $data['images'] = $fileName;

            // $data['images'] = $request->file('images')->store('products');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
