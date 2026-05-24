<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mas - Admin Dashboard</title>

    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css.php')}}">

    <style>
        /* Ensures smooth scaling for your dashboard carousel image elements */
        .carousel-img {
            max-height: 350px;
            object-fit: cover;
            width: 100%;
        }
        /* Custom subtle scale animation when hovering admin category cards */
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        /* Creative styling for your dashboard widgets */
        .stat-card {
            background: linear-gradient(135deg, #2b2b3c 0%, #1e1e2e 100%);
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 16px !important;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Subtle background glow effect */
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 130px;
            height: 130px;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Beautiful transform & shadow on hover */
        .stat-card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4), 0 0 15px rgba(13, 110, 253, 0.15) !important;
            border-color: rgba(13, 110, 253, 0.4) !important;
        }

        /* Styling the icon circle container */
        .icon-shape {
            width: 48px;
            height: 48px;
            background: rgba(13, 110, 253, 0.15);
            color: #0d6efd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

@include('admin.component.header')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 px-0">
            @include('admin.component.sidebar')
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <div class="row g-4">

                <!-- Total Categories Card -->
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="{{route('dieselPage')}}" class="text-decoration-none">
                        <div class="card stat-card stat-card-hover h-100 p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <span class="text-uppercase tracking-wider text-muted small fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                                        Overview
                                    </span>
                                    <h2 class="text-white fw-extrabold m-0 mt-1" style="font-size: 2.2rem; font-weight: 800;">
                                        {{ $dieselsCount }}
                                    </h2>
                                </div>
                                <div class="icon-shape shadow-sm" style="color: #20c997; background: rgba(32, 201, 151, 0.15);">
                                    <i class="bi bi-grid-fill"></i>
                                </div>
                            </div>

                            <div class="pt-2 border-top border-secondary border-opacity-25">
                                <p class="text-white-50 m-0 fw-medium d-flex align-items-center" style="font-size: 0.95rem;">
                                    Total Diesels
                                    <i class="bi bi-arrow-right-short ms-1 text-success"></i>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

{{--                <!-- Total Products Card -->--}}
{{--                <div class="col-12 col-sm-6 col-md-3 col-lg-3">--}}
{{--                    <a href="{{route('item')}}" class="text-decoration-none">--}}
{{--                        <div class="card stat-card stat-card-hover h-100 p-4">--}}
{{--                            <div class="d-flex align-items-center justify-content-between mb-3">--}}
{{--                                <div>--}}
{{--                                    <span class="text-uppercase tracking-wider text-muted small fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">--}}
{{--                                        Overview--}}
{{--                                    </span>--}}
{{--                                    <h2 class="text-white fw-extrabold m-0 mt-1" style="font-size: 2.2rem; font-weight: 800;">--}}
{{--                                        {{ $itemsCount }}--}}
{{--                                    </h2>--}}
{{--                                </div>--}}
{{--                                <div class="icon-shape shadow-sm" style="color: #fd7e14; background: rgba(253, 126, 20, 0.15);">--}}
{{--                                    <i class="bi bi-box-seam-fill"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pt-2 border-top border-secondary border-opacity-25">--}}
{{--                                <p class="text-white-50 m-0 fw-medium d-flex align-items-center" style="font-size: 0.95rem;">--}}
{{--                                    Total Products--}}
{{--                                    <i class="bi bi-arrow-right-short ms-1 text-warning"></i>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Total Orders Card -->--}}
{{--                <div class="col-12 col-sm-6 col-md-3 col-lg-3">--}}
{{--                    <a href="#" class="text-decoration-none">--}}
{{--                        <div class="card stat-card stat-card-hover h-100 p-4">--}}
{{--                            <div class="d-flex align-items-center justify-content-between mb-3">--}}
{{--                                <div>--}}
{{--                                    <span class="text-uppercase tracking-wider text-muted small fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">--}}
{{--                                        Overview--}}
{{--                                    </span>--}}
{{--                                    <h2 class="text-white fw-extrabold m-0 mt-1" style="font-size: 2.2rem; font-weight: 800;">--}}
{{--                                        {{ $ordersCount }}--}}
{{--                                    </h2>--}}
{{--                                </div>--}}
{{--                                <div class="icon-shape shadow-sm" style="color: #0d6efd; background: rgba(13, 110, 253, 0.15);">--}}
{{--                                    <i class="bi bi-cart-fill"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pt-2 border-top border-secondary border-opacity-25">--}}
{{--                                <p class="text-white-50 m-0 fw-medium d-flex align-items-center" style="font-size: 0.95rem;">--}}
{{--                                    Orders--}}
{{--                                    <i class="bi bi-arrow-right-short ms-1 text-primary"></i>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Complete Orders Card -->--}}
{{--                <div class="col-12 col-sm-6 col-md-3 col-lg-3">--}}
{{--                    <a href="#" class="text-decoration-none">--}}
{{--                        <div class="card stat-card stat-card-hover h-100 p-4">--}}
{{--                            <div class="d-flex align-items-center justify-content-between mb-3">--}}
{{--                                <div>--}}
{{--                                    <span class="text-uppercase tracking-wider text-muted small fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">--}}
{{--                                        Overview--}}
{{--                                    </span>--}}
{{--                                    <h2 class="text-white fw-extrabold m-0 mt-1" style="font-size: 2.2rem; font-weight: 800;">--}}
{{--                                        {{ $completedOrdersCount }}--}}
{{--                                    </h2>--}}
{{--                                </div>--}}
{{--                                <div class="icon-shape shadow-sm" style="color: #6f42c1; background: rgba(111, 66, 193, 0.15);">--}}
{{--                                    <i class="bi bi-check-circle-fill"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pt-2 border-top border-secondary border-opacity-25">--}}
{{--                                <p class="text-white-50 m-0 fw-medium d-flex align-items-center" style="font-size: 0.95rem;">--}}
{{--                                    Complete Orders--}}
{{--                                    <i class="bi bi-arrow-right-short ms-1" style="color: #6f42c1;"></i>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </main>
    </div>
</div>

<script src="{{asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
