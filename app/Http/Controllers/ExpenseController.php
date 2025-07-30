<?php

namespace App\Http\Controllers;
use App\Models\Bill;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Bill $bill)
    {
        $friends = $bill->friends;
        return view('expenses.create', compact('bill', 'friends'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Bill $bill)
    {
          $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'paid_by' => 'required|exists:friends,id,bill_id,'.$bill->id,
            'shared_by' => 'required|array|min:1',
            'shared_by.*' => 'exists:friends,id,bill_id,'.$bill->id,
        ]);

        $expense = $bill->expenses()->create([
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'paid_by' => $validated['paid_by'],
        ]);

        $expense->shares()->sync($validated['shared_by']);

        return redirect()->route('bills.show', $bill)->with('success', 'Expense added successfully!');
    }    

    
}
