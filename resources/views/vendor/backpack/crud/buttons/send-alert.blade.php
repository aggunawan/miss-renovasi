<form action="{{ route('notify.store', $entry) }}" id="notifyStatement{{ $entry->getKey() }}" method="POST">
	@csrf
</form>

<button type="button" class="btn btn-sm btn-link" onclick="document.getElementById('notifyStatement{{ $entry->getKey() }}').submit();">
	<i class="la la-paper-plane"></i> {{ __('Send') }}
</button>
