<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <base href="" />
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://www.weballures.com/image/favicon.png" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/css/datatables.min.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <!--begin::INTEL TELE CSS-->
    <link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.min.css" rel="stylesheet">
    <!--END::INTEL TELE CSS-->

    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.5);
            /* Semi-transparent white background */
            z-index: 9999;
            /* Make sure it's on top of other elements */
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .loader-content {
            text-align: center;
        }

        .loading-circle {
            border: 5px solid #f3f3f3;
            /* Light gray border */
            border-top: 5px solid #3498db;
            /* Blue border - customize the color as needed */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            /* Add a spinning animation */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            appearance: none; 
        }
    </style>
    @yield('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" data-kt-app-page-loading-enabled="true" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed">
    <div id="loader" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed">
        <img src="assets/media/images/web_allures.webp" alt="Logo" height="60px" width="150px" />
        <div class="loading-circle"></div>
    </div>
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            @include('layouts.sidebar')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.header')
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="container-fluid">
                        <!--begin::Container-->
                        @yield('content')
                        <!--end::Container-->
                    </div>
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    @include('layouts.footer')
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>

    <!--end::Scrolltop-->

    @include('layouts.scripts')

    <script>
        window.addEventListener('load', function() {
            // Page is fully loaded, hide the loader
            document.getElementById('loader').style.display = 'none';
        });
        $(document).ready(function() {
            var currentRoute = window.location.pathname;
            currentRoute = currentRoute.substring(1);
            $('#kt_aside_menu .menu-link').each(function() {
                var menuLink = $(this).attr('href');
                if (menuLink && menuLink.trim() !== '') {
                    var menuRoute = menuLink.substring(menuLink.lastIndexOf('/') + 1);
                    if (currentRoute === menuRoute) {
                        $(this).addClass('active');
                        var closestDiv = $(this).closest('.menu-item.py-2[data-kt-menu-placement="right-start"]');
                        var closestAccordianDiv = $(this).closest('[data-kt-menu-trigger="click"]');
                        var secondClosestAccordianDiv = closestAccordianDiv.parent().parent();
                        if (closestDiv.length > 0) {
                            closestDiv.addClass('here');
                            closestDiv.addClass('show');
                            closestAccordianDiv.addClass('here');
                            closestAccordianDiv.addClass('show');
                        }
                        if (closestAccordianDiv.length > 0) {
                            closestAccordianDiv.addClass('here');
                            closestAccordianDiv.addClass('show');
                            secondClosestAccordianDiv.addClass('here');
                            secondClosestAccordianDiv.addClass('show');
                        }
                    }
                }
            });
        });
        // Toster Start
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toastr-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "2000",
            "timeOut": "5000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        // Play success sound
        // document.getElementById('successSound').play();
        @endif
        @if(session('error'))
        toastr.error("{{ session('error') }}");
        // Play success sound
        // document.getElementById('errorSound').play();
        @endif
    </script>
    @yield('scripts')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>