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
    <!-- =======Header====== -->
    @include('components.header')
    <div class="app-body d-flex h-100">

        <!-- =======sideBar====== -->
        @include('components.sideBar')

        <main class="main flex-grow-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rounded-0 bg-white border-bottom m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" class="-block dark text-white p-2" aria-current="page">Open date :: 08 february 2025</li>
                </ol>
            </nav>
            <div class="content p-3">

                <!-- =======dashBoardPanel====== -->
                @include('components.dashBoardPanel')


                <div class="table-responsive table-responsive-sm mt-3">
                    <table class="table table-sm table-hover border">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">

                                </th>
                                <th>Id</th>
                                <th>Item Name</th>
                                <th>Model Number</th>
                                <th>Serial Number</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Sold price</th>
                                <th>Office</th>
                                <th>Employee</th>
                                <th>Customer Tin</th>
                                <th>Created At</th>
                                <th>Sold date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="align-middle text-center">
                                </th>
                                <td class="align-middle">1</td>
                                <td class="align-middle">Pos</td>
                                <td class="align-middle">H1OS</td>
                                <td class="align-middle">H10S755248T0986</td>
                                <td class="align-middle" style="color: red;">In Office</td>
                                <td class="align-middle">550000</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">Mwanza</td>
                                <td class="align-middle">france</td>
                                <td class="align-middle">-</td>
                                <td class="align-middle">2023-07-10</td>
                                <td class="align-middle">-</td>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">
                                </th>
                                <td class="align-middle">2</td>
                                <td class="align-middle">Thermo Printer</td>
                                <td class="align-middle">OCPP-M06</td>
                                <td class="align-middle">OCM062243100994</td>
                                <td class="align-middle" style="color: green;">Sold</td>
                                <td class="align-middle">150000</td>
                                <td class="align-middle">130000</td>
                                <td class="align-middle">Mwanza</td>
                                <td class="align-middle">france</td>
                                <td class="align-middle">125381382</td>
                                <td class="align-middle">2023-07-10</td>
                                <td class="align-middle">2024-01-15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
        </main>
        @include('components.sideManue')
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