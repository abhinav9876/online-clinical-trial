
<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('admin/home.menu-title-main')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.admin.home'),
        'link' => route('home'),
        'title' => __('admin/home.menu-home')
    ])
</ul>

<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('admin/home.menu-title-cro')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.admin.cro_create'),
        'link' => route('admin_cro_create'),
        'title' => __('admin/home.menu-cro-create')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.admin.cro_list'),
        'link' => route('admin_cro_list'),
        'title' => __('admin/home.menu-cro-list')
    ])
</ul>

<ul class="nav puzz-nav-sidebar">
    <li class="">
        <a href="" class="nav-super">
            @lang('admin/home.menu-title-smo')
            <span class="caret"></span>
        </a>
    </li>
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.admin.smo_create'),
        'link' => route('admin_smo_create'),
        'title' => __('admin/home.menu-smo-create')
    ])
    @include('shared.menu_link', [
        'active' => $activeMenuType == config('menu.admin.smo_list'),
        'link' => route('admin_smo_list'),
        'title' => __('admin/home.menu-smo-list')
    ])
</ul>
