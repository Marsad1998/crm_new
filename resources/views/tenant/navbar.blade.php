<!-- Main Header-->
<div class="main-header side-header header top-header">
    <div class="container">
        <div class="main-header-left">
            <a class="main-header-menu-icon d-lg-none" href="" id="mainNavShow"><span></span></a>
            <a class="main-logo" href="index.html">
                <img src="{{ global_asset('assets/img/brand/montys-logo.png') }}" class="width-137 header-brand-img desktop-logo" alt="logo">
                <!-- <img src="{{ global_asset('assets/img/brand/logo-light.png') }}" class="header-brand-img desktop-logo theme-logo" alt="logo"> -->
            </a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="index.html"><img src="{{ global_asset('assets/img/brand/montys-logo.png') }}" class="width-137 mobile-logo" alt="logo"></a>
                <!-- <a href="index.html"><img src="{{ global_asset('assets/img/brand/logo-light.png') }}" class="mobile-logo-dark" alt="logo"></a> -->
            </div>
        </div>
        <div class="main-header-right">
            <div class="input-group nav-input-group-lg">
                <input type="search" class="input100 form-control nav-form-control-lg rounded-0" placeholder="Search for anything...">
                <span class="focus-input100"></span>
                <button class="btn search-btn nav-search-btn-lg tenant-btn "><i class="fe fe-search"></i></button>
            </div>
            <div class="dropdown header-search">
                <a class="nav-link icon header-search">
                    <i class="fe fe-search"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="main-form-search p-2">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for anything...">
                            <button class="btn search-btn tenant-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown main-header-notification">
                <a class="nav-link icon" href="">
                    <i class="fe fe-bell header-icons"></i>
                    <span class="badge bg-danger nav-link-badge">4</span>
                </a>
                <div class="dropdown-menu br-radius-15">
                    <div class="header-navheading">
                        <p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
                    </div>
                    <div class="main-notification-list">
                        <div class="media new">
                            <div class="main-img-user online"><img alt="avatar" src="{{ global_asset('assets/img/users/5.jpg') }}"></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user"><img alt="avatar" src="{{ global_asset('assets/img/users/2.jpg') }}"></div>
                            <div class="media-body">
                                <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user online"><img alt="avatar" src="{{ global_asset('assets/img/users/3.jpg') }}"></div>
                            <div class="media-body">
                                <p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">View All Notifications</a>
                    </div>
                </div>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user" ><img alt="avatar" src="{{ global_asset('assets/img/users/1.jpg') }}"></span>
                </a>
                <div class="dropdown-menu br-radius-15">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ auth()->user()->name }}</h6>
                        <p class="main-notification-text">{{ auth()->user()->role->name }}</p>
                    </div>
                    <a class="dropdown-item border-top" href="profile.html">
                        <i class="fe fe-user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="profile.html">
                        <i class="fe fe-edit"></i> Edit Profile
                    </a>
                    <a class="dropdown-item" href="profile.html">
                        <i class="fe fe-settings"></i> Account Settings
                    </a>
                    <a class="dropdown-item" href="profile.html">
                        <i class="fe fe-settings"></i> Support
                    </a>
                    <a class="dropdown-item" href="profile.html">
                        <i class="fe fe-compass"></i> Activity
                    </a>
                    <a class="dropdown-item" href="/logout">
                        <i class="fe fe-power"></i> Sign Out
                    </a>
                </div>
            </div>
            {{-- <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
                    <i class="fe fe-align-right header-icons"></i>
                </a>
            </div> --}}
            <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
        </div>
    </div>
</div>
<!-- End Main Header-->


<!-- Mobile-header -->
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ms-auto">
                <div class="dropdown header-search">
                    <a class="nav-link icon header-search">
                        <i class="fe fe-search header-icons"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-form-search p-2">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search for anything...">
                                <button class="btn search-btn tenant-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown main-header-notification">
                    <a class="nav-link icon" href="">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge bg-danger nav-link-badge">4</span>
                    </a>
                    <div class="dropdown-menu br-radius-15">
                        <div class="header-navheading">
                            <p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
                        </div>
                        <div class="main-notification-list">
                            <div class="media new">
                                <div class="main-img-user online"><img alt="avatar" src="{{ global_asset('assets/img/users/5.jpg') }}"></div>
                                <div class="media-body">
                                    <p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user"><img alt="avatar" src="{{ global_asset('assets/img/users/2.jpg') }}"></div>
                                <div class="media-body">
                                    <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user online"><img alt="avatar" src="{{ global_asset('assets/img/users/3.jpg') }}"></div>
                                <div class="media-body">
                                    <p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">View All Notifications</a>
                        </div>
                    </div>
                </div>

                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user" ><img alt="avatar" src="{{ global_asset('assets/img/users/1.jpg') }}"></span>
                    </a>
                    <div class="dropdown-menu br-radius-15">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">{{ auth()->user()->name }}</h6>
                            <p class="main-notification-text">{{ auth()->user()->role->name }}</p>
                        </div>
                        <a class="dropdown-item border-top" href="profile.html">
                            <i class="fe fe-user"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-settings"></i> Account Settings
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-settings"></i> Support
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-compass"></i> Activity
                        </a>
                        <a class="dropdown-item" href="/logout">
                            <i class="fe fe-power"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile-header closed -->

