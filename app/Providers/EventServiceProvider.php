<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\InvoiceCreated' => [
            'App\Listeners\PostCreatedInvoice',
            'App\Listeners\ScheduleInvoice',
            'App\Listeners\CreatePayment',
        ],
        'App\Events\PaymentReceiptCreated' => [
            'App\Listeners\SendReceipt',
        ],
        'App\Events\PaymentVerificationRequested' => [
            'App\Listeners\LogPaymentVerification',
        ],
        'App\Events\PaymentVerificationDeclined' => [
            'App\Listeners\LogPaymentDecline',
        ],
        'App\Events\PaymentVerificationApproved' => [
            'App\Listeners\LogPaymentApprove',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Invoice::observe(\App\Observers\InvoiceObserver::class);
        \App\Models\Payment::observe(\App\Observers\PaymentObserver::class);
        \App\Models\PaymentReceipt::observe(\App\Observers\PaymentReceiptObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
    }
}
