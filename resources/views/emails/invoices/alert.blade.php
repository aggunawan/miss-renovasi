@component('mail::message')
# Invoice Notification

Berikut ini kami lampirkan Invoice dari CV Miss Renovasi.

Untuk mengirim bukti pembayaran, melihat status pembayaran dan mengunduh kwitansi pembayaran dapat dilakukan pada halaman berikut ini.

@component('mail::button', ['url' => route('payment-confirmations.show', $invoice->payment)])
Halaman Pembayaran
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
