
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">

    <style>
        body {
            background-color: #1e1e2e; /* Dark background matching your IDE style */
            color: #ffffff;
        }
        .auth-card {
            background-color: #2b2b3c;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .form-control {
            background-color: #1e1e2e;
            border: 1px solid #444;
            color: #ffffff !important; /* White text when typing */
        }
        /* FIX: Make placeholder text lighter so it is visible */
        .form-control::placeholder {
            color: #a0a0b5 !important;
            opacity: 1; /* Overrides browser defaults */
        }
        .form-control:focus {
            background-color: #252538;
            color: #ffffff;
            border-color: #0d6efd;
            box-shadow: none;
        }
        /* FIX: Brighten up the muted text at the bottom */
        .text-muted {
            color: #b0b0c5 !important;
        }
        /* Styling links */
        .text-info {
            color: #0dcaf0 !important;
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card auth-card p-4">

                <div id="loginForm">
                    <h3 class="text-center mb-4 text-white">Admin Login</h3>
                    <form id="adminLoginForm" onsubmit="handleLogin(event)">
                        <div class="mb-4">
                            <label class="form-label text-white">Password</label>
                            <input type="password" id="passwordInput" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    </form>

                    <div id="errorMessage" class="alert alert-danger d-none text-center" role="alert">
                        Invalid Password!
                    </div>
                </div>
                {{--                    <div class="text-center">--}}
                {{--                        <p class="mb-0 text-muted">Don't have an account?--}}
                {{--                            <a href="#" id="showRegister" class="text-info text-decoration-none">Register</a>--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
            </div>

            {{--                <div id="registerForm" class="d-none">--}}
            {{--                    <h3 class="text-center mb-4 text-white">Create Account</h3>--}}
            {{--                    <form action="#" method="POST">--}}
            {{--                        <div class="mb-3">--}}
            {{--                            <label class="form-label text-white">Full Name</label>--}}
            {{--                            <input type="text" class="form-control" placeholder="John Doe" required>--}}
            {{--                        </div>--}}
            {{--                        <div class="mb-3">--}}
            {{--                            <label class="form-label text-white">Email Address</label>--}}
            {{--                            <input type="email" class="form-control" placeholder="name@example.com" required>--}}
            {{--                        </div>--}}
            {{--                        <div class="mb-3">--}}
            {{--                            <label class="form-label text-white">Mobile No</label>--}}
            {{--                            <input type="tel" class="form-control" placeholder="+1234567890" required>--}}
            {{--                        </div>--}}
            {{--                        <div class="mb-4">--}}
            {{--                            <label class="form-label text-white">Password</label>--}}
            {{--                            <input type="password" class="form-control" placeholder="••••••••" required>--}}
            {{--                        </div>--}}
            {{--                        <button type="submit" class="btn btn-success w-100 mb-3">Register</button>--}}
            {{--                    </form>--}}
            {{--                    <div class="text-center">--}}
            {{--                        <p class="mb-0 text-muted">Already have an account?--}}
            {{--                            <a href="#" id="showLogin" class="text-info text-decoration-none">Sign In</a>--}}
            {{--                        </p>--}}
            {{--                    </div>--}}
        </div>

    </div>
</div>
</div>
</div>

<script>
    const loginForm = document.getElementById('loginForm');
    const validPasswords = ["27368", "26525", "27481", "19442", "27572", "24000", "1974", "26648", "21334", "27742", "26674", "27034", "1269", "22765", "25660", "27402"];

    function handleLogin(event) {
        // Prevent the page from refreshing on form submit
        event.preventDefault();

        // Get values from the input fields
        const password = document.getElementById('passwordInput').value;
        const errorDiv = document.getElementById('errorMessage');

        // Check if password is in the list of valid passwords
        if (validPasswords.includes(password)) {
            errorDiv.classList.add('d-none'); // Hide error if visible
            alert("Login Successful! Redirecting...");

            // Store the password in localStorage for use in diesel form
            localStorage.setItem('adminPassword', password);

            // Redirect to your admin dashboard route
            window.location.href = "{{route('admindashboard')}}";
        } else {
            // Show the error message if credentials don't match
            errorDiv.classList.remove('d-none');
        }
    }
</script>

</body>
</html>
