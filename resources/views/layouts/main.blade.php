<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="utf-8" />
        <title>
            @yield('title', 'Dashboard')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="dbc24.uz"/>
        <meta name="author" content="dbc24.uz"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- Icons -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        @stack('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
        <style>
            .select2-container--default .select2-results__option--highlighted[aria-selected]{
                background-color: #89CB3D;
            }
        </style>
    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">
            <!-- Topbar Start -->
            @include('components.header')
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            @include('components.navbar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
              @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        @include('sweetalert::alert')
        @stack('js')
        <!-- Vendor -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

        {{-- sweetalert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- for basic area chart -->
        <script src="{{asset('apexcharts.com/samples/assets/stock-prices.js')}}"></script>

        <!-- Widgets Init Js -->
        {{-- <script src="{{asset('assets/js/pages/analytics-dashboard.init.js')}}"></script> --}}

        <!-- App js-->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $("#single").select2({
                placeholder: "Выберите",
                allowClear: true
            });
          $("#multiple").select2({
              placeholder: "Выберите",
              allowClear: true
          });
        </script> 
        <script>
          var delayTimer;
          function doSearch(text) {
              clearTimeout(delayTimer);
              delayTimer = setTimeout(function() {
                document.getElementById('form').submit();
              }, 1000); // Will do the ajax stuff after 1000 ms, or 1 s
          }
        </script>
        <script>
            // Kiritish vaqtida har bir harfni katta harfga aylantiradi
            function ToUpper(element) {
            element.value = element.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            }
        </script>
        
    </body>
