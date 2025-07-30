<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Expense;
use App\Models\Friend;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('friends')->latest()->get();
        return view('bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
         'name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/',
        'friends' => 'required|array|min:1',
        'friends.*.name' => 'required|string|max:100|regex:/^[a-zA-Z]+$/',
        'friends.*.email' => 'nullable|email'
    ], [
        'name.regex' => 'Bill name should contain only letters (e.g. "trip")',
        'friends.*.name.regex' => 'Friend name should contain only letters (e.g. "sam")',
        'friends.*.email.email' => 'Please enter a valid email (e.g. "xxx@gmail.co")'
    ]);
    

    $bill = Bill::create(['name' => $validated['name']]);

    foreach ($validated['friends'] as $friendData) {
        $bill->friends()->create($friendData);
    }

    return redirect()->route('bills.show', $bill)->with('success', 'Bill created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $bill->load('friends', 'expenses.payer', 'expenses.shares');
        return view('bills.show', compact('bill'));
    }

}
