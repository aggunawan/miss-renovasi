<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
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