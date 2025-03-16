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

                <!-- =======dashBoardPanel====== -->
                @include('components.addNewStock')

                <div>

                    <div class="table-container">
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
                                    <th>Sales_officer</th>
                                    <th>Customer Tin</th>
                                    <th>Sold Date</th>
                                    <th>Batch</th>
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
        <!-- @include('components.sideManue') -->
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

    <!-- ===========================upload excel ======================================= -->

    <script>
        // ✅ Function to get the auth token correctly
        function getAuthToken() {
            let token = localStorage.getItem("jwt_token"); // ✅ Use the correct key
            console.log("Retrieved Auth Token:", token); // ✅ Debug: Print token
            return token;
        }

        document.getElementById("importExcelBtn").addEventListener("click", function() {
            let formData = new FormData();
            let fileInput = document.getElementById("excelFile");
            let authToken = getAuthToken(); // ✅ Get auth token

            // ✅ Debugging: Ensure the token is present before making the request
            if (!authToken) {
                console.error("Auth token is missing! Redirecting to login.");
                showMessage("Authentication error: Please log in again.", "danger");
                return;
            }

            if (!fileInput.files.length) {
                showMessage("Please select an Excel file to upload!", "danger");
                console.error("No file selected!");
                return;
            }

            formData.append("excel_file", fileInput.files[0]); // ✅ Only sending "excel_file"

            // ✅ Debug: Print FormData contents
            for (let pair of formData.entries()) {
                console.log("FormData Entry:", pair[0], pair[1]);
            }

            fetch("http://127.0.0.1:8000/api/import-excel", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Authorization": `Bearer ${authToken}`, // ✅ Corrected header
                        "Accept": "application/json"
                    }
                })
                .then(async response => {
                    console.log("Response Status:", response.status);
                    console.log("Response Headers:", response.headers);

                    let responseBody;
                    try {
                        responseBody = await response.json();
                    } catch (error) {
                        console.error("Failed to parse JSON response:", error);
                        throw new Error(`HTTP error! Status: ${response.status}. Response is not JSON.`);
                    }

                    console.log("Full Response Body:", responseBody); // ✅ Debug: Print response body

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}. Message: ${responseBody.message || "Unknown error"}`);
                    }

                    return responseBody;
                })
                .then(data => {
                    if (data.success) {
                        showMessage("Excel file imported successfully!", "success");
                    } else {
                        showMessage("Failed to import Excel: " + (data.message || "Unknown error"), "danger");
                    }
                })
                .catch(error => {
                    showMessage("Error uploading file: " + error.message, "danger");
                    console.error("Upload error:", error);
                });
        });

        // ✅ Function to show success/error messages
        function showMessage(message, type) {
            let messageDiv = document.getElementById("message");
            messageDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        }
    </script>

    <!-- =================================end upload exel ================================================ -->

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
                        <td class="align-middle">${device.batch_id}</td>
                    </tr>`;

                            tableBody.append(row);
                        });

                        // Initialize or update DataTable without sorting (removes sort arrows)
                        if (!$.fn.DataTable.isDataTable("#dataTable")) {
                            $("#dataTable").DataTable({
                                paging: true,
                                searching: true,
                                ordering: true, // Enable ordering
                                order: [
                                    [0, "desc"]
                                ], // Order by first column (id) in descending order
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
                            dataTable.order([0, "desc"]).draw(false); // ✅ Maintain descending order
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