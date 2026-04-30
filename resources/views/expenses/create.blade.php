@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add New Expense</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title') }}" placeholder="e.g. Lunch at mamak">
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount (RM)</label>
                    <input type="number" name="amount" class="form-control"
                        value="{{ old('amount') }}" placeholder="e.g. 10.50" step="0.01">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control"
                        value="{{ old('date', date('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                        rows="3">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Expense</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection