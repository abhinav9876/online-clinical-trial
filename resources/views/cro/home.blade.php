@extends('layouts.app-cro')

@section('content')
<h1 class="">Home</h1>

<div class="menu-list">
    <div class="menu">
        @include('shared.home-menu', [
            'link' => route('cro_profile_company'),
            'image' => asset('images/user.png'),
            'title' => __('cro/home.menu-company'),
            'text' => __('cro/home.menu-company-description')
        ])
    </div>
    <div class="menu">
        @include('shared.home-menu', [
            'link' => route('cro_project_create'),
            'image' => asset('images/project.png'),
            'title' => __('cro/home.menu-project-create'),
            'text' => __('cro/home.menu-project-description')
        ])
    </div>
</div>
@endsection
