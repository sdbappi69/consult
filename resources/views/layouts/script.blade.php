
<!-- Jquery JS-->
<script src="{{asset('/')}}vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="{{asset('/')}}vendor/bootstrap-4.1/popper.min.js"></script>
<script src="{{asset('/')}}vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="{{asset('/')}}vendor/slick/slick.min.js">
</script>
<script src="{{asset('/')}}vendor/wow/wow.min.js"></script>
<script src="{{asset('/')}}vendor/animsition/animsition.min.js"></script>
<script src="{{asset('/')}}vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="{{asset('/')}}vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="{{asset('/')}}vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="{{asset('/')}}vendor/circle-progress/circle-progress.min.js"></script>
<script src="{{asset('/')}}vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{asset('/')}}vendor/chartjs/Chart.bundle.min.js"></script>
<script src="{{asset('/')}}vendor/select2/select2.min.js"></script>
@yield('script')
<!-- Main JS-->
<script src="{{asset('/')}}js/main.js"></script>
<script !src="">
    $(document).ready(function () {
        $('a[href="' + current_url + '"]').parents('li').addClass('active');
        $('a[href="' + current_url + '"]').parent('li').addClass('active open');
        $('a[href="' + current_url + '"]').parent().parent('ul').css('display','block');
    })
</script>
@stack('script')