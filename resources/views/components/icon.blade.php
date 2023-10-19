
@props(['_icon' => [
    'new'  => 'fa fa-plus-circle',
    'save' => 'fa fa-check-circle',
    'back' => 'fa fa-chevron-circle-left',
    'edit' => 'fas fa-pencil-alt',
    'delete' => 'fas fa-trash-alt',
    'close' => 'fa fa-times',
    'config' => 'fa fa-cog'
]])


<i class="{{ $_icon[$icon] ?? '' }}" aria-hidden="true"></i> {{ $slot}}


