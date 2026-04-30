<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('expenses')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'color' => 'required',
        ]);

        Category::create($request->only('name', 'color'));

        return redirect()->route('categories.index')
            ->with('success', 'Category added successfully!');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
    $request->validate([
        'name'  => 'required|string|max:255|unique:categories,name,' . $category->id,
        'color' => 'required',
    ]);

    $category->update($request->only('name', 'color'));

    return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully!');
    }

}