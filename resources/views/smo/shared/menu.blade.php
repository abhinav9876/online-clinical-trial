<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('smo/home.menu-title-main')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.home'),
        'link' => route('home'),
        'title' => __('smo/home.menu-home')
    ])
</ul>

@can('smo-admin')
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('smo/home.menu-title-member')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.member_create'),
        'link' => route('smo_member_create'),
        'title' => __('smo/home.menu-member-create')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.member_list'),
        'link' => route('smo_member_list'),
        'title' => __('smo/home.menu-member-list')
    ])
</ul>
@endcan

<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('smo/home.menu-title-profile')
            <span class="caret"></span>
        </a>
    </li>
    @can('smo-admin')
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.company'),
        'link' => route('smo_profile_company'),
        'title' => __('smo/home.menu-company')
    ])
    @endcan
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.user'),
        'link' => route('smo_profile_user'),
        'title' => __('smo/home.menu-user')
    ])
</ul>
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('smo/home.menu-title-post')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.projects'),
        'link' => route('smo_projects'),
        'title' => __('smo/home.menu-post-list-projects')
    ])
</ul>
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('smo/home.menu-title-subject')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.posts_open'),
        'link' => route('smo_posts_open'),
        'title' => __('smo/home.menu-post-subjects-open')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.smo.posts_closed'),
        'link' => route('smo_posts_closed'),
        'title' => __('smo/home.menu-post-subjects-closed')
    ])
</ul>
