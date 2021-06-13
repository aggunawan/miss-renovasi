<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
</li>

@if (backpack_user()->can('manage-accounts'))
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('account') }}"><i class="nav-icon la la-user"></i> <span>{{ __('Accounts') }}</span></a>
</li>
@endif

@if (backpack_user()->can('manage-roles'))
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>{{ __('Roles') }}</span></a>
</li>
@endif

@if (backpack_user()->can('manage-permissions'))
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{ __('Permissions') }}</span></a>
</li>
@endif

@if (backpack_user()->can('manage-customers'))
<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('customer') }}'><i class='nav-icon la la-users'></i> {{ __('Customers') }}</a>
</li>
@endif

@if (backpack_user()->can('manage-bank-accounts'))
<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('bank') }}'><i class='nav-icon la la-id-card'></i> {{ __('Bank Accounts') }}</a>
</li>
@endif

@if (backpack_user()->can('manage-invoices'))
<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('invoice') }}'><i class='nav-icon la la-file-invoice-dollar'></i> {{ __('Invoices') }}</a>
</li>
@endif

@if (backpack_user()->can('manage-invoices'))
<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('payment') }}'><i class='nav-icon la la-wallet'></i> {{ __('Payments') }}</a>
</li>
@endif

@if (backpack_user()->can('manage-receipts'))
<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('receipt') }}'><i class='nav-icon la la-receipt'></i> {{ __('Receipts') }}</a>
</li>
@endif