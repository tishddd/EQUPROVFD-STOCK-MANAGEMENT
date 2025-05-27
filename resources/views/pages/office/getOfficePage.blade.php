<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/css/bootstrap.min.css')}}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (Make sure this is after jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS (if not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/css/style.css')}}">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        #updateModal input,
        #updateModal select {
            color: #000 !important;
            background-color: #fff !important;
        }

        #updateModal label {
            color: #000 !important;
        }
    </style>

    <title>Admin Panel</title>

</head>




<body class="bg-light">
    <!-- =======Header====== -->
    @include('components.header')
    <div class="app-body d-flex h-100">

        <!-- =======sideBar====== -->
        @include('components.sideBar')
        <!-- <========side bar end ======> -->

        <main class="main flex-grow-1 p-3">


            <div class="content m-3">
                <div class="card shadow-lg p-3">
                    <!-- Card Header with Actions -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-users me-2"></i>Office Management</h2>
                        <div>
                            <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#addNewOfficeModal">
                                <i class="fas fa-user-plus me-1"></i> Add New Office
                            </button>
                        </div>
                    </div>

                    <!-- Card Body with Advanced Controls -->
                    <div class="card-body">
                        <!-- User Table -->
                        <div class="table-responsive">
                            <table id="officeTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Region</th>
                                        <th>region_code</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('components.sideManue')
    </div>

    <!-- ======================= Update Office Modal ======================= -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="updateOfficeModalLabel">Update Office</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="updateOfficeForm">
                        <input type="hidden" id="officeId"> <!-- Hidden field for office ID -->

                        <div class="container">
                            <div class="row g-3">
                                <!-- Office Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Office Name</label>
                                    <input type="text" id="officeName" class="form-control shadow-sm border-primary">
                                </div>
                                <!-- Region -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Region</label>
                                    <input type="text" id="officeRegion" class="form-control shadow-sm border-primary">
                                </div>
                                <!-- Region Code -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Region Code</label>
                                    <input type="text" id="officeRegionCode" class="form-control shadow-sm border-primary">
                                </div>
                                <!-- Created At -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Created At</label>
                                    <input type="text" id="officeCreatedAt" class="form-control shadow-sm border-secondary" disabled>
                                </div>
                                <!-- Updated At -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Updated At</label>
                                    <input type="text" id="officeUpdatedAt" class="form-control shadow-sm border-secondary" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveOfficeChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ======================= Add New Office Modal ======================= -->

    <div class="modal fade" id="addNewOfficeModal" tabindex="-1" aria-labelledby="addNewOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNewOfficeModalLabel">Add New Office</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addNewOfficeForm">
                        <div class="container">
                            <div class="row g-3">
                                <!-- Office Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Office Name</label>
                                    <input type="text" id="AddofficeName" class="form-control shadow-sm border-primary" required>
                                </div>
                                <!-- Region -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Region</label>
                                    <input type="text" id="AddofficeRegion" class="form-control shadow-sm border-primary" required>
                                </div>
                                <!-- Region Code -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Region Code</label>
                                    <input type="text" id="AddofficeRegionCode" class="form-control shadow-sm border-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="addNewOffice">Add Office</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Response Messages -->
    <!-- Response Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modalHeader" class="modal-header">
                    <h5 id="modalTitle" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalBody" class="modal-body text-center"></div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Office?</p>
                    <input type="hidden" id="deleteUserId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Response Modal (for success/error messages) -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modalHeader" class="modal-header">
                    <h5 id="modalTitle" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalBody" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Scripts -->

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


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
                url: "api/office-device-counts",
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
                url: "api/total-device-counts",
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
            fetch('api/logout', {
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


    <!-- ===================================================get all offices =================================== -->
    <script>
        $(document).ready(function() {
            // Constants
            const API_BASE_URL = 'http://127.0.0.1:8000/api/officies/';
            const token = localStorage.getItem('jwt_token');

            // Check authentication
            if (!token) {
                console.warn("No token found. Redirecting to login...");
                window.location.href = "/login";
                return;
            }

            // Common headers
            const ajaxHeaders = {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };

            // Initialize DataTable
            const officeTable = $('#officeTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: API_BASE_URL,
                    type: "GET",
                    headers: ajaxHeaders,
                    dataSrc: function(json) {
                        console.log("API Response: ", json);

                        if (!json || !json.officies) {
                            console.error("Invalid API response format - missing 'officies' field");
                            return [];
                        }

                        return json.officies.map(office => ({
                            ...office,
                            created_at: formatDate(office.created_at),
                            updated_at: formatDate(office.updated_at)
                        }));
                    },
                    error: handleAjaxError
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'region'
                    },
                    {
                        data: 'region_code'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },

                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                        <button class="btn btn-sm btn-primary update-btn" data-id="${row.id}">Update</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                    `;
                        },
                        orderable: false
                    }
                ]
            });

            // Helper Functions
            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-GB'); // DD/MM/YYYY format
            }

            function refreshTable() {
                officeTable.ajax.reload(null, false);
            }

            // Modal Management
            function showModal(modalId) {
                $(modalId).modal('show');
            }

            function hideModal(modalId) {
                $(modalId).modal('hide');
            }

            // Handle Update Button Click
            $('#officeTable tbody').on('click', '.update-btn', function() {
                const officeId = $(this).data('id');

                $.ajax({
                    url: API_BASE_URL + officeId,
                    type: "GET",
                    headers: ajaxHeaders,
                    success: function(response) {
                        const office = response.office;
                        if (!office) {
                            showResponseModal('Error', 'Office data not found in response', false);
                            return;
                        }

                        // Populate form fields
                        $('#officeId').val(office.id);
                        $('#officeName').val(office.name || '');
                        $('#officeRegion').val(office.region || '');
                        $('#officeRegionCode').val(office.region_code || '');

                        showModal('#updateModal');
                    },
                    error: handleAjaxError
                });
            });

            // Handle Save Changes
            $('#saveOfficeChanges').on('click', function() {
                const officeId = $('#officeId').val();
                const updatedOffice = {
                    name: $('#officeName').val(),
                    region: $('#officeRegion').val(),
                    region_code: $('#officeRegionCode').val(),
                };

                $.ajax({
                    url: API_BASE_URL + officeId,
                    type: "PUT",
                    headers: ajaxHeaders,
                    data: JSON.stringify(updatedOffice),
                    success: function(response) {
                        hideModal('#updateModal');
                        refreshTable();
                        showResponseModal('Success', 'Office updated successfully', true);
                    },
                    error: handleAjaxError
                });
            });

            // Handle Delete Button Click
            $('#officeTable tbody').on('click', '.delete-btn', function() {
                let officeId = $(this).data('id');
                $('#deleteUserId').val(officeId);
                $('#deleteModal').modal('show');
            });

            // Confirm Delete
            $('#confirmDelete').on('click', function() {
                let officeId = $('#deleteUserId').val();

                $.ajax({
                    url: `http://127.0.0.1:8000/api/officies/${officeId}`,
                    type: "DELETE",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        officeTable.ajax.reload(null, false); // Refresh DataTable
                        showResponseModal('Success', 'Office deleted successfully', true);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });


            // Response Modal
            function showResponseModal(title, message, isSuccess) {
                const modalHeader = $('#modalHeader');
                const modalTitle = $('#modalTitle');
                const modalBody = $('#modalBody');

                modalHeader.css('background-color', isSuccess ? '#28a745' : '#dc3545');
                modalTitle.css('color', '#fff').text(title);
                modalBody.html(message).css('color', '#000');

                $('#responseModal').modal('show');
            }

            // Error Handling
            function handleAjaxError(xhr) {
                console.error("AJAX Error:", xhr.status, xhr.responseText);

                if (xhr.status === 401) {
                    localStorage.removeItem('jwt_token');
                    showResponseModal('Session Expired', 'Please login again', false);
                    setTimeout(() => window.location.href = "/login", 2000);
                    return;
                }

                let errorMsg = 'An error occurred';
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (xhr.status === 422 && response.errors) {
                        errorMsg = Object.values(response.errors).flat().join('<br>');
                    } else {
                        errorMsg = response.message || response.error || errorMsg;
                    }
                } catch (e) {
                    errorMsg = xhr.responseText || errorMsg;
                }

                showResponseModal('Error', errorMsg, false);
            }

            // Add New Office Button Handler
            $('#addNewOffice').on('click', function() {
                // Validate form
                if (!$('#addNewOfficeForm')[0].checkValidity()) {
                    $('#addNewOfficeForm')[0].reportValidity();
                    return;
                }

                // Prepare office data
                const officeData = {
                    name: $('#AddofficeName').val().trim(),
                    region: $('#AddofficeRegion').val().trim(),
                    region_code: $('#AddofficeRegionCode').val().trim()
                };

                // Show loading state
                const addBtn = $(this);
                addBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...');

                // AJAX request to create new office
                $.ajax({
                    url: API_BASE_URL,
                    type: "POST",
                    headers: ajaxHeaders,
                    data: JSON.stringify(officeData),
                    success: function(response) {
                        // Close modal and reset form
                        $('#addNewOfficeModal').modal('hide');
                        $('#addNewOfficeForm')[0].reset();

                        // Refresh DataTable
                        officeTable.ajax.reload(null, false);

                        // Show success message
                        showToast('Success', 'Office added successfully', 'success');
                    },
                    error: function(xhr) {
                        handleAddOfficeError(xhr);
                    },
                    complete: function() {
                        addBtn.prop('disabled', false).text('Add Office');
                    }
                });
            });

            // Error handling for add office
            function handleAddOfficeError(xhr) {
                let errorMsg = 'Failed to add office';

                try {
                    const response = xhr.responseJSON;

                    if (xhr.status === 422 && response.errors) {
                        // Clear previous error highlights
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        // Display validation errors
                        for (const field in response.errors) {
                            const inputId = `office${field.charAt(0).toUpperCase() + field.slice(1)}`;
                            const $input = $(`#${inputId}`);

                            $input.addClass('is-invalid');
                            $input.after(`<div class="invalid-feedback">${response.errors[field][0]}</div>`);
                        }
                        return;
                    }

                    errorMsg = response?.message || response?.error || errorMsg;
                } catch (e) {
                    console.error('Error parsing error response:', e);
                }

                showToast('Error', errorMsg, 'danger');
            }

            // Toast notification function
            function showToast(title, message, type) {
                const toast = $(`
            <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>${title}:</strong> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `);

                $('#toastContainer').append(toast);
                toast.toast({
                    autohide: true,
                    delay: 5000
                }).toast('show');

                // Remove toast after hiding
                toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Clear form validation on modal hide
            $('#addNewOfficeModal').on('hidden.bs.modal', function() {
                $('#addNewOfficeForm')[0].reset();
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

        });
    </script>
    <!-- =================================================end get all Offices ================================================== -->

    <!-- ===================================add user and category ====================================================== -->


    <script>
        // Function to display Bootstrap modal with dynamic content
        function showResponseModal(title, message, isSuccess) {
            var modalHeader = $('#modalHeader');
            var modalTitle = $('#modalTitle');
            var modalBody = $('#modalBody');

            // Set modal background color and title
            if (isSuccess) {
                modalHeader.css('background-color', '#28a745'); // Green for success
                modalTitle.css('color', '#fff').text(title);
                modalBody.html(message).css('color', '#000'); // Changed to .html()
            } else {
                modalHeader.css('background-color', '#dc3545'); // Red for error
                modalTitle.css('color', '#fff').text(title);
                modalBody.html(message).css('color', '#000'); // Changed to .html()
            }

            // Show the modal
            $('#responseModal').modal('show');
        }

        // Function to get the JWT token from localStorage
        function getAuthToken() {
            return localStorage.getItem('jwt_token'); // Retrieve JWT token from localStorage
        }

        // Submit New User Form via AJAx
        $('#addNewUser').click(function() {
            var user_code = $('#newUserCode').val();
            var name = $('#newUserName').val();
            var email = $('#newUserEmail').val();
            var password = $('#password').val();
            var token = getAuthToken();

            if (user_code && name && email && password) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/users/',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user_code: user_code,
                        name: name,
                        email: email,
                        password: password,
                    },
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.message) {
                            showResponseModal('Success', response.message, true);
                            $('#addNewUserModal').modal('hide');
                            $('#addNewUserForm')[0].reset();
                        } else {
                            showResponseModal('Error', 'Unexpected response format', false);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        var errorMsg = 'An error occurred';
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);

                            // Handle validation errors specifically
                            if (xhr.status === 422) {
                                // Check for both 'errors' and 'messages' in response
                                var validationErrors = jsonResponse.errors || jsonResponse.messages;

                                if (validationErrors) {
                                    errorMsg = (jsonResponse.error || 'Validation failed') + ':<br><ul>';
                                    for (var field in validationErrors) {
                                        validationErrors[field].forEach(function(error) {
                                            errorMsg += '<li>' + error + '</li>';
                                        });
                                    }
                                    errorMsg += '</ul>';
                                } else {
                                    errorMsg = jsonResponse.error || jsonResponse.message || 'Validation failed';
                                }
                            } else {
                                errorMsg = jsonResponse.error || jsonResponse.message || errorMsg;
                            }
                        } catch (e) {
                            errorMsg = xhr.responseText || errorMsg;
                        }
                        showResponseModal('Error', errorMsg, false);
                    }
                });
            } else {
                showResponseModal('Warning', 'Please fill in all required fields.', false);
            }
        });

        // Similarly updated category add function
        $('#addNewCategory').click(function() {
            var categoryName = $('#newCategoryName').val();
            var categoryDescription = $('#newCategoryDescription').val();
            var token = localStorage.getItem('jwt_token');

            if (categoryName) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/userCategory',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        name: categoryName,
                        description: categoryDescription
                    },
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    success: function(response) {
                        if (response.message) {
                            showResponseModal('Success', response.message, true);
                            $('#addNewCategoryModal').modal('hide');
                            $('#addNewCategoryForm')[0].reset();
                        } else {
                            showResponseModal('Error', 'Unexpected response format', false);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        var errorMsg = 'An error occurred';
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);

                            // Handle validation errors
                            if (xhr.status === 422) {
                                var validationErrors = jsonResponse.errors || jsonResponse.messages;
                                if (validationErrors) {
                                    errorMsg = '<strong>' + (jsonResponse.error || 'Validation failed') + ':</strong><br><ul>';
                                    for (var field in validationErrors) {
                                        validationErrors[field].forEach(function(error) {
                                            errorMsg += '<li>' + error + '</li>';
                                        });
                                    }
                                    errorMsg += '</ul>';
                                } else {
                                    errorMsg = jsonResponse.error || jsonResponse.message || 'Validation failed';
                                }
                            }
                            // Handle database errors (like duplicate entries)
                            else if (xhr.status === 500 && jsonResponse.message) {
                                // Check for common database errors
                                if (jsonResponse.message.includes('Duplicate entry') && jsonResponse.message.includes('user_code')) {
                                    errorMsg = 'This user code already exists. Please use a different code.';
                                } else if (jsonResponse.message.includes('Duplicate entry') && jsonResponse.message.includes('email')) {
                                    errorMsg = 'This email address is already registered. Please use a different email.';
                                } else if (jsonResponse.message.includes('Integrity constraint violation')) {
                                    errorMsg = 'The data conflicts with existing records. Please check your input.';
                                } else {
                                    // For development - show detailed error
                                    errorMsg = 'Database error: ' + jsonResponse.message;
                                    // For production, use this instead:
                                    // errorMsg = 'A database error occurred. Please try again.';
                                }
                            }
                            // Handle other types of errors
                            else {
                                errorMsg = jsonResponse.error || jsonResponse.message || errorMsg;
                            }
                        } catch (e) {
                            errorMsg = xhr.responseText || errorMsg;
                        }
                        showResponseModal('Error', errorMsg, false);
                    }
                });
            } else {
                showResponseModal('Warning', 'Please fill in the category name.', false);
            }
        });
    </script>

    <!-- 
    <script>
        // Function to get the JWT token from localStorage
        function getAuthToken() {
            return localStorage.getItem('jwt_token'); // Retrieve JWT token from localStorage
        }

        // Submit New User Form via AJAX
        // Submit New User Form via AJAX
        $('#addNewUser').click(function() {
            var user_code = $('#newUserCode').val(); // Get user code value
            var name = $('#newUserName').val(); // Get user name value
            var email = $('#newUserEmail').val(); // Get user email value
            var password = $('#password').val(); // Get user password value
            var token = getAuthToken(); // Get the token from localStorage

            // Check if all required fields are filled
            if (user_code && name && email && password) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/users/', // API endpoint for users
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user_code: user_code, // Send user_code from form input
                        name: name, // Send name from form input
                        email: email, // Send email from form input
                        password: password, // Send password from form input
                    },
                    headers: {
                        'Authorization': `Bearer ${token}`, // Add the token to headers
                    },
                    success: function(response) {
                        console.log(response); // Log the response for debugging

                        // Check for success response
                        if (response.success) {
                            alert('User added successfully!');
                            $('#addNewUserModal').modal('hide');
                            $('#addNewUserForm')[0].reset(); // Reset form after success
                        } else {
                            alert(' ' + (response.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr, status, error) {
                        // Log full error response to inspect
                        console.log(xhr.responseText);
                        alert('An error occurred: ' + xhr.responseText); // Display error message
                    }
                });
            } else {
                alert('Please fill in all required fields.'); // Alert if any required fields are missing
            }
        });


        // Submit New User Category Form via AJAX
        $('#addNewCategory').click(function() {
            var categoryName = $('#newCategoryName').val();
            var categoryDescription = $('#newCategoryDescription').val();
            var token = getAuthToken(); // Get the token from localStorage

            // Check if category name is filled
            if (categoryName) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/userCategory', // API endpoint for user categories
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        name: categoryName,
                        description: categoryDescription,
                    },
                    headers: {
                        'Authorization': `Bearer ${token}`, // Add the token to headers
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Category added successfully!');
                            $('#addNewCategoryModal').modal('hide');
                            $('#addNewCategoryForm')[0].reset(); // Reset form after success
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            } else {
                alert('Please fill in the category name.');
            }
        });
    </script> -->



</body>

</html>