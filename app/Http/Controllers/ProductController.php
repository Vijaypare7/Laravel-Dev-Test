<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\ProductCreated;
use App\Jobs\GenerateProductPdf;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use App\Http\Requests\ProductValidationRequest;
use App\Http\Requests\UpdateProductRequest;

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
    public function store(ProductValidationRequest $request)
    {
        $validated = $request->validated();

        $data = $request->all();
        if ($request->hasFile('images')) {

            $file = $request->file('images');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $fileName);

            $data['images'] = $fileName;
        }

        try {

            $product = Product::create($data);

            event(new ProductCreated($product));
            GenerateProductPdf::dispatch($product);

            return redirect()->route('products.index')->with('success', 'Product created successfully.');

        } catch (QueryException $e) {
            \Log::error('SQL Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product. Please try again.']);
        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }

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
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
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
        }


        try {

            $product->update($data);
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');

        } catch (QueryException $e) {
            \Log::error('SQL Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the product. Please try again.']);
        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }

        
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
