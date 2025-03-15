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

        <!-- Add New Stock Modal -->

        <!-- Add New Stock Modal -->
        <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addStockModalLabel">Add New Stock</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addStockForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="item_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Model Number</label>
                                    <input type="text" class="form-control" name="model_number" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Serial Number</label>
                                    <input type="text" class="form-control" name="serial_number" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="in_office">In Office</option>
                                        <option value="sold">Sold</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Office ID</label>
                                    <input type="number" class="form-control" name="office_id" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Employee ID</label>
                                    <input type="number" class="form-control" name="employee_id" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Price</label>
                                    <input type="number" step="0.01" class="form-control" name="price" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Batch ID (Optional)</label>
                                    <input type="text" class="form-control" name="batch_id">
                                </div>
                            </div>
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



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

                <!-- =======dashBoardPanel====== -->
                @include('components.dashBoardPanel')

                <div>

                    <!-- Add Device Button & Table -->
                    <div class="d-flex justify-content-between mb-2" style="margin-top: 20px;">
                        <button id="addDeviceBtn" class="btn btn-info text-white">
                            ➕ Add New Device
                        </button>
                    </div>


                    <div class="table-container">
                        <table id="dataTable" class="table table-sm table-hover border">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Item Name</th>
                                    <th>Model</th>
                                    <th>Serial</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Sold Price</th>
                                    <th>Office</th>
                                    <th>Sales_officer</th>
                                    <th>Customer Tin</th>
                                    <th>Sold Date</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data will be inserted here dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Device Modal -->
                    <div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDeviceModalLabel">Add New Device</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addDeviceForm">
                                        <div class="mb-3">
                                            <label for="item_name" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="item_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="model_number" class="form-label">Model Number</label>
                                            <input type="text" class="form-control" id="model_number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="serial_number" class="form-label">Serial Number</label>
                                            <input type="text" class="form-control" id="serial_number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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


    <!-- ================== Add new stock modal ============================ -->
    <script>
        $(document).ready(function() {
            $("#openAddStockModal").click(function(e) {
                e.preventDefault();
                $("#addStockModal").modal("show");
            });
        });
    </script>
    <!-- ========================end modal ======================= -->

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


    <!-- ==================================================end logout ============================================== -->

    <!-- =====================================================get stock devices =================== -->

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            fetchDevices(); // Initial call

            // Polling: Fetch data every 5 seconds
            setInterval(fetchDevices, 5000);

            function fetchDevices() {
                let token = localStorage.getItem('jwt_token'); // Retrieve JWT token

                if (!token) {
                    console.log("No token found, redirecting to login...");
                    window.location.href = "/login";
                    return;
                }

                $.ajax({
                    url: "http://127.0.0.1:8000/api/devices",
                    type: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json",
                    },
                    success: function(response) {
                        let devices = response.devices;
                        let tableBody = $("#tableBody");
                        tableBody.empty(); // Clear existing rows

                        $.each(devices, function(index, device) {
                            let statusColor = getStatusColor(device.status);

                            let row = `<tr>
                        <td class="align-middle">${device.id}</td>
                        <td class="align-middle">${device.item_name}</td>
                        <td class="align-middle">${device.model_number}</td>
                        <td class="align-middle">${device.serial_number}</td>
                        <td class="align-middle" style="color: ${statusColor};">${device.status}</td>
                        <td class="align-middle">${device.price || '-'}</td>
                        <td class="align-middle">${device.sold_price || '-'}</td>
                        <td class="align-middle">${device.office_name}</td>
                        <td class="align-middle">${device.employee_name}</td>
                        <td class="align-middle">${device.customer_tin || '-'}</td>
                        <td class="align-middle">${formatDate(device.sold_date)}</td>
                    </tr>`;

                            tableBody.append(row);
                        });

                        // Initialize or update DataTable without sorting (removes sort arrows)
                        if (!$.fn.DataTable.isDataTable("#dataTable")) {
                            $("#dataTable").DataTable({
                                paging: true,
                                searching: true,
                                ordering: false, // Disables sorting globally (removes arrows)
                                info: true,
                                stateSave: true, // ✅ Preserve pagination, search, and ordering
                            });

                            // Move the "Add Device" button before the search box
                            $(".dataTables_filter").before($("#addDeviceBtn"));
                        } else {
                            let dataTable = $("#dataTable").DataTable();
                            let currentPage = dataTable.page(); // ✅ Store current page
                            dataTable.clear();
                            dataTable.rows.add($("#tableBody tr"));
                            dataTable.draw(false); // ✅ Redraw table without changing page
                            dataTable.page(currentPage).draw("page"); // ✅ Restore page position
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching devices:", xhr.responseText);

                        if (xhr.status === 401) {
                            console.log("Token expired or invalid, redirecting to login...");
                            localStorage.removeItem('jwt_token');
                            window.location.href = '/login';
                        }
                    }
                });
            }

            function getStatusColor(status) {
                switch (status.toLowerCase()) {
                    case "sold":
                        return "green";
                    case "maintenance":
                        return "red";
                    case "in_office":
                        return "blue";
                    case "delivery":
                        return "orange";
                    case "damaged":
                        return "red";
                    case "under repair":
                        return "red";
                    default:
                        return "black";
                }
            }

            function formatDate(isoDate) {
                if (!isoDate) return '-'; // Handle empty/null dates

                let date = new Date(isoDate);
                let day = String(date.getDate()).padStart(2, '0');
                let month = String(date.getMonth() + 1).padStart(2, '0');
                let year = date.getFullYear();

                return `${day}-${month}-${year}`;
            }

            // Open modal when clicking Add Device button
            $("#addDeviceBtn").click(function() {
                $("#addDeviceModal").modal("show");
            });

            // Handle Add Device Form Submission
            $("#addDeviceForm").submit(function(e) {
                e.preventDefault();

                let token = localStorage.getItem("jwt_token");
                if (!token) {
                    alert("Unauthorized! Please log in.");
                    return;
                }

                let newDevice = {
                    item_name: $("#item_name").val(),
                    model_number: $("#model_number").val(),
                    serial_number: $("#serial_number").val(),
                    price: $("#price").val(),
                };

                $.ajax({
                    url: "http://127.0.0.1:8000/api/devices",
                    type: "POST",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json",
                    },
                    data: JSON.stringify(newDevice),
                    success: function(response) {
                        alert("Device added successfully!");
                        $("#addDeviceModal").modal("hide");
                        fetchDevices(); // Refresh table
                    },
                    error: function(xhr) {
                        alert("Error adding device: " + xhr.responseText);
                    }
                });
            });
        });
    </script>

    <!-- ===================================================== end get stock devices =================== -->


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


    <!-- ========================dashbord stats================== -->

    <!-- JavaScript to Fetch API and Update Dashboard -->
    <script>
        async function fetchDashboardStats() {
            try {
                let token = localStorage.getItem('jwt_token'); // Retrieve JWT token

                if (!token) {
                    console.log("Token not found, redirecting to login...");
                    window.location.href = "/login"; // Redirect if token is missing
                    return;
                }

                const response = await fetch("http://127.0.0.1:8000/api/dashboard/stats", {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json"
                    }
                });

                if (!response.ok) {
                    if (response.status === 401) {
                        console.log("Token expired or invalid, redirecting to login...");
                        localStorage.removeItem('jwt_token'); // Remove expired token
                        window.location.href = "/login"; // Redirect to login
                        return;
                    }
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                // Update Dashboard Stats
                document.getElementById("total-devices").textContent = data.total_devices;
                document.getElementById("total-sold-devices").textContent = data.sold_devices;
                document.getElementById("pos-received").textContent = data.pos_received;
                document.getElementById("thermal-received").textContent = data.thermal_printer_received;
                document.getElementById("pos-sold").textContent = data.pos_sold;
                document.getElementById("thermal-sold").textContent = data.thermal_printer_sold;
                document.getElementById("pos-remaining").textContent = data.pos_remaining;
                document.getElementById("thermal-remaining").textContent = data.thermal_printer_remaining;
            } catch (error) {
                console.error("Error fetching dashboard stats:", error);
            }
        }

        // Fetch data on page load
        fetchDashboardStats();

        // Refresh data every 10 seconds
        setInterval(fetchDashboardStats, 10000);
    </script>

    <!-- ========================end dashbord stats ============================== -->


    <!-- ==========================upload excel ============================ -->

    


</body>

</html>