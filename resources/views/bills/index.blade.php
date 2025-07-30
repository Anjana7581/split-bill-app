@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Bills</h1>
        <a href="{{ route('bills.create') }}" class="btn btn-primary">Create New Bill</a>
    </div>

    @if($bills->isEmpty())
        <div class="alert alert-info">You don't have any bills yet. Create your first bill!</div>
    @else
        <div class="row">
            @foreach($bills as $bill)
                <div class="col-md-6 mb-4">
                    <div class="card bill-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bill->name }}</h5>
                            <p class="card-text text-muted">
                                Created: {{ $bill->created_at->format('M d, Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Total:</strong> ${{ number_format($bill->total_amount, 2) }}
                            </p>
                            <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection