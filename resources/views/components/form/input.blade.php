@props([
    'isInvalid' => ($errors->has(preg_replace(['/\\[/', '/\\]/'], ['.', ''], $attributes['name']))) ? 'is-invalid' : null,
    'request_name' =>preg_replace(['/\\[/', '/\\]/'], ['.', ''], $attributes['name'])
])


<input {{ $attributes->merge(['class' => 'form-control ' . $isInvalid]) }} $disabled >
<x-form.invalid-feedback>{{ $errors->first($request_name) }}</x-form.invalid-feedback>


