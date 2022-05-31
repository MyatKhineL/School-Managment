<li class=""><a class="nav-link {{ request()->url() == $link ? 'active-menu' : '' }}"
        href="{{ $link }}">{{ $slot }}</a>
</li>
