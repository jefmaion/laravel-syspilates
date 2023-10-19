@props([
    '_status' => [
        'PP' => ['class' => 'success', 'icon' => 'fa fa-check'],
        'FF' => ['class' => 'danger', 'icon' => 'fa fa-times'],
        'FJ' => ['class' => 'warning', 'icon' => 'fa fa-times'],
        'CC' => ['class' => 'secondary', 'icon' => 'fa fa-times'],
        ''   => ['class' => 'primary', 'icon' => 'fas fa-check'],
    ]
])

 <span class="badge badge-pill text-white bg-custom-{{ $_status[$attributes['status']]['class'] }}">
        <i class="{{ $_status[$attributes['status']]['icon'] }} fa-sm" aria-hidden="true"></i>
        {{ $slot }}
    </span>

