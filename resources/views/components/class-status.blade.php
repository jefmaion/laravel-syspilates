@props([
    '_status' => [
        'PP' => ['class' => 'olive', 'icon' => 'fa fa-check'],
        'FF' => ['class' => 'custom-danger', 'icon' => 'fa fa-times'],
        'FJ' => ['class' => 'custom-warning', 'icon' => 'fa fa-times'],
        'CC' => ['class' => 'custom-secondary', 'icon' => 'fa fa-times'],
        ''   => ['class' => 'custom-primary', 'icon' => 'fas fa-check'],
    ]
])

 <span class="badge badge-pill text-white bg-{{ $_status[$attributes['status']]['class'] }}">
        <i class="{{ $_status[$attributes['status']]['icon'] }} fa-sm" aria-hidden="true"></i>
        {{ $slot }}
    </span>

