<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/css/bootstrap.min.css')}}">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/css/style.css')}}">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <title>Admin Panel</title>

</head>




<body class="bg-light">
    <!-- =======Header====== -->
    @include('components.header')
    <div class="app-body d-flex h-100">

        <!-- =======sideBar====== -->
        @include('components.sideBar')

        <main class="main flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-0 bg-white border-bottom m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" class="-block dark text-white p-2" aria-current="page">Open date :: 08 february 2025</li>
                </ol>
            </nav>
            <div class="content p-3">

                <!-- =======dashBoardPanel====== -->
                @include('components.dashBoardPanel')


                <!-- Table Section -->
                <div class="table-responsive table-responsive-sm" style="margin-top: 10px;">
                    <table id="dataTable" class="table table-sm table-hover border">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Item Name</th>
                                <th>Model Number</th>
                                <th>Serial Number</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Sold Price</th>
                                <th>Office</th>
                                <th>Employee</th>
                                <th>Customer Tin</th>
                                <th>Created At</th>
                                <th>Sold Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="align-middle text-center">1</th>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">XPOS200</td>
                                <td class="align-middle">XP20087456321</td>
                                <td class="align-middle" style="color: red;">Maintenance</td>
                                <td class="align-middle">600,000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">DSM</td>
                                <td class="align-middle">mucha</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-08-15</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">2</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">TPR450</td>
                                <td class="align-middle">TPR45099874563</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">180,000</td>
                                <td class="align-middle">160,000</td>
                                <td class="align-middle">Arusha</td>
                                <td class="align-middle">mwinyi</td>
                                <td class="align-middle">874596321</td>
                                <td class="align-middle">2023-09-20</td>
                                <td class="align-middle">2024-02-10</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">3</th>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">SPOS500</td>
                                <td class="align-middle">SP50012547896</td>
                                <td class="align-middle" style="color: blue;">In Transit</td>
                                <td class="align-middle">720,000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">Mwanza</td>
                                <td class="align-middle">mbida</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-06-25</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">4</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">LX800</td>
                                <td class="align-middle">LX80087456987</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">200,000</td>
                                <td class="align-middle">175,000</td>
                                <td class="align-middle">Dodoma</td>
                                <td class="align-middle">Manson</td>
                                <td class="align-middle">985647321</td>
                                <td class="align-middle">2023-10-05</td>
                                <td class="align-middle">2024-03-12</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">5</th>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">P2000</td>
                                <td class="align-middle">P200032145698</td>
                                <td class="align-middle" style="color: red;">Damaged</td>
                                <td class="align-middle">500,000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">Mbeya</td>
                                <td class="align-middle">mwinyi</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-05-18</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">6</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">TR600</td>
                                <td class="align-middle">TR60045632187</td>
                                <td class="align-middle" style="color: orange;"> Delivery</td>
                                <td class="align-middle">190,000</td>
                                <td class="align-middle">170,000</td>
                                <td class="align-middle">Tanga</td>
                                <td class="align-middle">mwinyi</td>
                                <td class="align-middle">748596321</td>
                                <td class="align-middle">2023-11-11</td>
                                <td class="align-middle">2024-04-20</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">7</th>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">XTRA900</td>
                                <td class="align-middle">X90078541236</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">650,000</td>
                                <td class="align-middle">600,000</td>
                                <td class="align-middle">Zanzibar</td>
                                <td class="align-middle">france</td>
                                <td class="align-middle">789654123</td>
                                <td class="align-middle">2023-12-01</td>
                                <td class="align-middle">2024-06-05</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">8</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">THX550</td>
                                <td class="align-middle">THX55098745612</td>
                                <td class="align-middle" style="color: blue;"> Pickup</td>
                                <td class="align-middle">210,000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">Kigoma</td>
                                <td class="align-middle">james</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-07-22</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">9</th>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">QPOS300</td>
                                <td class="align-middle">QPOS30015975364</td>
                                <td class="align-middle" style="color: red;">Under Repair</td>
                                <td class="align-middle">580,000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">Shinyanga</td>
                                <td class="align-middle">kaligo</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-04-12</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">10</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">TXP700</td>
                                <td class="align-middle">TXP70075321469</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">220,000</td>
                                <td class="align-middle">200,000</td>
                                <td class="align-middle">Morogoro</td>
                                <td class="align-middle">salome</td>
                                <td class="align-middle">852369741</td>
                                <td class="align-middle">2023-03-05</td>
                                <td class="align-middle">2024-05-10</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">11</th>
                                <td class="align-middle">Printer</td>
                                <td class="align-middle">TXP700</td>
                                <td class="align-middle">TXP70075321469</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">220,000</td>
                                <td class="align-middle">200,000</td>
                                <td class="align-middle">Morogoro</td>
                                <td class="align-middle">salome</td>
                                <td class="align-middle">852369741</td>
                                <td class="align-middle">2023-03-05</td>
                                <td class="align-middle">2024-05-10</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
        </main>
        @include('components.sideManue')
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <!-- jQuery (Optional if already included via CDN) -->




    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/js/bootstrap.min.js') }}"></script>

    <script>
        $(function() {
            $("#toggle-sidebar").on("click", function() {
                $(".sidebar").toggleClass("open");
            });

            $("#toggle-aside-menu").on("click", function() {
                $(".aside-menu").toggleClass("open");
            });
        });
    </script>

    <script>
        // Function to check for expired token and redirect to login page
        function checkTokenExpiration() {
            let token = localStorage.getItem('jwt_token'); // Retrieve JWT token from localStorage
            console.log("Token found: ", token); // Debugging log

            if (!token) {
                console.log("Token not found, redirecting to login..."); // Debugging log
                window.location.href = "/login"; // If no token is present, redirect to login page
                return;
            }

            // Make an API call to check if token is valid
            fetch('/api/user', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    }
                })
                .then(response => {
                    console.log("API Response Status: ", response.status); // Debugging log
                    if (response.status === 401) {
                        // If token has expired or is invalid, redirect to login
                        console.log("Token expired or invalid, redirecting to login..."); // Debugging log
                        localStorage.removeItem('jwt_token'); // Remove expired token from localStorage
                        window.location.href = '/login'; // Redirect to login page
                    } else if (response.status === 200) {
                        console.log("Token is valid, user data:", response); // Debugging log
                    } else {
                        console.log("Unexpected status:", response.status); // Debugging log
                    }
                    return response.json(); // Handle other responses here (for valid token)
                })
                .catch(error => {
                    console.error('Error:', error); // Handle error if the fetch fails
                    window.location.href = '/login'; // In case of any error, redirect to login page
                });
        }


        // Call the function to check token expiration on page load
        checkTokenExpiration();

        // Optional: Set a timeout to periodically check token status if necessary
        setInterval(checkTokenExpiration, 60000); // Check token expiration every 60 seconds
    </script>

    <!-- ===============================logout ============================================= -->
    <script>
        // Function to check token and get user info
        function checkTokenAndLogout() {
            const token = localStorage.getItem('jwt_token'); // Retrieve JWT token from localStorage
            console.log("Token found: ", token); // Debugging log

            if (!token) {
                console.log("Token not found, redirecting to login..."); // If no token is present, redirect to login page
                window.location.href = "/login"; // Redirect to login page
                return;
            }

            // Make an API call to check if the token is valid
            fetch('/api/user', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (response.status === 200) {
                        console.log("Token is valid, proceeding to logout..."); // Token is valid
                        logout(token); // Call logout function with token
                    } else if (response.status === 401) {
                        console.log("Token expired or invalid, redirecting to login..."); // Token is invalid
                        localStorage.removeItem('jwt_token'); // Remove invalid token
                        window.location.href = "/login"; // Redirect to login
                    } else {
                        console.log("Unexpected response status:", response.status); // Handle unexpected response
                        window.location.href = "/login"; // Redirect to login on any error
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error checking token:', error); // Handle error
                    window.location.href = '/login'; // Redirect to login in case of error
                });
        }

        // Function to log out the user
        function logout(token) {
            // Set the request headers with the token
            const headers = {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
            };

            // Make the logout request
            fetch('http://127.0.0.1:8000/api/logout', {
                    method: 'POST',
                    headers: headers,
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Logged out successfully');
                        localStorage.removeItem('jwt_token'); // Remove token from localStorage
                        window.location.href = '/login'; // Redirect to the login page
                    } else {
                        console.error('Logout failed:', response.statusText); // Handle failed logout
                    }
                })
                .catch(error => {
                    console.error('An error occurred during logout:', error); // Handle logout errors
                });
        }

        // Attach the checkTokenAndLogout function to the logout button
        document.querySelector('.logout-button').addEventListener('click', checkTokenAndLogout);
    </script>



    -----------------------------------------------


    <!-- ==================================================end logout ============================================== -->

    ====================

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search bar
                ordering: false, // Enable column sorting
                responsive: true // Enable responsive mode
            });
        });
    </script>

</body>

</html>