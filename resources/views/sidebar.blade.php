<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Restoran Zidan</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('vendors/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/chartist/chartist.min.css') }}">
        <!-- End plugin css for this page -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
        
    </head>
    <body>
        <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
            
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('images/logo-mini.svg')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome to Dashboard!</h5>
            <ul class="navbar-nav navbar-nav-right ml-auto">
                <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

                <img class="img-xs rounded-circle ml-2" src="https://source.unsplash.com/50x50?manager" alt="Profile image"> <span class="font-weight-normal"> zidan</span></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="https://source.unsplash.com/100x100?manager" alt="Profile image">
                        <p class="mb-1 mt-3">{{ Auth::user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <x-dropdown-link class="dropdown-item" :href="route('profile.edit')">
                        <i class="dropdown-item-icon icon-user text-primary"></i>
                        {{ __('My Profile') }}
                    </x-dropdown-link>
                    <form class="dropdown-item ml-2" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="dropdown-item-icon icon-power text-primary"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">

                <li class="nav-item nav-category">
                <span class="nav-link">Dashboard</span>
                
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('pesanan.index')}}" aria-expanded="true">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-screen-desktop menu-icon"></i>
                </a>
                <div id="dashboard">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('pesanan.trash')}}">Sampah</a></li>
                    </ul>
                </div>

                </li>
                <li class="nav-item nav-category"><span class="nav-link">Halaman per Tabel</span></li>

                <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pelanggan" aria-expanded="false">
                    <span class="menu-title">Pelanggan</span>
                    <i class="icon-layers menu-icon"></i>
                </a>
                <div class="collapse" id="pelanggan">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('pelanggan.index')}}">Daftar Pelanggan</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('pelanggan.trash')}}">Sampah</a></li>
                    </ul>
                </div>
                </li>


                <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#menu" aria-expanded="false">
                    <span class="menu-title">menu</span>
                    <i class="icon-layers menu-icon"></i>
                </a>
                <div class="collapse" id="menu">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('menu.index')}}">Daftar Menu</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('menu.trash')}}">Sampah</a></li>
                    </ul>
                </div>
                </li>

            </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
            <div class="content-wrapper">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @endif
                
                @yield('content')
                
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('vendors/moment/moment.min.js') }}"></script>
        <script src="{{ asset('vendors/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('vendors/chartist/chartist.min.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('js/off-canvas.js') }}"></script>
        <script src="{{ asset('js/misc.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Bootstrap Icons -->
        <script src="{{ asset('vendors/bootstrap-icons/bootstrap-icons.js') }}"></script>
        <!-- Bootstrap Modal -->
        <script src="{{ asset('vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
        <!-- End custom js for this page -->
    </body>
</html>