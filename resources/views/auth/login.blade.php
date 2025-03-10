<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Radius - Signin/Signup</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60o1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
    <div class="container" id="container">

        <!-- Sign In Container -->
        <div class="form-container sign-in-container">
            <form id="login-form">
                <h1>Sign in</h1>
                <input type="email" id="email" name="email" placeholder="Email" required />
                <input type="password" id="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="button" id="signInBtn">Sign In</button>
            </form>
        </div>

        <!-- Overlay -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Stock Management</h1>
                    <a href="#" class="social">
                        <img src="{{ asset('assets/images/EQUPRO-VFD-STOCK.png') }}" alt="logo" class="social-logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Message -->
    <div class="alerts mt-auto" style="display: none;">
        <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
            <h5 class="alert-heading">Login Failed!</h5>
            <p>Invalid email or password. Please try again.</p>
            <button type="button" class="close-alert" aria-label="Close">
                <span>&times;</span>
            </button>
        </div>
    </div>

    <!-- jQuery & AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/JS/main.js"></script>

    <script>
        $(document).ready(function() {
            $('#signInBtn').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission
                $('.alerts').hide(); // Hide previous alerts

                var email = $('#email').val().trim();
                var password = $('#password').val().trim();
                var signInBtn = $('#signInBtn');

                if (!email || !password) {
                    showAlert('Email and password are required.');
                    return;
                }

                signInBtn.prop('disabled', true).text('Signing in...');

                $.ajax({
                    url: 'api/login',
                    type: 'POST',
                    data: {
                        email,
                        password
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.token) {
                            localStorage.setItem('jwt_token', response.token);

                            // 🛑 Prevent back navigation to login page after redirect
                            history.replaceState(null, null, location.href);
                            window.location.replace('/dashboard');
                        }
                    },
                    error: function(xhr) {
                        showAlert(xhr.responseJSON?.error || 'Invalid credentials.');
                    },
                    complete: function() {
                        signInBtn.prop('disabled', false).text('Sign In');
                    }
                });
            });

            // Close Alert
            $(document).on('click', '.close-alert', function() {
                $('.alerts').fadeOut();
            });

            // Show Alert Function
            function showAlert(message) {
                $('.alerts p').text(message);
                $('.alerts').fadeIn();
            }
        });
    </script>

</body>

</html>