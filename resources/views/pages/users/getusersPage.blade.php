<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User List</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (Make sure this is after jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS (if not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

</head>

<body class="bg-light">
    <!-- Header & Sidebar -->
    @include('components.header')
    <div class="app-body d-flex h-100">
        @include('components.sideBar')

        <main class="main flex-grow-1 p-3">
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-0 bg-white border-bottom m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                </ol>
            </nav> -->


            <div class="content m-3">
                <div class="card shadow-lg p-3">
                    <!-- Card Header with Actions -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-users me-2"></i>User Management</h2>
                        <div>
                            <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
                                <i class="fas fa-user-plus me-1"></i> Add User
                            </button>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addNewCategoryModal">
                                <i class="fas fa-layer-group me-1"></i> Add Category
                            </button>
                        </div>
                    </div>

                    <!-- Card Body with Advanced Controls -->
                    <div class="card-body">
                        <!-- User Table -->
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>User Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
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
    </div>


    <!-- ======================= Update User Modal ======================= -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="updateUserForm">
                        <input type="hidden" id="userId"> <!-- Hidden field for user ID -->

                        <div class="container">
                            <div class="row g-3">
                                <!-- User Code -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">User Code</label>
                                    <input type="text" id="userCode" class="form-control shadow-sm border-primary">
                                </div>
                                <!-- Name -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" id="userName" class="form-control shadow-sm border-primary">
                                </div>
                                <!-- Email -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" id="userEmail" class="form-control shadow-sm border-primary">
                                </div>


                                <!-- Created At -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Created At</label>
                                    <input type="text" id="createdAt" class="form-control shadow-sm border-secondary" disabled>
                                </div>
                                <!-- Updated At -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Updated At</label>
                                    <input type="text" id="updatedAt" class="form-control shadow-sm border-secondary" disabled>
                                </div>
                                <!-- Status -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Status</label>
                                    <select id="userStatus" class="form-select shadow-sm border-success">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" id="userAddress" class="form-control shadow-sm border-info">
                                </div>
                                <!-- Role -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Role</label>
                                    <select id="userRole" class="form-select shadow-sm border-warning">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="editor">Editor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveUserChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ======================= Add New User Modal ======================= -->
    <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNewUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addNewUserForm">
                        <div class="container">
                            <div class="row g-3">
                                <!-- User Code -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">User Code</label>
                                    <input type="text" id="newUserCode" class="form-control shadow-sm border-primary" required>
                                </div>
                                <!-- Name -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" id="newUserName" class="form-control shadow-sm border-primary" required>
                                </div>
                                <!-- Email -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" id="newUserEmail" class="form-control shadow-sm border-primary" required>
                                </div>


                                <!-- Password -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Password</label>
                                    <input type="email" id="password" class="form-control shadow-sm border-primary">
                                </div>




                                <!-- Address -->
                                <!-- <div class="col-md-4">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" id="newUserAddress" class="form-control shadow-sm border-info">
                                </div> -->
                                <!-- Role -->
                                <!-- <div class="col-md-4">
                                    <label class="form-label fw-bold">Role</label>
                                    <select id="newUserRole" class="form-select shadow-sm border-warning">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="editor">Editor</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="addNewUser">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Add New User Category Modal ======================= -->
    <div class="modal fade" id="addNewCategoryModal" tabindex="-1" aria-labelledby="addNewCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNewCategoryModalLabel">Add New User Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addNewCategoryForm">
                        <div class="container">
                            <div class="row g-3">
                                <!-- Category Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category Name</label>
                                    <input type="text" id="newCategoryName" class="form-control shadow-sm border-primary" required>
                                </div>
                                <!-- Category Description -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category Description</label>
                                    <input type="text" id="newCategoryDescription" class="form-control shadow-sm border-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="addNewCategory">Add Category</button>
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
                    <p>Are you sure you want to delete this user?</p>
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


    <!-- ===================================================get all users =================================== -->
    <script>
        $(document).ready(function() {
            let token = localStorage.getItem('jwt_token'); // Retrieve token
            console.log("Retrieved Token: ", token); // Debugging Log

            if (!token) {
                console.warn("No token found. Redirecting to login...");
                window.location.href = "/login";
                return;
            }

            $('#userTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "api/users/",
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    dataSrc: function(json) {
                        console.log("API Response: ", json);

                        if (!json || typeof json !== 'object') {
                            console.error("Invalid API response format.");
                            return [];
                        }

                        if (!Array.isArray(json.users)) {
                            console.error("Expected 'users' field to be an array. Found:", json);
                            return [];
                        }

                        return json.users.map(user => {
                            return {
                                ...user,
                                created_at: formatDate(user.created_at),
                                updated_at: formatDate(user.updated_at)
                            };
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error - Status:", status, "Error:", error);
                        console.error("Response:", xhr.responseText);

                        if (xhr.status === 401) {
                            console.warn("Unauthorized access. Redirecting to login...");
                            localStorage.removeItem('jwt_token');
                            window.location.href = "/login";
                        }
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'user_code',
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
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
                        }
                    }
                ]
            });

            // Function to format date to DD/MM/YYYY
            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                let date = new Date(dateString);
                let day = String(date.getDate()).padStart(2, '0');
                let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                let year = date.getFullYear();
                return `${day}/${month}/${year}`;
            }

            // Handle Update Button Click
            // Handle Update Button Click
            $('#userTable tbody').on('click', '.update-btn', function() {
                let userId = $(this).data('id');
                console.log("Update user:", userId);

                // Fetch user details from API
                $.ajax({
                    url: `api/users/${userId}`,
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        console.log("API Response:", response);

                        // Extract user data from the nested 'user' property
                        const user = response.user;

                        if (!user) {
                            console.error("User data not found in response");
                            return;
                        }

                        console.log("User Data to Populate:", {
                            id: user.id,
                            user_code: user.user_code,
                            name: user.name,
                            email: user.email,
                            status: user.status,
                            address: user.address,
                            role: user.role
                        });

                        // Populate Modal Fields
                        $('#userId').val(user.id || '');
                        $('#userCode').val(user.user_code || 'N/A');
                        $('#userName').val(user.name || '');
                        $('#userEmail').val(user.email || '');
                        $('#createdAt').val(formatDate(user.created_at) || 'N/A');
                        $('#updatedAt').val(formatDate(user.updated_at) || 'N/A');
                        $('#userStatus').val(user.status || 'active');
                        $('#userAddress').val(user.address || '');
                        $('#userRole').val(user.role || 'user');

                        // Show Bootstrap Modal
                        $('#updateModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching user:", error);
                        console.error("Response:", xhr.responseText);

                        if (xhr.status === 401) {
                            localStorage.removeItem('jwt_token');
                            window.location.href = "/login";
                        }
                    }
                });
            });

            // Handle Save Changes
            $('#saveUserChanges').on('click', function() {
                let userId = $('#userId').val();
                let updatedUser = {
                    user_code: $('#userCode').val(),
                    name: $('#userName').val(),
                    email: $('#userEmail').val(),
                    status: $('#userStatus').val(),
                    address: $('#userAddress').val(),
                    role: $('#userRole').val()
                };

                $.ajax({
                    url: `api/users/${userId}`,
                    type: "PUT",
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify(updatedUser),
                    success: function(response) {
                        console.log("User updated successfully:", response);
                        $('#updateModal').modal('hide'); // Close modal
                        $('#userTable').DataTable().ajax.reload(); // Refresh table
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating user:", error);
                    }
                });
            });

            // Handle Delete Button Click
            $('#userTable tbody').on('click', '.delete-btn', function() {
                let userId = $(this).data('id');
                $('#deleteUserId').val(userId);
                $('#deleteModal').modal('show');
            });

            // Confirm Delete
            $('#confirmDelete').on('click', function() {
                let userId = $('#deleteUserId').val();

                $.ajax({
                    url: `api/users/${userId}`,
                    type: "DELETE",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        $('#userTable').DataTable().ajax.reload();
                        showResponseModal('Success', 'User deleted successfully', true);
                    },
                    error: function(xhr) {
                        handleAjaxError(xhr);
                    }
                });
            });

            // Enhanced showResponseModal function
            function showResponseModal(title, message, isSuccess, redirectUrl = null) {
                var modalHeader = $('#modalHeader');
                var modalTitle = $('#modalTitle');
                var modalBody = $('#modalBody');

                // Set modal styling based on success/error
                if (isSuccess) {
                    modalHeader.css('background-color', '#28a745'); // Green for success
                    modalTitle.css('color', '#fff').text(title);
                    modalBody.html(message).css('color', '#000');
                } else {
                    modalHeader.css('background-color', '#dc3545'); // Red for error
                    modalTitle.css('color', '#fff').text(title);
                    modalBody.html(message).css('color', '#000');
                }

                $('#responseModal').modal('show');

                // Handle redirect if needed
                if (redirectUrl) {
                    $('#responseModal').on('hidden.bs.modal', function() {
                        window.location.href = redirectUrl;
                    });
                }
            }

            // Centralized error handler
            function handleAjaxError(xhr) {
                console.error("AJAX Error:", xhr.responseText);

                let errorMsg = 'An error occurred';
                try {
                    const jsonResponse = JSON.parse(xhr.responseText);

                    if (xhr.status === 401) {
                        showResponseModal('Session Expired', 'Please login again', false, '/login');
                        localStorage.removeItem('jwt_token');
                        return;
                    }

                    if (xhr.status === 422 && jsonResponse.errors) {
                        errorMsg = 'Validation errors:<ul>';
                        for (const field in jsonResponse.errors) {
                            jsonResponse.errors[field].forEach(error => {
                                errorMsg += `<li>${error}</li>`;
                            });
                        }
                        errorMsg += '</ul>';
                    } else if (xhr.status === 500) {
                        if (jsonResponse.message.includes('Duplicate entry')) {
                            errorMsg = jsonResponse.message.includes('user_code') ?
                                'User code already exists' :
                                'Email already exists';
                        } else {
                            errorMsg = 'Server error occurred';
                        }
                    } else {
                        errorMsg = jsonResponse.message || jsonResponse.error || errorMsg;
                    }
                } catch (e) {
                    errorMsg = xhr.responseText || errorMsg;
                }

                showResponseModal('Error', errorMsg, false);
            }
        });
        // $(document).ready(function() {
        //     let token = localStorage.getItem('jwt_token'); // Retrieve token
        //     console.log("Retrieved Token: ", token); // Debugging Log

        //     if (!token) {
        //         console.warn("No token found. Redirecting to login...");
        //         window.location.href = "/login";
        //         return;
        //     }

        //     $('#userTable').DataTable({
        //         processing: true,
        //         serverSide: false,
        //         ajax: {
        //             url: "api/users/",
        //             type: "GET",
        //             headers: {
        //                 'Authorization': `Bearer ${token}`
        //             },
        //             dataSrc: function(json) {
        //                 console.log("API Response: ", json); // Debugging log

        //                 if (!json || typeof json !== 'object') {
        //                     console.error("Invalid API response format.");
        //                     return [];
        //                 }

        //                 if (!Array.isArray(json.users)) {
        //                     console.error("Expected 'users' field to be an array. Found:", json);
        //                     return [];
        //                 }

        //                 return json.users.map(user => {
        //                     return {
        //                         ...user,
        //                         created_at: formatDate(user.created_at),
        //                         updated_at: formatDate(user.updated_at)
        //                     };
        //                 });
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error("AJAX Error - Status:", status, "Error:", error);
        //                 console.error("Response:", xhr.responseText);

        //                 if (xhr.status === 401) {
        //                     console.warn("Unauthorized access. Redirecting to login...");
        //                     localStorage.removeItem('jwt_token'); // Remove expired token
        //                     window.location.href = "/login";
        //                 }
        //             }
        //         },
        //         columns: [{
        //                 data: 'id'
        //             },
        //             {
        //                 data: 'user_code',
        //                 defaultContent: 'N/A'
        //             },
        //             {
        //                 data: 'name'
        //             },
        //             {
        //                 data: 'email'
        //             },
        //             {
        //                 data: 'created_at'
        //             },
        //             {
        //                 data: 'updated_at'
        //             },
        //             {
        //                 data: null,
        //                 render: function(data, type, row) {
        //                     return `
        //                     <button class="btn btn-sm btn-primary update-btn" data-id="${row.id}">Update</button>
        //                     <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
        //                 `;
        //                 }
        //             }
        //         ]
        //     });

        //     // Function to format date to DD/MM/YYYY
        //     function formatDate(dateString) {
        //         if (!dateString) return 'N/A';
        //         let date = new Date(dateString);
        //         let day = String(date.getDate()).padStart(2, '0');
        //         let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        //         let year = date.getFullYear();
        //         return `${day}/${month}/${year}`;
        //     }

        //     // Event delegation for Update button
        //     $('#userTable tbody').on('click', '.update-btn', function() {
        //         let userId = $(this).data('id');
        //         console.log("Update user:", userId);

        //         // Set user ID in modal
        //         $('#modalUserId').text(userId);

        //         // Show Bootstrap Modal
        //         $('#updateModal').modal('show');
        //     });

        //     // Event delegation for Delete button
        //     $('#userTable tbody').on('click', '.delete-btn', function() {
        //         let userId = $(this).data('id');
        //         if (confirm("Are you sure you want to delete this user?")) {
        //             $.ajax({
        //                 url: `api/users/${userId}`,
        //                 type: "DELETE",
        //                 headers: {
        //                     'Authorization': `Bearer ${token}`
        //                 },
        //                 success: function(response) {
        //                     console.log("User deleted successfully:", response);
        //                     $('#userTable').DataTable().ajax.reload(); // Refresh table
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error("Error deleting user:", error);
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
    <!-- =================================================end get all users ================================================== -->

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
                    url: 'api/users/',
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
                    url: 'api/userCategory',
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
<<<<<<< HEAD
                    url: 'api/users/', // API endpoint for users
=======
                    url: 'http://127.0.0.1:8000/api/users/', // API endpoint for users
>>>>>>> 8e66568546a1fcac80bb09846fb7598a65824f5f
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
<<<<<<< HEAD
                    url: 'api/userCategory', // API endpoint for user categories
=======
                    url: 'http://127.0.0.1:8000/api/userCategory', // API endpoint for user categories
>>>>>>> 8e66568546a1fcac80bb09846fb7598a65824f5f
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