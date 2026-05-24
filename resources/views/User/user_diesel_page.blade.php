<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mas - User Diesel Tracking</title>

    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css.php')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #1e1e2e;
            color: #ffffff;
        }
        .admin-card {
            background: #2b2b3c;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 24px;
        }

        /* Custom styles to match the paper table strictly */
        .logbook-table {
            font-size: 0.85rem;
            border-collapse: collapse;
            width: 100%;
            background-color: transparent;
            color: #dee2e6;
        }
        .logbook-table th, .logbook-table td {
            border: 1px solid rgba(255, 255, 255, 0.22);
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            background-color: rgba(15, 23, 42, 0.96);
            color: #ffffff !important;
            font-weight: 600;
        }
        .logbook-table thead th {
            background-color: rgba(10, 18, 34, 0.98);
            font-weight: 700;
            text-transform: uppercase;
            color: #ffffff !important;
        }
        .logbook-table tbody td {
            background-color: rgba(15, 23, 42, 0.92);
            color: #ffffff !important;
        }
        .logbook-table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.16);
        }
        .table-title-row th {
            background-color: #111625 !important;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #4dc3c3;
        }
        .sub-header th {
            font-size: 0.75rem;
            color: #e3e9f0;
        }
    </style>
</head>
<body>

@include('user.component.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-3 col-lg-2 px-0">
            @include('user.component.sidebar')
        </div>

        <!-- Main Content Column -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0" style="color: #ffffff;">Diesel Logbook</h2>
                <div>
                    <a href="{{ route('userDiesel.download') }}" class="btn btn-sm btn-primary">Download CSV / Push to Sheets</a>
                </div>
            </div>

            <div class="card admin-card">
                <div class="table-responsive">
                    <table class="logbook-table">
                        <thead>
                            <!-- Title Row -->
                            <tr class="table-title-row">
                                <th colspan="13" class="py-3">DAILY DIESEL STOCK</th>
                            </tr>

                            <!-- Main Headings Row -->
                            <tr>
                                <th rowspan="2" style="width: 4%">No.</th>
                                <th rowspan="2" style="width: 8%">DATE</th>
                                <th colspan="2">MAIN STORAGE TANK - 15500L</th>
                                <th colspan="2">BOILER DAY TANK - 1500L</th>
                                <th>GENERATOR 1<br>PRODUCTION - 830L</th>
                                <th>GENERATOR 2<br>CHILLER 1600L</th>
                                <th>GENERATOR 3<br>CAT 650L</th>
                                <th>TOTAL STOCK AT PLANT<br>20080L</th>
                                <th rowspan="2">Username</th>
                                <th rowspan="2">UPDATED AT</th>

                                <!-- <th rowspan="2">Admin Password</th> -->
                            </tr>

                            <!-- Sub Headings Row -->
                            <tr class="sub-header">
                                <th>Level(cm)</th>
                                <th>Liters</th>
                                <th>Level(cm)</th>
                                <th>Liters</th>
                                <th>Liters</th>
                                <th>Liters</th>
                                <th>Liters</th>
                                <th>Liters</th>
                            </tr>
                        </thead>
                        <tbody id="dieselTableBody">
                            @forelse($diesels as $diesel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold" style="color: #4dc3c3;">
                                        {{ \Carbon\Carbon::parse($diesel->diesel_fill_date)->format('d/m') }}
                                    </td>
                                    <td>{{ $diesel->main_storage_tank_level ?? '-' }}</td>
                                    <td>{{ $diesel->main_storage_tank_liters ?? '-' }}</td>
                                    <td>{{ $diesel->boiler_day_tank_level ?? '-' }}</td>
                                    <td>{{ $diesel->boiler_day_tank_liters ?? '-' }}</td>
                                    <td>{{ $diesel->generator_1_liters ?? '-' }}</td>
                                    <td>{{ $diesel->generator_2_liters ?? '-' }}</td>
                                    <td>{{ $diesel->generator_3_liters ?? '-' }}</td>
                                    <td class="fw-bold text-success">{{ number_format($diesel->deisel_total_liters ?? 0) }}</td>
                                    <td>{{ $diesel->admin_username ?? '-' }}</td>
                                    <td>{{ $diesel->updated_at ? \Carbon\Carbon::parse($diesel->updated_at)->timezone(config('app.timezone'))->format('H:i d/m') : '-' }}</td>

                                    <!-- <td>{{ $diesel->admin_password ?? '-' }}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5 text-white-50">
                                        <i class="bi bi-journal-x display-4 d-block mb-3"></i>
                                        No daily diesel stock records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="{{asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const refreshUrl = '{{ route('userDiesel.refresh') }}';
        const tbody = document.getElementById('dieselTableBody');

        function refreshDieselTable() {
            if (!tbody) return;
            fetch(refreshUrl, { headers: { 'Accept': 'application/json' } })
                .then(response => response.ok ? response.json() : Promise.reject())
                .then(data => {
                    if (data.html) {
                        tbody.innerHTML = data.html;
                    }
                })
                .catch(() => {
                    // ignore refresh errors silently
                });
        }

        // Refresh every 12 seconds to keep the user panel updated with new admin entries.
        setInterval(refreshDieselTable, 12000);
    });
</script>

</body>
</html>
