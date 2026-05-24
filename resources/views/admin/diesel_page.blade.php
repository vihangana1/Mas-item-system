<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mas - Diesel Tracking</title>

    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css.php')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #1e1e2e;
            color: #ffffff;
        }
        .admin-card {
            background: linear-gradient(135deg, #2b2b3c 0%, #1e1e2e 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 24px;
        }
        .table {
            color: #ffffff;
            font-size: 0.9rem;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .add-category-btn {
            background-color: #359090;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .add-category-btn:hover {
            background-color: #2b7575;
            transform: translateY(-2px);
        }
        .modal-content {
            background-color: #2b2b3c !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            background-color: #2b2b3c !important;
            color: #ffffff !important;
        }
        .modal-body {
            background-color: #2b2b3c !important;
            color: #ffffff !important;
        }
        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            background-color: #2b2b3c !important;
            color: #ffffff !important;
        }
        .form-control {
            background-color: #1e1e2e !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }
        .form-control:focus {
            background-color: #252538 !important;
            border-color: #359090 !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .form-label {
            color: #ffffff !important;
            font-size: 0.9rem;
        }
        .required-star {
            color: #ff4d4d;
            font-weight: bold;
            margin-left: 2px;
        }
        /* Modal Guide Card */
        .guide-card {
            background-color: rgba(53, 144, 144, 0.08);
            border: 1px solid rgba(53, 144, 144, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .guide-title {
            color: #4dc3c3;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .guide-list {
            margin: 0;
            padding-left: 20px;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.8);
        }
        .guide-list li {
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

@include('admin.component.header')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-3 col-lg-2 px-0">
            @include('admin.component.sidebar')
        </div>

        <!-- Main Content Column -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 animate__animated animate__fadeIn" role="alert" style="background-color: #1b4d3e; color: #a3e2c9; border-radius: 8px;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 animate__animated animate__fadeIn" role="alert" style="background-color: #5c1d24; color: #f5c2c7; border-radius: 8px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 animate__animated animate__fadeIn" role="alert" style="background-color: #5c1d24; color: #f5c2c7; border-radius: 8px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the following errors:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('userDieselPage') }}" class="btn btn-sm btn-light text-dark" target="_blank" title="Open User Dashboard">
                        <i class="bi bi-box-arrow-up-right me-1"></i> User Dashboard
                    </a>
                    <h2 class="fw-bold m-0" style="color: #ffffff;">Manage Diesel Data</h2>
                </div>
                <button type="button" class="btn btn-primary add-category-btn" data-bs-toggle="modal" data-bs-target="#addDieselModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Diesel Entry
                </button>
            </div>

            <!-- Diesel Data Card -->
            <div class="card admin-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-white-50" style="border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <tr>
                               <th scope="col" style="font-weight: 600;">No.</th>
                               <th scope="col" style="font-weight: 600;">Date</th>
                               <th scope="col" style="font-weight: 600;">Main Tank<br><small>Level / Liters</small></th>
                               <th scope="col" style="font-weight: 600;">Day Tank<br><small>Level / Liters</small></th>
                               <th scope="col" style="font-weight: 600;">Gen 1<br><small>(Liters)</small></th>
                               <th scope="col" style="font-weight: 600;">Gen 2<br><small>(Liters)</small></th>
                               <th scope="col" style="font-weight: 600;">Gen 3<br><small>(Liters)</small></th>
                               <th scope="col" style="font-weight: 600;">Total Liters</th>
                               <th scope="col" style="font-weight: 600;"> Username</th>
                               <!-- <th scope="col" style="font-weight: 600;">Admin Password</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($diesels as $diesel)
                            <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                <td class="text-white-50">{{ $loop->iteration }}</td>
                                <td class="text-white-50">{{ $diesel->diesel_fill_date }}</td>
                                <td class="text-white-50">{{ $diesel->main_storage_tank_level ?? 0 }} cm / {{ $diesel->main_storage_tank_liters ?? 0 }} L</td>
                                <td class="text-white-50">{{ $diesel->boiler_day_tank_level ?? 0 }} cm / {{ $diesel->boiler_day_tank_liters ?? 0 }} L</td>
                                <td class="text-white-50">{{ $diesel->generator_1_liters ?? 0 }} L</td>
                                <td class="text-white-50">{{ $diesel->generator_2_liters ?? 0 }} L</td>
                                <td class="text-white-50">{{ $diesel->generator_3_liters ?? 0 }} L</td>
                                <td class="text-white-50 fw-bold">{{ number_format($diesel->deisel_total_liters ?? 0) }} L</td>
                                <td class="text-white-50">{{ $diesel->admin_username ?? '-' }}</td>
                                <!-- <td class="text-white-50">{{ $diesel->admin_password ?? '-' }}</td> -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-white-50">
                                    <i class="bi bi-droplet-half display-4 d-block mb-3" style="color: #359090;"></i>
                                    No diesel records found. Click "Add Diesel Entry" to create one.
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

<!-- Bootstrap Modal Form for Adding Diesel -->
<div class="modal fade" id="addDieselModal" tabindex="-1" aria-labelledby="addDieselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-droplet-fill fs-4" style="color: #359090;"></i>
                    <h5 class="modal-title fw-bold" id="addDieselModalLabel" style="color: #359090; margin: 0;">Add New Diesel Entry</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('diesel.save')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="guide-card">
                        <div class="guide-title">
                            <i class="bi bi-info-circle-fill"></i> Data Submission Guide
                        </div>
                        <ul class="guide-list">
                            <li>Fill out the data for each tank and generator.</li>
                            <li>You do not need to fill in all the fields if not applicable.</li>
                            <li>The Total Liters will be automatically calculated based on the inputs provided.</li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="diesel_fill_date" class="form-label fw-semibold">Date <span class="required-star">*</span></label>
                            <input type="date" class="form-control" id="diesel_fill_date" name="diesel_fill_date" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="main_storage_tank_level" class="form-label fw-semibold">Main Storage Tank Level (cm)</label>
                            <input type="number" step="1" min="0" class="form-control" id="main_storage_tank_level" name="main_storage_tank_level" placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="main_storage_tank_liters" class="form-label fw-semibold">Main Storage Tank Liters</label>
                            <input type="number" step="1" min="0" class="form-control add-liters" id="main_storage_tank_liters" name="main_storage_tank_liters" placeholder="0">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="boiler_day_tank_level" class="form-label fw-semibold">Boiler Day Tank Level (cm)</label>
                            <input type="number" step="1" min="0" class="form-control" id="boiler_day_tank_level" name="boiler_day_tank_level" placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="boiler_day_tank_liters" class="form-label fw-semibold">Boiler Day Tank Liters</label>
                            <input type="number" step="1" min="0" class="form-control add-liters" id="boiler_day_tank_liters" name="boiler_day_tank_liters" placeholder="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="generator_1_liters" class="form-label fw-semibold">Generator 1 Liters</label>
                            <input type="number" step="1" min="0" class="form-control add-liters" id="generator_1_liters" name="generator_1_liters" placeholder="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="generator_2_liters" class="form-label fw-semibold">Generator 2 Liters</label>
                            <input type="number" step="1" min="0" class="form-control add-liters" id="generator_2_liters" name="generator_2_liters" placeholder="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="generator_3_liters" class="form-label fw-semibold">Generator 3 Liters</label>
                            <input type="number" step="1" min="0" class="form-control add-liters" id="generator_3_liters" name="generator_3_liters" placeholder="0">
                        </div>
                        
                        <div class="col-md-12 mb-3 mt-3">
                            <label class="form-label fw-bold" style="color: #4dc3c3;">Total Stock at Plant (Liters)</label>
                            <input type="text" class="form-control fw-bold" id="total_stock_add" readonly style="background-color: rgba(53, 144, 144, 0.1) !important; color: #4dc3c3 !important;" value="0.00">
                                                <div class="col-md-6 mb-3 mt-3">
                                                    <label class="form-label fw-semibold">Admin Username <span class="required-star">*</span></label>
                                                    <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Enter username" required>
                                                </div>
                                                <div class="col-md-6 mb-3 mt-3">
                                                    <label class="form-label fw-semibold">Admin Password <span class="required-star">*</span></label>
                                                    <input type="text" class="form-control" id="admin_password" name="admin_password" readonly style="background-color: #1e1e2e; cursor: not-allowed;">
                                                </div>
                                                </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal" style="background-color: rgba(255,255,255,0.1); color: #fff;">Cancel</button>
                    <button type="submit" class="btn btn-success border-0" style="background-color: #359090; color: #fff;">Submit Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to sum integer values of specific inputs and format with commas
        function calculateTotal(inputsClass, outputId) {
            let total = 0;
            const inputs = document.querySelectorAll(inputsClass);
            inputs.forEach(input => {
                const val = parseInt(input.value, 10);
                if (!isNaN(val)) {
                    total += val;
                }
            });
            const output = document.getElementById(outputId);
            if (output) {
                output.value = total.toLocaleString('en-US');
            }
        }

        function showAlert(message, type = 'success') {
            const alertContainer = document.createElement('div');
            alertContainer.className = `alert alert-${type} alert-dismissible fade show border-0 shadow-sm mb-4 animate__animated animate__fadeIn`;
            alertContainer.setAttribute('role', 'alert');
            alertContainer.style.backgroundColor = type === 'success' ? '#1b4d3e' : '#5c1d24';
            alertContainer.style.color = type === 'success' ? '#a3e2c9' : '#f5c2c7';
            alertContainer.style.borderRadius = '8px';
            alertContainer.innerHTML = `
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'} me-2"></i> ${message}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            const main = document.querySelector('main');
            if (main) {
                main.prepend(alertContainer);
                setTimeout(() => {
                    bootstrap.Alert.getOrCreateInstance(alertContainer).close();
                }, 4000);
            }
        }

        function submitDieselForm(event) {
            event.preventDefault();
            const form = event.target;
            const submitButton = form.querySelector('button[type="submit"]');
            if (!submitButton) return;

            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            const formData = new FormData(form);
            const url = form.action;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]')?.value,
                },
                body: formData,
            })
            .then(async response => {
                submitButton.disabled = false;
                submitButton.textContent = 'Submit Entry';

                if (!response.ok) {
                    const data = await response.json().catch(() => ({}));
                    const message = data.message || 'Could not save diesel entry.';
                    showAlert(message, 'danger');
                    return;
                }

                return response.json();
            })
            .then(data => {
                if (!data) return;
                if (data.success) {
                    const tbody = document.querySelector('table tbody');
                    if (tbody) {
                        const row = document.createElement('tbody');
                        row.innerHTML = data.html;
                        const newRow = row.querySelector('tr');
                        if (newRow) {
                            tbody.prepend(newRow);
                            tbody.querySelectorAll('tr').forEach((tr, index) => {
                                const cell = tr.querySelector('td');
                                if (cell) {
                                    cell.textContent = index + 1;
                                }
                            });
                        }
                    }
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addDieselModal'));
                    if (modal) {
                        modal.hide();
                    }
                    form.reset();
                    calculateTotal('.add-liters', 'total_stock_add');
                    showAlert('Diesel entry created successfully.');
                }
            })
            .catch(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'Submit Entry';
                showAlert('Network error while saving diesel entry.', 'danger');
            });
        }

        // Auto-fill password from login
        const adminPassword = localStorage.getItem('adminPassword');
        const passwordInput = document.getElementById('admin_password');
        if (adminPassword && passwordInput) {
            passwordInput.value = adminPassword;
        }

        // Add Modal listener
        const addInputs = document.querySelectorAll('.add-liters');
        addInputs.forEach(input => {
            input.addEventListener('input', function() {
                calculateTotal('.add-liters', 'total_stock_add');
            });
        });

        const addDieselForm = document.querySelector('#addDieselModal form');
        if (addDieselForm) {
            addDieselForm.addEventListener('submit', submitDieselForm);
        }

        // Show modal and ensure password is set
        const addDieselModal = document.getElementById('addDieselModal');
        if (addDieselModal) {
            addDieselModal.addEventListener('show.bs.modal', function() {
                const adminPassword = localStorage.getItem('adminPassword');
                const passwordInput = document.getElementById('admin_password');
                if (adminPassword && passwordInput) {
                    passwordInput.value = adminPassword;
                }
            });
        }
    });
</script>
</body>
</html>
