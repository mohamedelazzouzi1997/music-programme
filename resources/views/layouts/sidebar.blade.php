<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar shadow-sm">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a class="flex space-x-2" href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo.png') }}"
                width="25" alt="Music Programme"><span class="m-l-10">Music Programme</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="{{ Request::segment(1) === 'artists' ? 'active open' : null }}"><a
                    href="{{ route('artists.index') }}"><i class="zmdi zmdi-account"></i><span>ARTISTES</span></a></li>
            <li class="{{ Request::segment(1) === 'musics' ? 'active open' : null }}"><a
                    href="{{ route('musics.index') }}"><i class="zmdi zmdi-collection-music"></i><span>MUSIC</span></a>
            </li>
            <li class="{{ Request::segment(1) === 'categories' ? 'active open' : null }}"><a
                    href="{{ route('categories.index') }}"><i class="zmdi zmdi-tag"></i><span>CATEGORIES</span></a>
            </li>
            <li class="{{ Request::segment(1) === 'generate' ? 'active open' : null }}"><a
                    href="{{ route('generatore') }}"><i class="zmdi zmdi-tag"></i><span>Generate</span></a>
            </li>


        </ul>
    </div>
</aside>
