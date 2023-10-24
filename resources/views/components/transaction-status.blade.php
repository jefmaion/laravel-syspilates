
@php
$status =[
        1 => 'olive',
        4 => 'danger',
        2 => 'warning',
        3 => 'light border',
        0 => 'info',
    ]
@endphp
<span class="badge badge-pill bg-{{ $status[$attributes['status']] }}">{{ $slot  }}</span>