<div class="sidebar">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="javascript:void(0)">@lang('pro/home.menu-title-main') <span class="caret"></span></a>
            <ul>
                <li>
                    <a href="/" class="{{ $activeMenuType == config('menu.pro.home') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-home')
                    </a>
                </li>
            </ul>
        </li>

        @can('pro-admin')
        <li>
            <a href="javascript:void(0)">@lang('pro/home.menu-title-member') <span class="caret"></span></a>
            <ul>
                <li>
                    <a href="/pro/members/new" class="{{ $activeMenuType == config('menu.pro.members_new') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-member-create')
                    </a>
                </li>
                <li>
                    <a href="/pro/members" class="{{ $activeMenuType == config('menu.pro.members_index') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-member-list')
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        <li>
            <a href="javascript:void(0)">@lang('pro/home.menu-title-profile') <span class="caret"></span></a>
            <ul>
                @can('pro-admin')
                <li>
                    <a href="/pro/company" class="{{ $activeMenuType == config('menu.pro.company') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-company')
                    </a>
                </li>
                @endcan
                <li>
                    <a href="/pro/profile" class="{{ $activeMenuType == config('menu.pro.profile') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-user')
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0)">@lang('pro/home.menu-title-project') <span class="caret"></span></a>
            <ul>
                <li>
                    <a href="/pro/projects" class="{{ $activeMenuType == config('menu.pro.projects') ? ' active' : '' }}">
                        <span class="puzz-nav-branch"></span> @lang('pro/home.menu-project-list')
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>