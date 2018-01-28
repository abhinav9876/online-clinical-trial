<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('cro/home.menu-title-main')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType ==  config('menu.cro.home'),
        'link' => route('cro_home'),
        'title' => __('cro/home.menu-home')
    ])
</ul>

@can('cro-admin')
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('cro/home.menu-title-member')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.cro.member_create'),
        'link' => route('cro_member_create'),
        'title' => __('cro/home.menu-member-create')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.cro.member_list'),
        'link' => route('cro_member_list'),
        'title' => __('cro/home.menu-member-list')
    ])
</ul>
@endcan

<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('cro/home.menu-title-profile')
            <span class="caret"></span>
        </a>
    </li>
    @can('cro-admin')
        @include('shared.menu_link', [
            'active' => $activeMenuType == config('menu.cro.company'),
            'link' => route('cro_profile_company'),
            'title' => __('cro/home.menu-company')
        ])
    @endcan
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.cro.user'),
        'link' => route('cro_profile_user'),
        'title' => __('cro/home.menu-user')
    ])
    @can('cro-admin')
        @include('shared.menu_link', [
            'active' => $activeMenuType == config('menu.cro.billing'),
            'link' => route('cro_profile_billing'),
            'title' => __('cro/home.menu-billing')
        ])
    @endcan
</ul>
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('cro/home.menu-title-project')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.cro.project_create'),
        'link' => route('cro_project_create'),
        'title' => __('cro/home.menu-project-create')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.cro.project_list'),
        'link' => route('cro_project_list'),
        'title' => __('cro/home.menu-project-list')
    ])
</ul>
