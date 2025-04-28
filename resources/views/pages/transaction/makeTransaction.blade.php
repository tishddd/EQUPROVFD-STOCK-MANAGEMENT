<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/css/bootstrap.min.css')}}">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/css/style.css')}}">

    <!-- Bootstrap CSS (if not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                <h4 class="text-center ">Transactions</h3>
            </nav>
            <div class="content p-3">

                <div>

                    <div class="container">
                        <!-- Transactions Form -->
                        <div class="container my-2">
                            <!-- Compact Transactions Form -->
                            <div class="card shadow-sm border-0 rounded-3 p-3 bg-light">
                                <h5 class="mb-3 text-primary d-flex align-items-center">
                                    <i class="bi bi-clipboard2-data fs-4 me-2"></i>Stock Transaction
                                </h5>
                                <form id="transferForm">
                                    <div class="row g-2">
                                        <!-- First Row - Device and Region -->
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-phone text-muted"></i></span>
                                                <select class="form-select form-select-sm" id="device_id" required>
                                                    <option selected disabled>Device</option>
                                                    <!-- Options here -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                                                <select class="form-select form-select-sm" id="region_id" required>
                                                    <option selected disabled>Region</option>
                                                    <!-- Options here -->
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Second Row - TIN and Status -->
                                        <!-- Add this field to your form -->
                                        <div class="col-md-4">
                                            <label for="soldPrice" class="form-label fw-semibold text-secondary">Sale Price</label>
                                            <input type="number" step="0.01" class="form-control" id="soldPrice" placeholder="0.00">
                                        </div>

                                        <div class="col-md-8">
                                            <div class="input-group input-group-sm mt-1">
                                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-credit-card text-muted"></i></span>
                                                <input type="text" class="form-control form-control-sm" id="tin" placeholder="Tax Identification Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mt-1">
                                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-info-circle text-muted"></i></span>
                                                <select class="form-select form-select-sm" id="status">
                                                    <option selected disabled>Status</option>
                                                    <option value="Office">in_office</option>
                                                    <option value="Sold">sold</option>
                                                    <option value="Sold">damaged</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Conditional Date Field (appears only when Sold is selected) -->
                                        <div class="col-md-4" id="dateSoldContainer" style="display: none;">
                                            <div class="input-group input-group-sm mt-1">
                                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar text-muted"></i></span>
                                                <input type="date" class="form-control form-control-sm" id="dateSold">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-1 px-3 py-2">
                                            <i class="bi bi-save me-1"></i>Process Transaction
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Enhanced Devices Table -->
                        <div class="card border-0 rounded-3 overflow-hidden shadow-sm mb-4">
                            <!-- Card Header with Search -->
                            <div class="card-header bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-semibold text-primary">
                                            <i class="bi bi-devices me-2"></i>Device Inventory
                                        </h5>
                                        <!-- <small class="text-muted">Real-time list of all registered devices</small> -->
                                    </div>
                                    <div class="d-flex">
                                        <div class="input-group input-group-sm ms-2" style="width: 200px;">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-search text-muted"></i>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Container -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" id="devicesTable" style="width:100%">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4 text-uppercase small fw-semibold text-secondary">ID</th>
                                                <th class="text-uppercase small fw-semibold text-secondary">Item Name</th>
                                                <th class="text-uppercase small fw-semibold text-secondary">Model</th>
                                                <th class="text-uppercase small fw-semibold text-secondary">Serial</th>
                                                <th class="text-uppercase small fw-semibold text-secondary">Office</th>
                                            </tr>
                                        </thead>
                                        <tbody id="deviceTable" class="border-top-0"></tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Card Footer with Info -->
                            <div class="card-footer bg-white border-0 py-2 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        <span id="deviceTableInfo">Loading devices...</span>
                                    </div>
                                    <div class="d-flex">
                                        <button id="refreshDevices" class="btn btn-sm btn-outline-secondary me-2">
                                            <i class="bi bi-arrow-clockwise"></i> Refresh
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown">
                                                <i class="bi bi-download"></i> Export
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#" id="exportCSV"><i class="bi bi-filetype-csv me-2"></i>CSV</a></li>
                                                <li><a class="dropdown-item" href="#" id="exportExcel"><i class="bi bi-filetype-xlsx me-2"></i>Excel</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            /* Custom DataTables styling */
                            #devicesTable {
                                --bs-table-bg: transparent;
                                --bs-table-striped-bg: #f9fafb;
                                --bs-table-hover-bg: #f8f9fa;
                            }

                            #devicesTable thead th {
                                border-bottom: 2px solid #f0f0f0 !important;
                                border-top: 0;
                                padding-top: 12px;
                                padding-bottom: 12px;
                            }

                            #devicesTable tbody tr {
                                transition: all 0.2s ease;
                            }

                            #devicesTable tbody tr:hover {
                                background-color: var(--bs-table-hover-bg);
                            }

                            #devicesTable tbody td {
                                padding-top: 12px;
                                padding-bottom: 12px;
                                vertical-align: middle;
                            }

                            /* Custom scrollbar for table */
                            .table-responsive::-webkit-scrollbar {
                                height: 6px;
                            }

                            .table-responsive::-webkit-scrollbar-track {
                                background: #f1f1f1;
                            }

                            .table-responsive::-webkit-scrollbar-thumb {
                                background: #c1c1c1;
                                border-radius: 10px;
                            }
                        </style>

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
        // Show/hide date sold field based on status selection
        document.getElementById('status').addEventListener('change', function() {
            const dateContainer = document.getElementById('dateSoldContainer');
            dateContainer.style.display = this.value === 'Sold' ? 'block' : 'none';
        });
    </script>




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

    <script>
        $(document).ready(function() {
            // Retrieve JWT token from localStorage
            let token = localStorage.getItem('jwt_token');

            // Function to check for expired token and redirect to login page
            function checkTokenExpiration() {
                if (!token) {
                    console.log("Token not found, redirecting to login...");
                    window.location.href = "/login";
                    return;
                }

                // Validate token with an API call
                fetch('/api/user', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        }
                    })
                    .then(response => {
                        if (response.status === 401) {
                            console.log("Token expired or invalid, redirecting to login...");
                            localStorage.removeItem('jwt_token');
                            window.location.href = '/login';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        window.location.href = '/login';
                    });
            }

            checkTokenExpiration();

            // Fetch devices
            function loadDevices() {
                $.ajax({
                    url: '/api/devices',
                    type: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    success: function(data) {
                        // Clear dropdown and table body
                        $('#device_id').empty();
                        $('#deviceTable').empty();

                        let tableData = [];

                        data.devices.forEach(device => {
                            // Populate the dropdown
                            $('#device_id').append(`<option value="${device.id}">${device.item_name} - ${device.serial_number}</option>`);

                            // Store data for DataTable
                            tableData.push([
                                device.id,
                                device.item_name,
                                device.model_number,
                                device.serial_number,
                                device.office_name
                            ]);
                        });

                        // Destroy previous instance if DataTable is already initialized
                        if ($.fn.DataTable.isDataTable('#devicesTable')) {
                            $('#devicesTable').DataTable().destroy();
                        }

                        // Populate table using DataTables
                        $('#devicesTable').DataTable({
                            data: tableData,
                            columns: [{
                                    title: "ID"
                                },
                                {
                                    title: "Item Name"
                                },
                                {
                                    title: "Model"
                                },
                                {
                                    title: "Serial"
                                },
                                {
                                    title: "Office"
                                }
                            ],
                            responsive: true,
                            paging: true,
                            searching: true,
                            ordering: true
                        });
                    },
                    error: function() {
                        alert('Failed to fetch devices. Please try again.');
                    }
                });
            }


            function loadRegions() {
                $.ajax({
                    url: '/api/officies', // Ensure this matches your route
                    type: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    success: function(data) {
                        console.log("Regions API Response:", data); // Debugging output

                        $('#region_id').empty(); // Clear previous options

                        // Fix: Access the correct key (data.officies, not data.offices)
                        if (data && Array.isArray(data.officies)) {
                            data.officies.forEach(region => {
                                console.log(`Adding region: ID=${region.id}, Name=${region.name}`);
                                $('#region_id').append(`<option value="${region.id}">${region.name} - ${region.region}</option>`);
                            });
                        } else {
                            console.error("Invalid API response format:", data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching regions:", status, error);
                        console.error("Response Text:", xhr.responseText);
                        alert('Failed to fetch regions. Please try again.');
                    }
                });
            }


            loadDevices();
            loadRegions();

            // Handle form submission
            // Handle form submission

            $(document).ready(function() {
                $('#transferForm').submit(function(e) {
                    e.preventDefault();

                    // Get selected values
                    const device_id = $('#device_id').val();
                    const serial_number = $('#device_id option:selected').text().split(' - ')[1];
                    const customer_tin = $('#tin').val();
                    const status = 'sold'; // Hardcode since you're marking as sold
                    const sold_date = $('#dateSold').val();
                    const sold_price = $('#soldPrice').val(); // You'll need to add this field

                    // Prepare payload according to your DB schema
                    const requestData = {
                        status: status,
                        customer_tin: customer_tin,
                        sold_date: sold_date,
                        sold_price: parseFloat(sold_price) || null, // Convert to number or null
                        // Include device_id for reference
                        device_id: device_id
                    };

                    // Debug logging
                    console.group('Form Submission Data');
                    console.log('Serial Number:', serial_number);
                    console.log('Request Payload:', requestData);
                    console.groupEnd();

                    // Disable button during submission
                    const submitButton = $(this).find('button[type="submit"]');
                    submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...');

                    // Construct endpoint
                    const endpoint = `/api/devices/${encodeURIComponent(serial_number)}`;

                    $.ajax({
                        url: endpoint,
                        type: 'PUT',
                        contentType: 'application/json',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        },
                        data: JSON.stringify(requestData),
                        success: function(response) {
                            console.log('API Success:', response);
                            showNotification('Device marked as sold successfully!', 'success');

                            // Reload data
                            loadDevices();

                            // Reset form
                            $('#transferForm')[0].reset();
                        },
                        error: function(xhr) {
                            console.error('API Error:', xhr.responseJSON);
                            let errorMsg = 'Update failed. Please try again.';

                            if (xhr.responseJSON && xhr.responseJSON.messages) {
                                // Format validation errors
                                errorMsg = Object.values(xhr.responseJSON.messages)
                                    .flat()
                                    .join(', ');
                            }

                            showNotification(errorMsg, 'error');
                        },
                        complete: function() {
                            submitButton.prop('disabled', false).html('<i class="bi bi-send me-2"></i>Mark as Sold');
                        }
                    });
                });
            });

            // Notification function (ensure this exists)
            function showNotification(message, type = 'success') {
                // Your notification implementation
                const toast = `<div class="toast show align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 position-fixed top-3 end-3" role="alert">
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>`;

                $('.toast-container').append(toast);
                setTimeout(() => $('.toast').remove(), 5000);
            }
            // Check token expiration every 60 seconds
            setInterval(checkTokenExpiration, 60000);
        });
    </script>

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
                url: "/api/office-device-counts",
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
                url: "/api/total-device-counts",
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