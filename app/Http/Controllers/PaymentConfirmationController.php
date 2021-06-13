<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\PaymentConfirmationUpdateRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentConfirmationController extends Controller
{
    public function show(Payment $payment)
    {
        $payment->load(['invoice']);

        return view('payment-confirmations.show', [
            'payment' => $payment
        ]);
    }

    public function update(Payment $payment, PaymentConfirmationUpdateRequest $request)
    {
        $payment->proof = $this->cloudinaryUpload($request, 'payment.proof');
        $payment->status = PaymentStatus::Pay;
        $payment->save();

        return redirect()->back();
    }

    protected function cloudinaryUpload(Request $request, string $file)
    {
        return $request->file($file)->storeOnCloudinary($this->cloudinaryFolder())->getSecurePath();
    }

    protected function cloudinaryFolder()
    {
        return config('services.cloudinary.folder');
    }
}
