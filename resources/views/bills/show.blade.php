@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ $bill->name }}</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Friends</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($bill->friends as $friend)
                            <li class="list-group-item border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span>{{ $friend->name }}</span>
                                        @if($friend->email)
                                            <div class="text-muted small">{{ $friend->email }}</div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Expenses</h5>
                    <a href="{{ route('expenses.create', $bill) }}" class="btn btn-sm btn-primary">Add Expense</a>
                </div>
                <div class="card-body p-0">
                    @if($bill->expenses->isEmpty())
                        <div class="p-3">No expenses added yet.</div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($bill->expenses as $expense)
                                <li class="list-group-item border-0">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $expense->title }}</strong>
                                        <span>₹{{ number_format($expense->amount, 2) }}</span>
                                    </div>
                                    <div class="small text-muted mt-1">
                                        <div>Paid by: {{ $expense->payer->name }}</div>
                                        <div>Shared by: {{ $expense->shares->pluck('name')->join(', ') }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center">
        <a href="{{ route('splits.calculate', $bill) }}" class="btn btn-success px-4">Calculate Split</a>
    </div>
</div>
@endsection