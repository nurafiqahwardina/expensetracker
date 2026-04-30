<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('category')
            ->latest()
            ->paginate(10);

        $total = Expense::sum('amount');

        return view('expenses.index', compact('expenses', 'total'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title'       => 'required|string|max:255',
        'amount'      => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'date'        => 'required|date',
    ]);

    Expense::create($request->all());

    return redirect()->route('expenses.index')
        ->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense)
    {
    $categories = Category::all();
    return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title'       => 'required|string|max:255',
        'amount'      => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'date'        => 'required|date',
    ]);

    $expense->update($request->all());

    return redirect()->route('expenses.index')
        ->with('success', 'Expense updated successfully!');
    }

}