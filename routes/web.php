<?php

use App\Http\Controllers\ExportCustomerController;
use App\Http\Controllers\ExportMonthlyController;
use App\Http\Controllers\PaymentConfirmationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])
    ->get('admin/monthly/{salesReport}', [ExportMonthlyController::class, 'index'])
    ->name('admin.monthly');

Route::middleware(['admin'])
    ->get('admin/customer/{salesReport}', [ExportCustomerController::class, 'index'])
    ->name('admin.customer');

Route::middleware(['guest'])
	->patch('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'update'])
	->name('payment-confirmations.update');

Route::middleware(['guest'])
	->put('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'update'])
	->name('payment-confirmations.update');

Route::middleware(['guest'])
	->get('payment-confirmation/{payment}', [PaymentConfirmationController::class, 'show'])
	->name('payment-confirmations.show');

Route::redirect('/', '/admin/dashboard');
