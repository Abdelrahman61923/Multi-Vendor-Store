@props(['label' => '', 'name', 'options' => [], 'selected' => false,
])

<label for="">{{ $label }}</label>

<select name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name),
    ]) }}>

    {{-- <option value="">Primary Category</option> --}}

    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $text }}
        </option>
    @endforeach
</select>
