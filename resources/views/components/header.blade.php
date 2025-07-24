
<header id="mainHeader" class="d-flex align-items-center justify-content-between bg-white border-bottom shadow-sm fixed-top p-2">
    <div class="d-flex align-items-center">
        <!-- <a href="/" class="d-inline-block mx-3">
            <img src="http://via.placeholder.com/90x25" alt="EquProStock" class="img-fluid"/>
        </a> -->
        <div class="mdi mdi-menu mdi-24px text-muted cursor-pointer" id="toggle-sidebar"></div>
        <nav class="mx-4 d-none d-lg-block">
            <a href="{{ route('dashboard') }}" class="px-3 text-dark font-weight-bold">Dashboard</a>
            <div id="adminLinks" style="display: none;">
                <a href="{{ route('getUsers') }}" class="px-3 text-dark font-weight-bold">Users</a>
                <a href="{{ route('getOffice') }}" class="px-3 text-dark font-weight-bold">Offices</a>
            </div>

        </nav>
    </div>
    <div class="d-flex align-items-center">

        <div class="dropdown position-relative ml-3">
            <p id="userEmail" class="mb-0 font-weight-bold text-dark"></p>
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

    </div>
</header>

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
                if (data.role === 'admin') {
                    document.getElementById('adminLinks').style.display = 'block';
                }
            })
            .catch(err => console.error("Auth error:", err));
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwt_token'); // Or sessionStorage

        if (!token) return;

        fetch('/api/user', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error("Unauthorized or server error");
                }
                return res.json();
            })
            .then(data => {
                document.getElementById('userEmail').textContent = data.email;
            })
            .catch(err => {
                console.error("User email fetch failed:", err);
            });
    });
</script>
