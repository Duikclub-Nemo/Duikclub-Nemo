{{-- email-paragraph.blade.php --}}
@props([
    'color' => '#3d4852',
    'fontSize' => '16px',
    'lineHeight' => '1.5em',
    'align' => 'left',
    'marginTop' => '0',
    'marginBottom' => '25px'
])

<p style="color: {{ $color }}; font-size: {{ $fontSize }}; line-height: {{ $lineHeight }}; margin-top: {{ $marginTop }}; margin-bottom: {{ $marginBottom }}; text-align: {{ $align }}; mso-line-height-rule:exactly;">
    {{ $slot }}
</p>
