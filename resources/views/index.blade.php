<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Radius - Signin/Signup</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
    <div class="container" id="container">
   

        <!-- Sign In Container -->
        <div class="form-container sign-in-container">
            <form id="login-form">
                <h1>Sign in</h1>
                <div class="social-container">
                </div>

                <input type="email" id="email" name="email" placeholder="Email" required />
                <input type="password" id="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="button" id="signInBtn">Sign In</button>
            </form>
        </div>

        <!-- Overlay for toggling between sign in / sign up -->
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

    <!-- jQuery & AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/JS/main.js"></script>
    <script>
        // When the 'Sign In' button is clicked
        document.getElementById('signInBtn').addEventListener('click', function() {
            // Redirect to the dashboard route
            window.location.href = "{{ route('dashboard') }}";
        });
    </script>

</body>

</html>
