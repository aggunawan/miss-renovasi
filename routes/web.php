<?php

use App\Http\Controllers\PaymentConfirmationController;
use Illuminate\Support\Facades\Route;

Route::patch('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'update'])->name('payment-confirmations.update');
Route::put('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'update'])->name('payment-confirmations.update');
Route::get('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'show'])->name('payment-confirmations.show');

Route::redirect('/', '/admin/dashboard');
