@extends('layouts.app')

@section('content')
<div class="container my-4">
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
    <h2 class="mb-2 mb-md-0">Split Calculation: {{ $bill->name }}</h2>
    <a href="{{ route('bills.show', $bill) }}" class="btn btn-outline-secondary">
        ← Back to Bill
    </a>
</div>

    <!-- Expense Details -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Expense Details</h5>
        </div>
        <div class="card-body p-0">
            @foreach($expenseDetails as $expense)
            <div class="p-3 border-bottom">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-bold mb-0">{{ $expense['title'] }}</h6>
                    <span class="text-primary">₹{{ number_format($expense['amount'], 2) }}</span>
                </div>
                
                <div class="row small text-muted mb-2">
                    <div class="col-md-6">
                        <span>Paid by: {{ $expense['payer']->name }}</span>
                    </div>
                    <div class="col-md-6">
                        <span>Share: ₹{{ number_format($expense['share_amount'], 2) }}/person</span>
                    </div>
                </div>
                
                <table class="table table-sm mb-0">
                    <tbody>
                        @foreach($expense['shares'] as $share)
                        <tr>
                            <td>{{ $share['friend']->name }}</td>
                            <td>₹{{ number_format($share['amount'], 2) }}</td>
                            <td class="text-end">
                                @if($share['friend']->id == $expense['payer']->id)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning text-dark">Owes</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Who Owes Whom -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Who Owes Whom</h5>
        </div>
        <div class="card-body p-0">
    @if(empty($settlements))
        <div class="p-3 text-muted">All balances are settled - no payments needed!</div>
    @else
        <ul class="list-group list-group-flush">
            @foreach($settlements as $settlement)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <span class="fw-medium">{{ $settlement['from']->name }}</span>
                    <span class="text-muted mx-2">should pay</span>
                    <span class="fw-medium">{{ $settlement['to']->name }}</span>
                </div>
                <span class="badge bg-danger rounded-pill">₹{{ number_format($settlement['amount'], 2) }}</span>
            </li>
            @endforeach
        </ul>
    @endif
</div>
    </div>

    <!-- Final Balances -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Final Balances</h5>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <tbody>
                    @foreach($friends as $friend)
                    @php
                        $paid = $friend->paidExpenses->sum('amount');
                        $owed = $bill->expenses->filter(function($expense) use ($friend) {
                            return $expense->shares->contains($friend);
                        })->sum(function($expense) {
                            return $expense->amount / $expense->shares->count();
                        });
                        $balance = $paid - $owed;
                    @endphp
                    <tr>
                        <td>{{ $friend->name }}</td>
                        <td class="{{ $balance >= 0 ? 'text-success' : 'text-danger' }} text-end">
                            ₹{{ number_format(abs($balance), 2) }}
                            <small class="text-muted d-block">
                                {{ $balance > 0 ? 'gets back' : ($balance < 0 ? 'owes' : 'even') }}
                            </small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection