@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Expenses</h2>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">+ Add Expense</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Total Expenses: <strong>RM {{ number_format($total, 2) }}</strong></h5>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>
                        <span class="badge"
                            style="background-color: {{ $expense->category->color }}">
                            {{ $expense->category->name }}
                        </span>
                    </td>
                    <td>RM {{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('expenses.show', $expense) }}"
                            class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('expenses.edit', $expense) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this expense?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No expenses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $expenses->links() }}
@endsection