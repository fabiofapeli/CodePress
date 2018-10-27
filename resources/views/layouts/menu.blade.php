<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">

        @can('access_categories')
            <li><a href="{{ url('/admin/categories') }}">Categories</a></li>
        @endcan
        @can('access_tags')
            <li><a href="{{ url('/admin/tags') }}">Tags</a></li>
        @endcan
        @can('access_posts')
            <li><a href="{{ url('/admin/posts') }}">Posts</a></li>
        @endcan
        @can('access_users')
            <li><a href="{{ url('/admin/users') }}">Users</a></li>
            <li><a href="{{ url('/admin/roles') }}">Roles</a></li>
            <li><a href="{{ url('/admin/permissions') }}">Permissions</a></li>
            <li><a href="{{ url('/admin/layouts') }}">Layouts</a></li>
        @endcan
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>