@if ($entry->isVerifyable())
	<button class="btn btn-sm btn-link text-success">
		<i class="la la-receipt"></i> {{ __('Receipt') }}
	</button>
@endif