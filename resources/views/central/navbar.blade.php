@if ($section === 'topbar')
    <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom" style="padding: 0.570rem 1.25rem;">
        <div class="container-fluid">
            <button class="btn btn-sm btn-primary" id="sidebarToggle">
                <small class="material-icons">menu</small>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#!">Notifications</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#!">Action</a>
                            <a class="dropdown-item" href="#!">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">
                                <i class="material-icons align-middle">logout</i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@elseif($section === 'sidebar')
    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-dark text-light">Start Bootstrap</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                <i class="material-icons align-middle">dashboard</i> Dashboard
            </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                <i class="material-icons align-middle">group</i> Customers
            </a>
            
        </div>
    </div>    
    
@endif