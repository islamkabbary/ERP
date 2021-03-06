<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ERB System</title>
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo_1/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <style>
        .card {
            margin: auto;
            width: 320px;
            max-width: 600px;
            border-radius: 20px
        }

        .mt-50 {
            margin-top: 50px
        }

        .mb-50 {
            margin-bottom: 50px
        }

        @media(max-width:767px) {
            .card {
                width: 80%
            }
        }

        @media(height:1366px) {
            .card {
                width: 75%
            }
        }

        #orderno {
            padding: 1vh 2vh 0;
            font-size: smaller
        }

        .title {
            display: flex;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            padding: 12%
        }

        .main {
            padding: 0 2rem
        }

        .main img {
            border-radius: 7px
        }

        .main p {
            margin-bottom: 0;
            font-size: 0.75rem
        }

        #sub-title p {
            margin: 1vh 0 2vh 0;
            font-size: 1rem
        }

        .row-main {
            padding: 1.5vh 0;
            align-items: center
        }

        hr {
            margin: 1rem -1vh;
            border-top: 1px solid rgb(214, 214, 214)
        }

        .total {
            font-size: 1rem
        }

        @media(height: 1366px) {
            .main p {
                margin-bottom: 0;
                font-size: 1.2rem
            }

            .total {
                font-size: 1.5rem
            }
        }

        .button_outer {
            border-radius: 30px;
            text-align: center;
            height: 50px;
            width: 200px;
            padding-top: 11px;
            margin-top: -10px;
            margin-left: 65px;
            padding-left: 10px;
            display: inline-block;
            transition: .2s;
            position: relative;
            overflow: hidden;
        }

        .btn_upload input {
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            width: 100%;
            height: 105%;
            cursor: pointer;
            opacity: 0;
        }

        .button_outer_pro {
            border-radius: 30px;
            text-align: center;
            height: 50px;
            width: 200px;
            padding-top: 11px;
            margin-top: -10px;
            margin-left: -10px;
            display: inline-block;
            transition: .2s;
            position: relative;
            overflow: hidden;
        }

    </style>
    @yield('style')
    @livewireStyles()
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="">
                    <img src={{ asset('images/erp-logo-png-Transparent-Images.png') }} height="90px" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini">
                    <img src="{{ asset('images/erp-logo-png-Transparent-Images.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown language-dropdown">
                        <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#"
                            data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-0 mr-md-3">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-us"></i>
                                </div>
                            </div>
                            <span class="profile-text font-weight-medium d-none d-md-block">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2"
                            aria-labelledby="LanguageDropdown">
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-us"></i>
                                </div>English
                            </a>
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <img src="{{ asset('images/egypt.png') }}">
                                </div>Arabic
                            </a>
                        </div>
                    </li>
                </ul>
                <form class="ml-auto search-form d-none d-md-block" action="#">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="Search Here">
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count">7</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src={{ asset('images/faces/face10.jpg alt="image"') }}
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src={{ asset('images/faces/face12.jpg alt="image"') }}
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('images/faces/face1.jpg') }}" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count bg-success">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="notificationDropdown">
                            <a class="dropdown-item py-3 border-bottom">
                                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-alert m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0"> Just now </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-settings m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                                    <p class="font-weight-light small-text mb-0"> Private message </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration
                                    </h6>
                                    <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                                <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i
                                    class="dropdown-item-icon ti-dashboard"></i></a>
                            <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                            <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                            <a class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                                    alt="profile image">
                                <div class="dot-indicator bg-success"></div>
                            </div>
                            <div class="text-wrapper">
                                <p class="profile-name">{{ Auth::user()->name }}</p>
                                <p class="designation">{{ Auth::user()->email }}</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dash') }}">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Product</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add-purchases') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Purchases</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create-order') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Order</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('brand') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Brands</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('supplier') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Supplier</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('option') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Option</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inventory') }}">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Inventory</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Title Header Starts-->
                    <h2 class="text-center text-success">
                        <strong>
                            @yield('header')
                        </strong>
                    </h2>
                    @yield('dashboard-layout')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"
                            style="cursor: pointer">Copyright ?? ERB-ISLAM 2022</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"
                            style="cursor: pointer">ERB-ISLAM</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('js/shared/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/demo_1/dashboard.js') }}"></script>
    {{-- <script>
        < script type = "text/javascript"
        src = "jquery-ui-1.10.0/tests/jquery-1.9.0.js" >
    </script> --}}
    {{-- <script src="jquery-ui-1.10.0/ui/jquery-ui.js"></script> --}}
    <!-- End custom js for this page-->
    {{-- <script src="{{ asset('js/shared/jquery.cookie.js') }}" type="text/javascript"></script> --}}
    @yield('script')
    @livewireScripts()
</body>

</html>
