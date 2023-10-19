<!-- jQuery -->
<script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('template') }}/plugins/toastr/toastr.min.js"></script>
{{-- @include('_template/includes/toastr') --}}
<!-- Custom js -->
@yield('scripts')

<!-- AdminLTE App -->
<script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template') }}/dist/js/demo.js"></script>


<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
<script>


    var theme = 'dark-mode';
    var tmp = localStorage.getItem("dark-mode");

    setTheme();

    $('#dark-mode-button').click(function (e) { 
        tmp = (tmp == theme) ? '' : theme
        localStorage.setItem("dark-mode", tmp); 
        setTheme()
    });

    function setTheme() {
        tmp = localStorage.getItem("dark-mode");
        if(tmp == '') {
            $('body').removeClass(theme)
            $('.main-header').removeClass('bg-dark text-white')
            return 
        }
        $('body').addClass(theme)
        $('.main-header').addClass('bg-dark text-white')
    }



</script>

<script>
    // $("body").niceScroll();
    if($('.alert-message').length > 0) {
        $('.alert-message').delay(5000).fadeOut(500)
    }
</script>

<script>
    function showAlert(message, type) {
        type = (typeof type   === 'undefined') ? 'success' : type
        toastr.options = {
            // "closeButton": false,
            // "debug": false,
            // "newestOnTop": false,
            // "progressBar": false,
            // "positionClass": "toast-top-right",
            // "preventDuplicates": false,
            // "showDuration": "300",
            // "hideDuration": "1000",
            // "timeOut": "5000",
            // "extendedTimeOut": "1000",
            // "showEasing": "swing",
            // "hideEasing": "linear",
            // "showMethod": "fadeIn",
            // "hideMethod": "fadeOut"
            "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-full-width",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
        }

        toastr[type](message)

    }
</script>