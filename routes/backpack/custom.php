<?php

use App\Http\Controllers\NotifyStatementController;
use App\Http\Controllers\StatementController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::post('notify/{statement}', [NotifyStatementController::class, 'store'])->name('notify.store');
    Route::get('statements/{statement}', [StatementController::class, 'show'])->name('statements.show');
    Route::crud('account', 'AccountCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('bank', 'BankCrudController');
    Route::crud('invoice', 'InvoiceCrudController');
});