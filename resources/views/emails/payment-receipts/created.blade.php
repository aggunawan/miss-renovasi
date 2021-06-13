@component('mail::message')
# Payment Receipt

Kwitansi Pembayaran telah dibuat untuk Invoice {{ $receipt->payment->invoice->number }}, atau Kwitansi dapat diunduh pada halaman berikut ini.

@component('mail::button', ['url' => route('payment-confirmations.show', $receipt->payment)])
Klik Disini
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
