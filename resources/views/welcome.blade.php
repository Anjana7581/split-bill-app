@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="mb-5">
                <h1 class="display-4 fw-bold mb-3 text-primary">Welcome to SplitBill</h1>
                <p class="lead text-muted">
                    Simplify expense sharing with friends, roommates, or colleagues.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm bill-card">
                        <div class="card-body">
                            <div class="display-6 mb-3 text-primary">1</div>
                            <h5>Create Bill</h5>
                            <p class="text-muted small">Start by creating a bill for your shared expenses.</p>
                            <a href="{{ route('bills.create') }}" class="btn btn-sm btn-outline-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm bill-card">
                        <div class="card-body">
                            <div class="display-6 mb-3 text-primary">2</div>
                            <h5>Add Expenses</h5>
                            <p class="text-muted small">Record each payment and who shares it.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm bill-card">
                        <div class="card-body">
                            <div class="display-6 mb-3 text-primary">3</div>
                            <h5>Calculate Split</h5>
                            <p class="text-muted small">Find out who owes whom and settle easily.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="{{ route('bills.create') }}" class="btn btn-primary btn-lg px-4 gap-3">
                    Create Your First Bill
                </a>
                <a href="{{ route('bills.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    View Existing Bills
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
