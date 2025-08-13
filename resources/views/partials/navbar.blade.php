<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 p-0">
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-body font-weight-bold px-0" href="#">
                        <i class="ni ni-bell-55"></i>
                        <span class="d-sm-inline d-none">Notifications</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body font-weight-bold px-0" href="#">
                        <i class="ni ni-user-run"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
