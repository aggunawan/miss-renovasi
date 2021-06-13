@if ($entry->isVerifyable())
	<button class="btn btn-sm btn-link text-danger" onclick="document.getElementById('declineProof{{ $entry->getKey() }}').submit()">
		<i class="la la-ban"></i> {{ __('Decline') }}
	</button>

	<form style="display: none;" action="{{ route('payment-decline.store', $entry) }}" method="POST" id="declineProof{{ $entry->getKey() }}">
		@csrf
	</form>
@endif
