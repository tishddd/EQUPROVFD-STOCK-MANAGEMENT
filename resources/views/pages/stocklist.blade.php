
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
        <!-- <========side bar end ======> -->

        <main class="main flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-0 bg-white border-bottom m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" class="-block dark text-white p-2" aria-current="page">BAT-2025-02-08|001</li>
                </ol>
            </nav>
            <div class="content p-3">

                <div>

                    <h2>Batch List</h2>
                    <table id="batchTable" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Batch ID</th>
                                <th>Batch Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="batchTableBody">
                        </tbody>
                    </table> 




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




















    <!-- ============================== get user auth token ========================================= -->
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
    <!-- =============================================end get auth token ========================== -->


    <!-- ===================================get batches ============================================ -->

    <script>
    $(document).ready(function() {
        fetchBatches();

        function fetchBatches() {
            let token = localStorage.getItem('jwt_token'); // Retrieve token from local storage

            if (!token) {
                console.log("Token not found, redirecting to login...");
                window.location.href = "/login"; // Redirect if token is missing
                return;
            }

            $.ajax({
                url: "http://127.0.0.1:8000/api/batches",
                type: "GET",
                headers: {
                    "Authorization": `Bearer ${token}` // Include JWT token in the request headers
                },
                success: function(response) {
                    let tableBody = "";

                    // Sort batches in descending order by batch_date
                    response.batches.sort((a, b) => new Date(b.batch_date) - new Date(a.batch_date));

                    response.batches.forEach(batch => {
                        tableBody += `<tr>
                            <td>${batch.id}</td>
                            <td>${batch.batch_id}</td>
                            <td>${batch.batch_date}</td>
                            <td>${batch.description || '-'}</td>
                            <td><button onclick="goToStock('${batch.batch_id}')">View Stock</button></td>
                        </tr>`;
                    });

                    $("#batchTableBody").html(tableBody);
                    $("#batchTable").DataTable({
                        "order": [[2, "desc"]] // Ensure DataTable sorts by batch_date in descending order
                    });
                },
                error: function(xhr) {
                    console.error("Error fetching batches:", xhr.responseText);
                    if (xhr.status === 401) {
                        console.log("Unauthorized access, redirecting to login...");
                        localStorage.removeItem('jwt_token'); // Remove invalid token
                        window.location.href = "/login"; // Redirect to login
                    }
                }
            });
        }
    });

    function goToStock(batchId) {
    window.location.href = `/goToStock/${batchId}`;
}

</script>


    <!-- ===================================end get batches =========================================== -->

        <!-- ==========================side menue==================== -->

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

        function fetchStockData() {
            let token = localStorage.getItem('jwt_token');
            if (!token) {
                console.log("No token found, redirecting to login...");
                window.location.href = "/login";
                return;
            }

            $.ajax({
                url: "http://127.0.0.1:8000/api/office-device-counts",
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                success: function(response) {
                    let tableBody = $("#stock-table-body");
                    tableBody.empty(); // Clear existing data

                    response.forEach(function(item) {
                        tableBody.append(`
                        <tr>
                            <td>${item.region}</td>
                            <td>${item.pos_count}</td>
                            <td>${item.printer_count}</td>
                        </tr>
                    `);
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        console.log("Unauthorized request. Redirecting to login...");
                        localStorage.removeItem('jwt_token');
                        window.location.href = "/login";
                    }
                }
            });

            $.ajax({
                url: "http://127.0.0.1:8000/api/total-device-counts",
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                success: function(response) {
                    $("#total-pos").text(response.total_pos);
                    $("#total-printer").text(response.total_printer);
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        console.log("Unauthorized request. Redirecting to login...");
                        localStorage.removeItem('jwt_token');
                        window.location.href = "/login";
                    }
                }
            });
        }

        // Fetch and populate data on page load
        fetchStockData();
    </script>
    <!-- ========================end side manue ============================ -->

</body>

</html>