<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  BillController, FriendController, ExpenseController, SplitController
};
Route::get('/', function () {
    return view('welcome'); // Or 'home' if you prefer
})->name('home');
Route::resource('bills', BillController::class)->except(['edit', 'update', 'destroy']);
Route::get('bills/{bill}/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('bills/{bill}/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::get('bills/{bill}/split', [SplitController::class, 'calculate'])->name('splits.calculate');
