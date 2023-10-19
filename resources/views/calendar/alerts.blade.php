@if(count($class->student->repositions))
<div class="alert list-group-item-warning mb-1 p-2">
    <strong>
        <i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>
        Reposições não agendadas!
    </strong>
</div>
@endif

@if($class->student->installmentsToPay->count())
<div class="alert list-group-item-danger mb-1 p-2">
    <strong>
        <i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>
        Pagamentos a realizar!
    </strong>
</div>
@endif

@if($class->registration->daysToRenew <= 3) 
<div class="alert list-group-item-info mb-1 p-2">
    <strong>
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        Matrícula {{ $class->registration->position }}. 
        <a class="text-dark" href="{{ route('student.registration.renew', [$class->student, $class->registration]) }}">Renovar</a>
    </strong>
</div>
@endif