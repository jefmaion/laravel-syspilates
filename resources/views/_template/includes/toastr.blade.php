
<script>

    @if($message = Session::get('info'))
        showAlert('{{ $message }}', 'info')
    @endif

    @if($message = Session::get('error'))
        showAlert('{{ $message }}', 'error')
    @endif

    @if($message = Session::get('warning'))
        showAlert('{{ $message }}', 'warning')
    @endif

    @if($message = Session::get('success'))
        showAlert('{{ $message }}', 'success')
    @endif

    function showAlert(message, type) {
        type = (typeof type   === 'undefined') ? 'success' : type
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
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