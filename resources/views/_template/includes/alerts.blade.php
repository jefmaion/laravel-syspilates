
@if ($message = Session::get('success'))
<div class="alert-message alert list-group-item-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
    <strong> <i class="fas fa-check-circle    "></i> {!! $message !!}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert-message alert list-group-item-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
    <strong> <i class="fas fa-times-circle    "></i> {!! $message !!}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert-message alert list-group-item-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {!! $message !!}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert-message alert list-group-item-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><i class="fas fa-exclamation-circle    "></i> {!! $message !!}</strong>
</div>
@endif

{{-- 
@if ($errors->any())
<div class="alert-message alert list-group-item-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>
        <i class="fas fa-exclamation-circle"></i> Ooops!</strong> Verifique os erros abaixo

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
 --}}
