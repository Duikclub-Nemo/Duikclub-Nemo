{{-- email-table-cell.blade.php --}}
@props([
    'cellPadding' => '10px',
    'borderColor' => '#e8e5ef',
    'textColor' => '#3d4852',
    'align' => 'left'
])

<td style="padding: {{ $cellPadding }}; border: 1px solid {{ $borderColor }}; color: {{ $textColor }}; text-align: {{ $align }};">
    {{ $slot }}
</td>