<!-- Horizonatal menu-->
<div class="main-navbar hor-menu sticky tenant-nav">
    <div class="container">
        <ul class="nav">

            @php                
                $mains = [
                    [
                        'name' => 'Dashboard',
                        'icon' => 'ti-home',
                        'option' => [],
                        'path' => '/home',
                        'access' => auth()->user()->can('View Dashboard') == 1 ? '' : 'd-none',
                        'class' => request()->is('dashboard') ? 'active' : '',
                    ],
                    [
                        'name' => 'Basic Modules',
                        'icon' => 'ti-package',
                        'class' => request()->is('users') || request()->is('manage_roles') || request()->is('assign_permission') ? 'active' : '',
                        'class2' => request()->is('users') || request()->is('manage_roles') || request()->is('assign_permission') ? 'show active' : '',
                        'option' => [
                            [
                                'name' => 'Manage Staff',
                                'path' => '/users',
                                'class' => request()->is('users') ? 'active' : '',
                                'access' => auth()->user()->can('View Staff') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Staff Roles',
                                'path' => '/manage_roles',
                                'class' => request()->is('manage_roles') ? 'active' : '',
                                'access' => auth()->user()->can('View Role') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Assign Permissions',
                                'path' => '/assign_permission',
                                'class' => request()->is('assign_permission') ? 'active' : '',
                                'access' => auth()->user()->can('View Permission') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Activity Logs',
                                'path' => '/activity_logs',
                                'class' => request()->is('activity_logs') ? 'active' : '',
                                'access' => auth()->user()->can('Logs Permission') == 1 ? '' : 'd-none',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Settings',
                        'icon' => 'ti-settings',
                        'class' => request()->is('makes_n_models') || request()->is('services') ? 'active' : '',
                        'class2' => request()->is('makes_n_models') || request()->is('services') ? 'show active' : '',
                        'option' => [
                            [
                                'name' => 'Category',
                                'path' => '/category',
                                'class' => request()->is('category') ? 'active' : '',
                                'access' => auth()->user()->can('View Category') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Makes & Models',
                                'path' => '/makes_n_models',
                                'class' => request()->is('makes_n_models') ? 'active' : '',
                                'access' => auth()->user()->can('View Make n Model') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Options',
                                'path' => route('option.index'),
                                'class' => request()->is('option.index') ? 'active' : '',
                                'access' => auth()->user()->can('View Options') == 1 ? '' : 'd-none',
                            ],
                            [
                                'name' => 'Quote Configurator',
                                'path' => route('quote.config'),
                                'class' => request()->is('quote.config') ? 'active' : '',
                                'access' => auth()->user()->can('View Options') == 1 ? '' : 'd-none',
                            ],
                        ]
                    ]
                ];
            @endphp

            @foreach ($mains as $main)
                @if (empty($main['option']))
                    <li class="nav-item text-capitalize">
                        <a class="nav-link" href="{{$main['path']}}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="{{$main['icon']}} sidemenu-icon"></i>
                            <span class="sidemenu-label">
                                {{$main['name']}}
                            </span>
                        </a>
                    </li>
                @else
                    <li class="nav-item text-capitalize">
                        <a class="nav-link with-sub" href="#">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="{{ $main['icon'] }} sidemenu-icon"></i> {{$main['name']}}
                        </a>
                        <div class="svg-wrap">
                            <svg viewBox="0 0 400 20" xmlns="http://www.w3.org/2000/svg">
                            <path id="svg_line" d="m 1.986,8.91 c 55.429038,4.081 111.58111,5.822 167.11781,2.867 22.70911,-1.208 45.39828,-0.601 68.126,-0.778 28.38173,-0.223 56.76079,-1.024 85.13721,-1.33 24.17379,-0.261 48.42731,0.571 72.58115,0.571"></path>
                            </svg>
                        </div>
                        <ul class="nav-sub br-radius-15">
                            @foreach ($main['option'] as $option)
                                <li class="nav-sub-item {{ $option['access'] }} link-svgline sec-link-svgline" style="color:black">
                                        <a class="nav-sub-link cstm-nsb" href="{{ $option['path'] }}">{{ $option['name'] }}<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
            
            {{-- 
            <li class="nav-item">
                <a class="nav-link with-sub" href=""><i class="ti-palette"></i>Pages</a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="profile.html">Profile</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="invoice.html">Invoice</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="pricing.html">Pricing</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link with-sub" href="pricing.html">Alertpages</a>
                        <ul class="nav-sub">
                            <li class="nav-sub-item">
                                <a class="nav-sub-link" href="success-message.html">Success Message</a>
                            </li>
                            <li class="nav-sub-item">
                                <a class="nav-sub-link" href="danger-message.html">Danger Message</a>
                            </li>
                            <li class="nav-sub-item">
                                <a class="nav-sub-link" href="warning-message.html">Warning Message</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="gallery.html">Gallery</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="faq.html">Faqs</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="empty.html">Empty Page</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="signin.html">Sign In</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="signup.html">Sign Up</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="forgot.html">Forgot Password</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="reset.html">Reset Password</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="lockscreen.html">Lockscreen</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="underconstruction.html">UnderConstruction</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="404.html">404 Error</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="500.html">500 Error</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
<!--End  Horizonatal menu-->