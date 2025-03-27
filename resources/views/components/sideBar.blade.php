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
                            <a href="{{ route('addStock') }}" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-plus-box mdi-18px text-primary mr-2"></span> Add New Stock
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('stockList') }}" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-format-list-bulleted mdi-18px text-primary mr-2"></span> Stock List
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-chart-bar mdi-18px text-primary mr-2"></span> Report Issue
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Stock Movement -->
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
                            <a href="#" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-receipt mdi-18px text-success mr-2"></span> Returns
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Transactions -->
            <li class="mt-2">
                <a class="d-flex align-items-center text-white py-2 rounded" href="#">
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