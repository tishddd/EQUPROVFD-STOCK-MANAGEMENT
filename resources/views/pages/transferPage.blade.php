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
                <h4 class="text-center ">Transfer Device</h3>
            </nav>
            <div class="content p-3">

                <div>

                    <div class="container">
                        <!-- Transfer Form -->
                        <div class="card p-4 mb-2">
                            <form id="transferForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="device_id" class="form-label">Select Device</label>
                                        <select class="form-select" id="device_id" required></select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="region_id" class="form-label">Select Region</label>
                                        <select class="form-select" id="region_id" required></select>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Transfer Device</button>
                            </form>
                        </div>


                        <!-- Devices Table -->
                        <div class="card p-4">
                            <h4 class="mb-3">Devices List</h4>
                            <table class="table table-bordered" id="devicesTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Model</th>
                                        <th>Serial</th>
                                        <th>Office</th>
                                    </tr>
                                </thead>
                                <tbody id="deviceTable"></tbody>
                            </table>
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
            $(document).ready(function() {
                $('#transferForm').submit(function(e) {
                    e.preventDefault();

                    // Get selected values
                    const device_id = $('#device_id').val();
                    const region_id = $('#region_id').val();
                    const selectedText = $('#device_id option:selected').text(); // Get the text from the selected option

                    // Extract device type from the name (before the first " - ")
                    const device_type = selectedText.split(' - ')[0];

                    // Disable button to prevent multiple submissions
                    const submitButton = $(this).find('button[type="submit"]');
                    submitButton.prop('disabled', true).text('Transferring...');

                    $.ajax({
                        url: 'api/transfer-device',
                        type: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        },
                        data: JSON.stringify({
                            device_id,
                            region_id,
                            device_type
                        }),
                        success: function(response) {
                            alert('Device transferred successfully!');
                            console.log("Transfer Success:", response);

                            // Reload devices to reflect changes
                            loadDevices();

                            // Reset form
                            $('#transferForm')[0].reset();
                        },
                        error: function(xhr, status, error) {
                            console.error("Transfer Failed:", status, error);
                            console.error("Response Text:", xhr.responseText);
                            alert('Transfer failed! Please try again.');
                        },
                        complete: function() {
                            // Re-enable submit button after request completes
                            submitButton.prop('disabled', false).text('Transfer Device');
                        }
                    });
                });
            });


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