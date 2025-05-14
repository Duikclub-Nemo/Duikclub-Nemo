{{-- email-heading.blade.php --}}
@props([
    'level' => '1',
    'color' => '#3d4852',
    'align' => 'left',
    'marginTop' => '0',
    'marginBottom' => '25px'
])

@php
    $fontSize = match($level) {
        '1' => '24px',
        '2' => '20px',
        '3' => '18px',
        '4' => '16px',
        default => '24px'
    };

    $fontWeight = match($level) {
        '1', '2' => 'bold',
        default => 'semibold'
    };
@endphp

<h{{ $level }} style="color: {{ $color }}; font-size: {{ $fontSize }}; font-weight: {{ $fontWeight }}; margin-top: {{ $marginTop }};
    margin-bottom: {{ $marginBottom }}; text-align: {{ $align }};">
    {{ $slot }}
</h{{ $level }}>
