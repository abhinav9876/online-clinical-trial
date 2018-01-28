@extends('layouts.app-admin')

@section('content')
<h3 class="">Admin ホーム</h3>

<div class="menu-list">
    <div class="menu">
        @include('shared.home-menu', [
            'link' => route('admin_cro_list'),
            'image' => asset('images/user.png'),
            'title' => __('admin/home.menu-title-cro'),
            'text' => __('admin/home.menu-cro-description')
        ])
    </div>
    <div class="menu">
        @include('shared.home-menu', [
            'link' => route('admin_smo_list'),
            'image' => asset('images/user.png'),
            'title' => __('admin/home.menu-title-smo'),
            'text' => __('admin/home.menu-smo-description')
        ])
    </div>
</div>
@endsection
