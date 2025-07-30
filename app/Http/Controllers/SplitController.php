<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Expense;
use Illuminate\Http\Request;

class SplitController extends Controller
{
    public function calculate(Bill $bill)
    {
        $bill->load('friends', 'expenses.payer', 'expenses.shares');
        
        $friends = $bill->friends;
        $expenses = $bill->expenses;
        
        // Initialize balances
        $balances = $friends->mapWithKeys(function ($friend) {
            return [$friend->id => 0];
        });

        // Prepare detailed expense breakdown
        $expenseDetails = [];
        
        foreach ($expenses as $expense) {
            $amount = $expense->amount;
            $sharesCount = $expense->shares->count();
            $shareAmount = $sharesCount > 0 ? $amount / $sharesCount : 0;
            
            // Track who owes what for this expense
            $expenseOwed = [];
            foreach ($expense->shares as $share) {
                $expenseOwed[] = [
                    'friend' => $share,
                    'amount' => $shareAmount
                ];
            }
            
            $expenseDetails[] = [
                'title' => $expense->title,
                'amount' => $amount,
                'payer' => $expense->payer,
                'shares' => $expenseOwed,
                'share_amount' => $shareAmount
            ];
            
            // Calculate balances (original logic)
            if ($sharesCount > 0) {
                $balances[$expense->paid_by] += $amount;
                foreach ($expense->shares as $share) {
                    $balances[$share->id] -= $shareAmount;
                }
            }
        }
        
        // Prepare data for settlement
        $settlements = [];
        $balances = $balances->sort();
        
        while (!$balances->isEmpty() && abs($balances->first()) > 0.01) {
            $debtor = $balances->search($balances->first());
            $creditor = $balances->search($balances->last());
            
            $amount = min(abs($balances[$debtor]), $balances[$creditor]);
            
            if ($amount > 0.01) {
                $settlements[] = [
                    'from' => $friends->find($debtor),
                    'to' => $friends->find($creditor),
                    'amount' => $amount,
                ];
                
                $balances[$debtor] += $amount;
                $balances[$creditor] -= $amount;
            }
            
            $balances = $balances->filter(fn($balance) => abs($balance) > 0.01)->sort();
        }
        
        return view('splits.show', compact('bill', 'settlements', 'friends', 'expenseDetails'));
    }
}