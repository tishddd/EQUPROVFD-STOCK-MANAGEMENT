<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/css/bootstrap.min.css')}}">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admindashbordAssets/css/style.css')}}">

    <title>Admin Panel</title>
</head>




<body class="bg-light">
    <header class="d-flex align-items-center justify-content-between bg-white border-bottom fixed-top p-2">
        <div class="d-flex align-items-center">
            <a href="/" class="d-inline-block mx-3">
                <img src="http://via.placeholder.com/90x25" alt="logo" />
            </a>
            <div class="mdi mdi-menu mdi-24px text-muted" id="toggle-sidebar"></div>
            <nav class="mx-5 d-none d-lg-block">
                <a href="#" class="px-2">Dashboard</a>
                <a href="#" class="px-2">Users</a>
                <a href="#" class="px-2">Settings</a>
            </nav>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown position-relative">
                <span class="mdi mdi-bell-outline mdi-24px dropdown-toggle" id="dropdownMenuNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-pill badge-warning position-absolute" style="top: 0;left:-5px">3</span>
                </span>
                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="dropdownMenuNotification" style="max-width: 200px;">
                    <h6 class="dropdown-header bg-primary text-white text-center">you have <b>3</b> notification </h6>
                    <p class="p-2 text-muted">
                        Some example text that's free-flowing within the dropdown menu.
                    </p>
                    <div class="dropdown-divider m-0"></div>

                    <p class="p-2 text-muted mb-0">
                        And this is more example text.
                    </p>

                </div>
            </div>
            <span class="mdi mdi-format-list-bulleted mdi-24px mx-3 position-relative">
                <span class="badge badge-pill badge-danger position-absolute" style="top: 0;left:-5px">3</span>
            </span>
            <span class="mdi mdi-email-outline mdi-24px position-relative">
                <span class="badge badge-pill badge-info position-absolute" style="top: 0;left:-5px">3</span>
            </span>

            <div class="dropdown position-relative">
                <img src="http://via.placeholder.com/40x40" alt="user" class="rounded-circle mx-4 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />

                <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header bg-primary text-white text-center">Account</h6>
                    <a class="dropdown-item d-flex align-items-center px-2" href="#">
                        <span class="mdi mdi-bell-outline mr-1"></span>
                        update
                        <span class="badge badge-info ml-auto">3</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item d-flex align-items-center px-2" href="#">
                        <span class="mdi mdi-message-outline mr-1"></span>
                        message
                        <span class="badge badge-info ml-auto">5</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item d-flex align-items-center px-2" href="#">
                        <span class="mdi mdi-format-list-bulleted mr-1"></span>
                        tasks
                        <span class="badge badge-info ml-auto">10</span>
                    </a>
                    <h6 class="dropdown-header bg-primary text-white text-center">settings</h6>
                    <a class="dropdown-item d-flex align-items-center px-2" href="#">
                        <span class="mdi mdi-account mr-1"></span>
                        profile
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item d-flex align-items-center px-2" href="#">
                        <span class="mdi mdi-power mr-1"></span>
                        logout
                    </a>
                </div>
            </div>

            <div class="mdi mdi-menu mdi-24px text-muted" id="toggle-aside-menu"></div>

        </div>
    </header>
    <div class="app-body d-flex h-100">
        <div class="sidebar bg-dark open p-3 text-white d-flex flex-column justify-content-between">
            <div>
                <h6 class="text-muted">Dashboard</h6>
                <ul class="list-unstyled mt-3">
                    <li>
                        <a class="d-flex align-items-center text-white d-block collapsed" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span class="mdi mdi-food-croissant mdi-24px mr-1 text-info"></span>
                            View Stock
                            <span class="mdi mdi-chevron-right mdi-24px ml-auto text-info"></span>
                        </a>
                        <div class="collapse bg-light" id="collapseExample">
                            <ul class="list-unstyled ml-3 py-2">
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-fork-drink mdi-24px text-info"></span>
                                        Add New Items
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-off mdi-24px text-info"></span>
                                        Stock report
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-variant mdi-24px text-info"></span>
                                        Edity Stock
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <span class="mdi mdi-food-fork-drink mdi-24px text-info"></span>
                            Sales Report
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center text-white d-block collapsed" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                            <span class="mdi mdi-food-croissant mdi-24px mr-1 text-info"></span>
                            Stock Movement
                            <span class="mdi mdi-chevron-right mdi-24px ml-auto text-info"></span>
                        </a>
                        <div class="collapse bg-light" id="collapseExample2">
                            <ul class="list-unstyled ml-3 py-2">
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-fork-drink mdi-24px text-info"></span>
                                        Munu No.2
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-off mdi-24px text-info"></span>
                                        Munu No.3
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-dark">
                                        <span class="mdi mdi-food-variant mdi-24px text-info"></span>
                                        Munu No.4
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <span class="mdi mdi-food-variant mdi-24px text-info"></span>
                            Revenue Report
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <span class="mdi mdi-football mdi-24px text-info"></span>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <span class="mdi mdi-football-helmet mdi-24px text-info"></span>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <a href="#" class="d-flex align-items-center text-primary">
                    <span class="mdi mdi-power mdi-24px mr-2"></span>
                    Log out
                </a>
            </div>
        </div>
        <main class="main flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-0 bg-white border-bottom m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
            <div class="content p-3">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="bg-primary rounded p-3 text-white">
                            <div class="d-flex h5">
                                <div>
                                    1452
                                    <small class="d-block dark text-white p-2">Total Devices Received</small>
                                </div>

                                <div class="dropdown ml-auto">
                                    <span class="mdi mdi-settings dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-right text-white-50">25%</div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 mt-3 mt-xl-0">
                        <div class="bg-danger rounded p-3 text-white">
                            <div class="d-flex h5">
                                <div>
                                    1452
                                    <small class="d-block dark text-white p-2">Thermal Printer Received</small>
                                </div>

                                <div class="dropdown ml-auto">
                                    <span class="mdi mdi-settings dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-right text-white-50">25%</div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 mt-3 mt-xl-0">
                        <div class="bg-info rounded p-3 text-white">
                            <div class="d-flex h5">
                                <div>
                                    1452
                                    <small class="d-block dark text-white p-2">POS Received</small>
                                </div>

                                <div class="dropdown ml-auto">
                                    <span class="mdi mdi-settings dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-right text-white-50">25%</div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 mt-3 mt-xl-0">
                        <div class="bg-warning rounded p-3 text-white">
                            <div class="d-flex h5">
                                <div>

                                1452
                                <!-- <small class="d-block dark text-white p-2">Thermal Printer Remaining</small>1452 -->
                                    <small class="d-block dark text-white p-2">POS Remainging </small> 
                                </div>

                                <div class="dropdown ml-auto">
                                    <span class="mdi mdi-settings dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-right text-white-50">25%</div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
    
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
        </main>
        <aside class="aside-menu bg-white border-left open d-flex flex-column">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active rounded-0 border-left-0" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                        <span class="mdi mdi-settings"></span>
                    </a>
                    <a class="nav-item nav-link rounded-0" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <span class="mdi mdi-format-list-bulleted"></span>
                    </a>
                    <a class="nav-item nav-link rounded-0" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <span class="mdi mdi-comment-processing"></span>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show p-3 active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Check this checkbox</label>
                    </div>
                    <hr />
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2">Check this checkbox</label>
                    </div>
                    <hr />
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">Or toggle this other custom radio</label>
                    </div>
                    <hr />
                    <div class="d-flex align-items-center">
                        option 1
                        <label class="ios7-switch ml-auto h4">
                            <input type="checkbox" checked>
                            <span></span>
                        </label>
                    </div>
                    <div class="d-flex align-items-center">
                        option 2
                        <label class="ios7-switch ml-auto h4">
                            <input type="checkbox">
                            <span></span>
                        </label>
                    </div>
                    <div class="d-flex align-items-center">
                        option 3
                        <label class="ios7-switch ml-auto h4">
                            <input type="checkbox" checked>
                            <span></span>
                        </label>
                    </div>
                    <hr />
                    <label for="customRange1">Example range</label>
                    <input type="range" class="custom-range" id="customRange1">
                </div>
                <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div>
                        <div class="d-flex justify-content-between text-muted">
                            <span>title of content</span>
                            <span class="small">2018/02/15</span>
                        </div>
                        <p>
                            Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                        </p>
                    </div>
                    <hr />
                    <div>
                        <div class="d-flex justify-content-between text-muted">
                            <span>title of content</span>
                            <span class="small">2018/02/15</span>
                        </div>
                        <p>
                            Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                        </p>
                    </div>
                    <hr />
                    <div>
                        <div class="d-flex justify-content-between text-muted">
                            <span>title of content</span>
                            <span class="small">2018/02/15</span>
                        </div>
                        <p>
                            Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                        </p>
                    </div>
                    <hr />
                </div>
                <div class="tab-pane fade p-2" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="d-flex p-3 border-bottom">
                        <img src="http://via.placeholder.com/70x70" class="rounded-circle align-self-start mr-2 w-25" />
                        <div class="w-75">
                            <small class="text-muted">family Name</small>
                            <h6 class=" text-truncate font-weight-bold">
                                Amet, consectetur adipiscing elit.
                            </h6>
                            <p class=" small">
                                Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex p-3 border-bottom">
                        <img src="http://via.placeholder.com/70x70" class="rounded-circle align-self-start mr-2 w-25" />
                        <div class="w-75">
                            <small class="text-muted">family Name</small>
                            <h6 class=" text-truncate font-weight-bold">
                                Amet, consectetur adipiscing elit.
                            </h6>
                            <p class=" small">
                                Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex p-3 border-bottom">
                        <img src="http://via.placeholder.com/70x70" class="rounded-circle align-self-start mr-2 w-25" />
                        <div class="w-75">
                            <small class="text-muted">family Name</small>
                            <h6 class=" text-truncate font-weight-bold">
                                Amet, consectetur adipiscing elit.
                            </h6>
                            <p class=" small">
                                Ut fusce varius nisl ac ipsum gravida vel pretium tellus tincidunt integer eu augue augue nunc elit dolor, luctus placerat.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="alerts mt-auto">
                <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
                    <h5 class="alert-heading">Well done!</h5>
                    <p>
                        Sapien elit in malesuada semper
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show mx-2" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </aside>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <!-- jQuery (Optional if already included via CDN) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/admindashbordAssets/bootstrap-4.1.1/dist/js/bootstrap.min.js') }}"></script>

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
</body>

</html>