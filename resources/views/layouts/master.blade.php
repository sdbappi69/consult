<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--<meta name="description" content="au theme template">--}}
{{--<meta name="author" content="Hau Nguyen">--}}
{{--<meta name="keywords" content="au theme template">--}}

<!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    @include('layouts.style')

</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
@include('layouts.header_m')
<!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
@include('layouts.sidebar')
<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
    @include('layouts.header')
    <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
        {{--modal --}}
        @yield('modal')
    </div>

</div>
@include('layouts.script')
</body>

</html>
<!-- end document-->
