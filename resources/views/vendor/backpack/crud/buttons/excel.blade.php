@if ($crud->hasAccess('show'))
	<a href="{{ $entry->getReport() }}" class="btn btn-sm btn-link">
		<i class="la la-file-excel"></i> {{ __('Excel') }}
	</a>
@endif
