@if ($crud->hasAccess('show'))
	<a href="{{ route('statements.show', $entry->getKey()) }}" class="btn btn-sm btn-link">
		<i class="la la-file"></i> {{ __('PDF') }}
	</a>
@endif