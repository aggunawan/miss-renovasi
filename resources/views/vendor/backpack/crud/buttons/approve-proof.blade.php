@if ($entry->isVerifyable())
	<button class="btn btn-sm btn-link text-success" onclick="document.getElementById('approveProof{{ $entry->getKey() }}').submit()">
		<i class="la la-check"></i> {{ __('Approve') }}
	</button>

	<form style="display: none;" action="{{ route('payment-approve.store', $entry) }}" method="POST" id="approveProof{{ $entry->getKey() }}">
		@csrf
	</form>
@endif