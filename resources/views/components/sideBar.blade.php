<style>
    /* Remove underline from sidebar links */
    .sidebar a {
        text-decoration: none !important;
    }

    /* Adjust padding and margins */
    .sidebar {
        padding: 15px;
    }

    /* Ensure text color remains white */
    /* .sidebar a {
        color: white !important;
    } */

    /* Improve hover effects */
    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
    }
</style>



<div class="sidebar bg-dark open p-4 text-white d-flex flex-column justify-content-between shadow-lg" style="width: 260px; min-height: 90vh; transition: all 0.3s ease;">
    <div>
        <h5 class="text-uppercase text-white font-weight-bold">Dashboard</h5>
        <ul class="list-unstyled mt-4">
            <!-- View Stock -->
            <li>
                <a class="d-flex align-items-center text-white py-2 rounded" data-bs-toggle="collapse" href="#collapseStock" role="button" aria-expanded="true" aria-controls="collapseStock">
                    <span class="mdi mdi-package-variant mdi-24px mr-2 text-info"></span> View Stock
                    <span class="mdi mdi-chevron-down mdi-18px ml-auto text-info"></span>
                </a>
                <div class="collapse show bg-light rounded mt-2 px-3" id="collapseStock">
                    <ul class="list-unstyled py-2">
                        <li>
                            <a id="addStockLink" href="{{ route('addStock') }}" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-plus-box mdi-18px text-primary mr-2"></span> Add New Stock
                            </a>

                        </li>
                        <li>
                            <a href="{{ route('stockList') }}" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-format-list-bulleted mdi-18px text-primary mr-2"></span> Stock List
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-chart-bar mdi-18px text-primary mr-2"></span> Report Issue
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>

            <!-- Add this somewhere at the top or inside the blade file -->
            <input type="hidden" id="userRole" value="">

            <!-- Stock Movement -->
            <!-- Place this where you want the menu to appear, but keep it hidden by default -->
            <div id="adminStockMovement" style="display: none;">
                <li class="mt-2">
                    <a class="d-flex align-items-center text-white py-2 rounded" data-bs-toggle="collapse" href="#collapseStockMovement" role="button" aria-expanded="true" aria-controls="collapseStockMovement">
                        <span class="mdi mdi-swap-horizontal mdi-24px text-success mr-2"></span> Stock Movement
                        <span class="mdi mdi-chevron-down mdi-18px ml-auto text-info"></span>
                    </a>
                    <div class="collapse show bg-light rounded mt-2 px-3" id="collapseStockMovement">
                        <ul class="list-unstyled py-2">
                            <li>
                                <a href="{{ route('stockTransfer') }}" class="text-dark d-flex align-items-center py-1">
                                    <span class="mdi mdi-clipboard-text mdi-18px text-success mr-2"></span> Transfers
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('stockTransaction') }}" class="text-dark d-flex align-items-center py-1">
                                    <span class="mdi mdi-swap-horizontal mdi-24px text-success mr-2"></span> Transaction
                                </a>
                            </li>

                            <li>
                                <a href="#" class="text-dark d-flex align-items-center py-1">
                                    <span class="mdi mdi-receipt mdi-18px text-success mr-2"></span> Returns
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </div>



            <!-- Transactions -->
            <!-- Admin-only section -->
            <div id="adminLinks" style="display: none;">
                <!-- Transactions -->
                <li class="mt-2">
                    <a class="d-flex align-items-center text-white py-2 rounded" href="{{ route('stockTransaction') }}">
                        <span class="mdi mdi-swap-horizontal mdi-24px text-success mr-2"></span> Transaction
                    </a>
                </li>

                <!-- Revenue Report -->
                <li class="mt-2">
                    <a href="#" class="text-white d-flex align-items-center py-2 rounded">
                        <span class="mdi mdi-finance mdi-24px text-info mr-2"></span> Revenue Report
                    </a>
                </li>

                <!-- Offices -->
                <li class="mt-2">
                    <a href="{{ route('getOffice') }}" class="text-white d-flex align-items-center py-2 rounded">
                        <span class="bi bi-buildings-fill mdi-24px text-danger mr-2"></span> Offices
                    </a>
                </li>
            </div>

        </ul>
    </div>

    <!-- Logout Section -->
    <div class="mt-auto border-top pt-3">
        <a href="#" class="d-flex align-items-center text-danger font-weight-bold logout-button">
            <span class="mdi mdi-logout mdi-25px mr-2"></span> Log Out
        </a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.collapse').forEach(element => {
            element.classList.add('show');
        });
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwt_token');

        if (!token) {
            console.warn('No token found');
            return;
        }

        fetch('/api/user', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => {
                if (res.status === 200) return res.json();
                throw new Error("Unauthorized");
            })
            .then(data => {
                console.log("Logged in user:", data);
                if (data.role === 'admin') {
                    document.getElementById('adminStockMovement').style.display = 'block';
                    document.getElementById('adminLinks').style.display = 'block';
                }
            })
            .catch(err => {
                console.error("Auth error:", err);
            });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwt_token');

        if (!token) return;

        fetch('/api/user', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.role !== 'admin') {
                    const link = document.getElementById('addStockLink');
                    link.removeAttribute('href'); // Disable the link
                    link.style.pointerEvents = 'none';
                    link.style.opacity = 0.5;
                    link.style.cursor = 'not-allowed';
                    link.title = "Only admins can access this";
                }
            })
            .catch(err => console.error("Auth error:", err));
    });
</script>