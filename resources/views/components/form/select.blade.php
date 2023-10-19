
@props([
    'options' => [],
    'isInvalid' => ($errors->has(preg_replace(['/\\[/', '/\\]/'], ['.', ''], $attributes['name']))) ? 'is-invalid' : null,
    'request_name' =>preg_replace(['/\\[/', '/\\]/'], ['.', ''], $attributes['name'])
])

<select {{ $attributes->merge(['class' => 'form-control w-1s00 '. $isInvalid]) }} >
    <option value=""></option>
    @foreach($options as $key => $label)
    <option value="{{ $key }}" {{ $isSelected($value, $key)  }} >{{ $label }}</option>
    @endforeach
</select>
<x-form.invalid-feedback>{{ $errors->first($request_name) }}</x-form.invalid-feedback>