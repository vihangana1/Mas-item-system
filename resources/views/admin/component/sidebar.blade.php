<style>
    /* Clean sidebar layout styles */
    .sidebar {
        min-height: 100vh;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #212529; /* Sleek dark mode background */
    }
    .sidebar .nav-link {
        font-weight: 500;
        transition: all 0.2s ease;
        padding: 0.8rem 1rem;
        border-radius: 8px;

    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff !important;
    }
    .sidebar .nav-link.active {
        background-color: #359090 !important;
        color: #fff !important;
    }
</style>

<!-- Sidebar Container -->
<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
{{--        <span class="fs-5 fw-bold text-uppercase tracking-wider" style="letter-spacing: 1px; color: #359090;">Navigation</span>--}}
    </div>
    <hr class="bg-secondary">

    <!-- Navigation Links -->
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="{{ route('admindashboard') }}" class="nav-link {{ request()->routeIs('admindashboard') ? 'active' : 'text-white' }}" aria-current="page">
                <i class="bi bi-house-door-fill me-2"></i>
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('dieselPage') }}" class="nav-link {{ request()->routeIs('dieselPage') ? 'active' : 'text-white' }}">
                <i class="bi bi-grid-fill me-2"></i>
                Diesel
            </a>
        </li>
{{--        <li>--}}
{{--            <a href="{{ route('item') }}" class="nav-link {{ request()->routeIs('item') ? 'active' : 'text-white' }}">--}}
{{--                <i class="bi bi-box-seam-fill me-2"></i>--}}
{{--                Products--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#" class="nav-link text-white">--}}
{{--                <i class="bi bi-cart-fill me-2"></i>--}}
{{--                Orders--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
    <hr class="bg-secondary">
</div>
<?php
