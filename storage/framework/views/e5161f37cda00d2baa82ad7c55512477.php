<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="index.html">
            <img src="assets/img/brand/logo-light.png" class="header-brand-img desktop-logo" alt="logo">
            <img src="assets/img/brand/icon-light.png" class="header-brand-img icon-logo" alt="logo">
            <img src="assets/img/brand/logo.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
            <img src="assets/img/brand/icon.png" class="header-brand-img icon-logo theme-logo" alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <?php
                
                $mains = [
                    [
                        'name' => 'Dashboard',
                        'icon' => 'ti-home',
                        'option' => [],
                        'path' => '/home',
                        'access' => '',#Auth::user()->can('View Dashboard') == 1 ? '' : 'd-none',
                        'class' => request()->is('dashboard') ? 'active' : '',
                    ],
                    [
                        'name' => 'Basic Modules',
                        'icon' => 'ti-package',
                        'class' => request()->is('manage_users') ? 'active' : '',
                        'class2' => request()->is('manage_users') ? 'show active' : '',
                        'chevron' => request()->is('manage_users') ? 'chevron-up' : 'chevron-down',
                        'option' => [
                            [
                                'name' => 'manage staff',
                                'path' => '/manage_staff',
                                'class' => request()->is('manage_users') ? 'active' : '',
                                'access' => '',#Auth::user()->can('View Users') == 1 ? '' : 'd-none',
                            ],
                        ],
                    ],
                ];
            ?>

            <?php $__currentLoopData = $mains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty($main['option'])): ?>
                    <li class="nav-item text-capitalize">
                        <a class="nav-link" href="<?php echo e($main['path']); ?>">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="<?php echo e($main['icon']); ?> sidemenu-icon"></i>
                            <span class="sidemenu-label">
                                <?php echo e($main['name']); ?>

                            </span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item text-capitalize op-9">
                        <a class="nav-link with-sub" href="#">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="<?php echo e($main['icon']); ?> sidemenu-icon"></i>
                            <span class="sidemenu-label"><?php echo e($main['name']); ?></span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="nav-sub">
                            <?php $__currentLoopData = $main['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-sub-item <?php echo e($option['access']); ?>" style="color:black">
                                    <a class="nav-sub-link" href="<?php echo e($option['path']); ?>">
                                        <?php echo e($option['name']); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>
</div>
<!-- End Sidemenu -->

<!-- Main Header-->
<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="index.html"><img src="assets/img/brand/logo.png" class="mobile-logo" alt="logo"></a>
                <a href="index.html"><img src="assets/img/brand/logo-light.png" class="mobile-logo-dark" alt="logo"></a>
            </div>

        </div>
        <div class="main-header-right">
            <div class="dropdown main-header-notification">
                <a class="nav-link icon" href="">
                    <i class="fe fe-bell header-icons"></i>
                    <span class="badge bg-danger nav-link-badge">4</span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
                    </div>
                    <div class="main-notification-list">
                        <div class="media new">
                            <div class="main-img-user online"><img alt="avatar" src="assets/img/users/5.jpg"></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user"><img alt="avatar" src="assets/img/users/2.jpg"></div>
                            <div class="media-body">
                                <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user online"><img alt="avatar" src="assets/img/users/3.jpg"></div>
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
                    <span class="main-img-user" ><img alt="avatar" src="assets/img/users/1.jpg"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title"><?php echo e(auth()->user()->name); ?></h6>
                        <p class="main-notification-text">Centeral System</p>
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
                                <button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown main-header-notification">
                    <a class="nav-link icon" href="">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge bg-danger nav-link-badge">4</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
                        </div>
                        <div class="main-notification-list">
                            <div class="media new">
                                <div class="main-img-user online"><img alt="avatar" src="assets/img/users/5.jpg"></div>
                                <div class="media-body">
                                    <p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user"><img alt="avatar" src="assets/img/users/2.jpg"></div>
                                <div class="media-body">
                                    <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user online"><img alt="avatar" src="assets/img/users/3.jpg"></div>
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
                        <span class="main-img-user" ><img alt="avatar" src="assets/img/users/1.jpg"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title"><?php echo e(auth()->user()->name); ?></h6>
                            <p class="main-notification-text">Web Designer</p>
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
<!-- Mobile-header closed --><?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/central/navbar.blade.php ENDPATH**/ ?>