<aside class="sidebar navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidebar">
    <div class="sidebar-header">
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('img/logos/TFLogo.png') }}" class="navbar-brand-img h-100" alt="logo">
            <span class="ms-1 font-weight-bold">TaskForge</span>
        </a>
    </div>
    <div class="collapse navbar-collapse w-auto mt-4 min-h-vh text-black">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}"><i class="ni ni-tv-2 text-primary"></i><span class="nav-link-text ms-1 text-black">Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/tasks') }}"><i class="ni ni-bullet-list-67 text-orange"></i><span class="nav-link-text ms-1 text-black">Tasks</span></a></li>
        </ul>
    </div>
</aside>
