<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
            </li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <div class="search-header">Histories</div>
                <div class="search-item">
                    <a href="#">How to Used HTML in Laravel</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="https://themeforest.net/user/admincraft/portfolio" target="_black">Admincraft
                        Portfolio</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">#CodiePie</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-header">Result</div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                        oPhone 11 Pro
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                        Drone Zx New Gen-3
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                        Headphone JBL
                    </a>
                </div>
                <div class="search-header">Projects</div>
                <div class="search-item">
                    <a href="https://themeforest.net/item/epice-laravel-admin-template-for-hr-project-management/24466729"
                        target="_black">
                        <div class="search-icon bg-danger text-white mr-3"><i class="fas fa-code"></i>
                        </div>
                        Epice Laravel - Admin Template
                    </a>
                </div>
                <div class="search-item">
                    <a href="https://themeforest.net/item/soccer-project-management-admin-template-ui-kit/24646866"
                        target="_black">
                        <div class="search-icon bg-primary text-white mr-3"><i class="fas fa-laptop"></i>
                        </div>
                        Soccer - Admin Template
                    </a>
                </div>
            </div>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ auth()->user()->profile_img_path() }}"
                    class="rounded-circle mr-1 profile-thumb">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                <a href="{{ route('profile.index') }}"
                    class="dropdown-item has-icon {{ request()->url() == route('profile.index') ? 'active' : '' }}"><i
                        class="far fa-user"></i>
                    Profile</a>
                <a href="{{ route('profile.change-password') }}"
                    class="dropdown-item has-icon {{ request()->url() == route('profile.change-password') ? 'active' : '' }}"><i
                        class="fas fa-bolt"></i>
                    Change Password</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item has-icon text-danger" onclick="document.getElementById('logOut').submit()"><i
                        class="fas fa-sign-out-alt"></i>
                    Logout
                </a>

                {{-- <form class="d-none" action="{{ route('admin.logout') }}" id="logOut" method="POST">
                    @csrf
                </form> --}}
            </div>
        </li>
    </ul>
</nav>
