

<div id="modal-container"></div>
@section('scripts')

@parent
<script>
         function receive(id) {
            $.ajax({
                type: "get",
                url: '/receive/'+id+'/pay',
                success: function (response) {
                    $('#modal-container').html(response);
                    $('#modal-container .modal').modal('show');
                }
            });
        }
</script>
@endsection