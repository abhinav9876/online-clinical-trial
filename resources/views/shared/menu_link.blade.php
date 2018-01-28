@if ( $active )
    <li class="active">
        <a href="{{ $link }}" class="nav-child">
            <span class="puzz-nav-branch"></span>
            {{ $title }}
        </a>
    </li>
@else
    <li>
        <a href="{{ $link }}" class="nav-child">
            <span class="puzz-nav-branch"></span>
            {{ $title }}
        </a>
    </li>
@endif
