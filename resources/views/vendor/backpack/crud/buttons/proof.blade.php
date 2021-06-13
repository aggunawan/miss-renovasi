@if ($entry->isVerifyable())
	<a href="{{ $entry->proof }}" target="_blank" class="mr-2">
		<i class="la la-image"></i> {{ __('Payment Proof') }}
	</a>
@endif
