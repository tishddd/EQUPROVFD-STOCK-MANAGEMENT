<header class="d-flex align-items-center justify-content-between bg-white border-bottom shadow-sm fixed-top p-2">
    <div class="d-flex align-items-center">
        <a href="/" class="d-inline-block mx-3">
            <img src="http://via.placeholder.com/90x25" alt="logo" class="img-fluid"/>
        </a>
        <div class="mdi mdi-menu mdi-24px text-muted cursor-pointer" id="toggle-sidebar"></div>
        <nav class="mx-4 d-none d-lg-block">
            <a href="{{ route('dashboard') }}" class="px-3 text-dark font-weight-bold">Dashboard</a>
            <a href="{{ route('getUsers') }}" class="px-3 text-dark font-weight-bold">Users</a>
            <a href="{{ route('getOffice') }}" class="px-3 text-dark font-weight-bold">Offices</a>
            <a href="#" class="px-3 text-dark font-weight-bold">Settings</a>
        </nav>
    </div>
    <div class="d-flex align-items-center">
        <div class="dropdown position-relative">
            <span class="mdi mdi-bell-outline mdi-24px dropdown-toggle position-relative" id="dropdownMenuNotification" data-toggle="dropdown">
                <span class="badge badge-pill badge-warning position-absolute" style="top: 0; left:-5px">3</span>
            </span>
            <div class="dropdown-menu dropdown-menu-right shadow-lg rounded" aria-labelledby="dropdownMenuNotification" style="min-width: 250px;">
                <h6 class="dropdown-header bg-primary text-white text-center">You have <b>3</b> notifications</h6>
                <p class="p-3 text-muted mb-0">Some example text in the dropdown menu.</p>
                <div class="dropdown-divider"></div>
                <p class="p-3 text-muted mb-0">More example text.</p>
            </div>
        </div>
        <span class="mdi mdi-format-list-bulleted mdi-24px mx-3 position-relative">
            <span class="badge badge-pill badge-danger position-absolute" style="top: 0; left:-5px">3</span>
        </span>
        <span class="mdi mdi-email-outline mdi-24px position-relative">
            <span class="badge badge-pill badge-info position-absolute" style="top: 0; left:-5px">3</span>
        </span>
        <div class="dropdown position-relative ml-3">
            <p class="mb-0 font-weight-bold text-dark">Muuminimwinyi@equprovfd.co.tz</p>
            <div class="dropdown-menu dropdown-menu-right shadow-lg rounded" aria-labelledby="dropdownMenuButton">
                <h6 class="dropdown-header bg-primary text-white text-center">Account</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <span class="mdi mdi-bell-outline mr-2"></span> Update
                    <span class="badge badge-info ml-auto">3</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <span class="mdi mdi-message-outline mr-2"></span> Messages
                    <span class="badge badge-info ml-auto">5</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <span class="mdi mdi-format-list-bulleted mr-2"></span> Tasks
                    <span class="badge badge-info ml-auto">10</span>
                </a>
                <h6 class="dropdown-header bg-primary text-white text-center">Settings</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <span class="mdi mdi-account mr-2"></span> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                    <span class="mdi mdi-power mr-2"></span> Logout
                </a>
            </div>
        </div>
        <div class="mdi mdi-menu mdi-24px text-muted ml-3 cursor-pointer" id="toggle-aside-menu"></div>
    </div>
</header>
