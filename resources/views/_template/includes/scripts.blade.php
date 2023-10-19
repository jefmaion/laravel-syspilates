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