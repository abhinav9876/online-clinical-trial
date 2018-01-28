@extends('layouts.app-smo')

@section('content')
    <h1 class="">SMO Home</h1>

    <div class="menu-list">
        @can('smo-admin')
            <div class="menu">
                @include('shared.home-menu', [
                    'link' => route('smo_profile_company'),
                    'image' => asset('images/user.png'),
                    'title' => __('smo/home.menu-company'),
                    'text' => __('smo/home.menu-company-description')
                ])
            </div>
        @endcan
        <div class="menu">
            @include('shared.home-menu', [
                'link' => route('smo_projects'),
                'image' => asset('images/post.png'),
                'title' => __('smo/home.menu-post-list-projects'),
                'text' => __('smo/home.menu-post-description')
            ])
        </div>
        <div class="menu">
            @include('shared.home-menu', [
                'link' => route('smo_posts_open'),
                'image' => asset('images/subject.png'),
                'title' => __('smo/home.menu-title-subject'),
                'text' => __('smo/home.menu-subject-description')
            ])
        </div>
    </div>
@endsection
