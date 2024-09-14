<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();

        try {

            Category::create($request->all());
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');

        } catch (QueryException $e) {
            \Log::error('SQL Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the category. Please try again.']);
        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        try {

            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');

        } catch (QueryException $e) {
            \Log::error('SQL Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the category. Please try again.']);
        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
