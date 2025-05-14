{{-- email-table-row.blade.php --}}
@props([
    'cellPadding' => '10px',
    'borderColor' => '#e8e5ef',
    'backgroundColor' => '#ffffff',
    'textColor' => '#3d4852'
])

<tr style="background-color: {{ $backgroundColor }};">
    {{ $slot }}
</tr>
