@props([
    'borderColor' => '#e8e5ef',
    'textAlign' => 'left',
    'cellPadding' => '10px',
    'width' => '100%',
    'fontSize' => '16px',
    'lineHeight' => '1.5em'
])

<div style="margin-top: 25px; margin-bottom: 25px;">
    <table width="{{ $width }}" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse: collapse; font-size: {{ $fontSize }}; line-height: {{ $lineHeight }};">
        {{ $slot }}
    </table>
</div>
