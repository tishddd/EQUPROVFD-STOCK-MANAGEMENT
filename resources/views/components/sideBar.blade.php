<div class="sidebar bg-dark open p-4 text-white d-flex flex-column justify-content-between shadow-lg" style="width: 260px; min-height: 90vh;">
    <div>
        <h5 class="text-uppercase text-muted font-weight-bold">Dashboard</h5>
        <ul class="list-unstyled mt-4">
            <!-- View Stock -->
            <li>
                <a class="d-flex align-items-center text-white py-2 rounded collapsed" data-toggle="collapse" href="#collapseStock" role="button" aria-expanded="false" aria-controls="collapseStock">
                    <span class="mdi mdi-package-variant mdi-24px mr-2 text-info"></span> View Stock
                    <span class="mdi mdi-chevron-down mdi-18px ml-auto text-info"></span>
                </a>
                <div class="collapse bg-light rounded mt-2 px-3" id="collapseStock">
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

                        <!-- <li>
                            <a href="#" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-chart-bar mdi-18px text-primary mr-2"></span> Stock Report
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>

            <!-- Sales Report -->
            <!-- <li class="mt-2">
                <a href="#" class="text-white d-flex align-items-center py-2 rounded">
                    <span class="mdi mdi-cash-register mdi-24px text-warning mr-2"></span> Sales Report
                </a>
            </li> -->

            <!-- Stock Movement -->
            <li class="mt-2">
                <a class="d-flex align-items-center text-white py-2 rounded collapsed" data-toggle="collapse" href="#collapseStockMovement" role="button" aria-expanded="false" aria-controls="collapseStockMovement">
                    <span class="mdi mdi-swap-horizontal mdi-24px text-success mr-2"></span> Stock Movement
                    <span class="mdi mdi-chevron-down mdi-18px ml-auto text-info"></span>
                </a>
                <div class="collapse bg-light rounded mt-2 px-3" id="collapseStockMovement">
                    <ul class="list-unstyled py-2">
                        <li>
                            <a href="{{ route('stockTransfer') }}" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-clipboard-text mdi-18px text-success mr-2"></span> Transfers
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-dark d-flex align-items-center py-1">
                                <span class="mdi mdi-receipt mdi-18px text-success mr-2"></span> Received
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

            <!-- Revenue Report -->
            <li class="mt-2">
                <a href="#" class="text-white d-flex align-items-center py-2 rounded">
                    <span class="mdi mdi-finance mdi-24px text-info mr-2"></span> Revenue Report
                </a>
            </li>

            <!-- Users -->
            <li class="mt-2">
                <a href="#" class="text-white d-flex align-items-center py-2 rounded">
                    <span class="mdi mdi-account-group mdi-24px text-danger mr-2"></span> Users
                </a>
            </li>

            <!-- Settings -->
            <li class="mt-2">
                <a href="#" class="text-white d-flex align-items-center py-2 rounded">
                    <span class="mdi mdi-cog mdi-24px text-light mr-2"></span> Settings
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