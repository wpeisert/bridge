{{--
$edit: isset && true - edit, otherwise - show value
field:
$name => '... name ...',
$value => value,
$defaultValue =>
$maxValue => maximum value
$minValue => manimum value  // not required, default: 0
]
--}}

@php
    $defaultValue = $defaultValue ?? 0;
    $minValue = $minValue ?? 0;
    $value = $value ?? $defaultValue;
@endphp

@if (isset($edit) && $edit)
<select name="{{ $name }}">
    @for ($iter = $minValue; $iter <= $maxValue; ++$iter)
        <option value="{{ $iter }}" @selected($iter === $value)>
            {{ $iter !== $defaultValue ? $iter : '' }}
        </option>
    @endfor
</select>
@else
    {{ $value !== $defaultValue ? $value : '' }}
@endif



