<?php

use App\Http\Controllers\NotifyStatementController;
use App\Http\Controllers\PaymentApproveController;
use App\Http\Controllers\PaymentDeclineController;
use App\Http\Controllers\PaymentReceiptController;
use App\Http\Controllers\StatementController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::post('payment/{payment}/approve', [PaymentApproveController::class, 'store'])->name('payment-approve.store');
    Route::post('payment/{payment}/decline', [PaymentDeclineController::class, 'store'])->name('payment-decline.store');
    Route::post('notify/{statement}', [NotifyStatementController::class, 'store'])->name('notify.store');
    Route::get('statements/{statement}', [StatementController::class, 'show'])->name('statements.show');
    Route::crud('account', 'AccountCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('bank', 'BankCrudController');
    Route::crud('invoice', 'InvoiceCrudController');
    Route::crud('payment', 'PaymentCrudController');
    Route::crud('receipt', 'ReceiptCrudController');
    Route::get('payment-receipt/{paymentReceipt}', [PaymentReceiptController::class, 'show'])->name('payment-receipt.show');
    Route::crud('invoice-history', 'InvoiceHistoryCrudController');
});