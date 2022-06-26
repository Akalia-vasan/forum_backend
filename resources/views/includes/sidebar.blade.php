<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                General
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('home'))
                }}" href="{{ route('home') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                        Dashboard
                </a>
            </li>
            @auth
                @if (auth()->user()->isAdmin())
                    <li class="nav-title">
                        System
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle " href="#">
                            <i class="nav-icon far fa-user"></i>
                            Access
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link {{
                        active_class(Route::is('auth/user'))
                    }}" href="{{ route('auth.user.index') }}">
                                    Users Management

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                        active_class(Route::is('auth/role'))
                    }}" href="{{ route('auth.role.index') }}">
                                    Roles Management
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link " href="">
                                    Permissions Management
                                </a>
                            </li> -->
                        </ul>
                    </li>
                @endif    
            @endauth
            <li class="divider"></li>
            <li class="nav-item">
                <a class="nav-link {{
        active_class(Route::is('auth/posts'))
    }}" href="{{ route('auth.post.index') }}">
                    My Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{
        active_class(Route::is('auth/post-approval'))
    }}" href="{{ route('auth.post.approval.index') }}">
                    Post Approvals
                </a>
            </li>
        </ul>    
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
