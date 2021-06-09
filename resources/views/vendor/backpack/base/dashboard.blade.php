@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => __('Miss Renovasi'),
        'content'     => 'Jln. Mahogani Raya Poris Plawad Kec. Cipondoh Kota Tangerang - 081290728311',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
@endphp

@section('content')
@endsection