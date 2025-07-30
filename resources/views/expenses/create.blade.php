@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Expense to {{ $bill->name }}</h1>
    <form method="POST" action="{{ route('expenses.store', $bill) }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
        </div>
        
        <div class="mb-3">
            <label for="paid_by" class="form-label">Paid By</label>
            <select class="form-select" id="paid_by" name="paid_by" required>
                @foreach($friends as $friend)
                    <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Shared By</label>
            @foreach($friends as $friend)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="shared_by[]" 
                           id="friend-{{ $friend->id }}" value="{{ $friend->id }}" checked>
                    <label class="form-check-label" for="friend-{{ $friend->id }}">
                        {{ $friend->name }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <button type="submit" class="btn btn-primary">Add Expense</button>
    </form>
</div>
@endsection
