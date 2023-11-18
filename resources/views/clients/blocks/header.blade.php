<header class="header_wrap fixed-top header_with_topbar">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">

                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>0349065773</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-end">
                        <ul class="header_list">
                            @auth
                                @if (auth()->user()->role == 1)
                                    <li><a href="{{ route('admin.home') }}"><i class="ti-user"></i><span
                                                class="text-danger">Admin</span></a>
                                    </li>
                                @endif
                                <li><a href="{{ route('logout') }}"><i class="ti-user"></i><span>Đăng xuất</span></a>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="ti-user"></i><span>Đăng nhập</span></a>
                                </li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="logo_light" src="{{ asset('assets/clients/images/logo_light.png') }}" alt="logo" />
                    <img class="logo_dark" src="{{ asset('assets/clients/images/logo_dark.png') }}" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li><a class="nav-link nav_item" href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a class="nav-link nav_item" href="{{ route('contact') }}">Liên hệ</a></li>
                        {!! Helper::category() !!}
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="{{route('cart')}}"
                            ><i class="linearicons-cart"></i><span class="cart_count amount"
                                id="cart-item">0</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
