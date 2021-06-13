@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <h3 class="text-center mb-4">{{ __('Konfirmasi Pembayaran') }}</h3>
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10"
                        enctype="multipart/form-data"
                        role="form"
                        method="POST"
                        action="{{ route('payment-confirmations.update', $payment) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div class="alert alert-info">
                                <p class="mb-0">{{ $payment->getStatus() }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="invoice[number]">{{ __('Nomor Invoice') }}</label>
                            <input type="text" class="form-control" disabled="true" value="{{ $payment->invoice->number }}">
                        </div>

                        @if ($payment->isConfirmable())
                            <div class="form-group">
                                <label class="control-label"for="payment[proof]">{{ __('Bukti Pembayaran') }}</label>

                                <input class="form-control-file {{ $errors->has('payment.proof') ? 'is-invalid' : null }}" type="file" name="payment[proof]">
                                @if ($errors->has('payment.proof'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('payment.proof') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success btn-block" type="submit">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
