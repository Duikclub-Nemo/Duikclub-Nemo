{{-- email-table-header.blade.php --}}
@props([
    'columns' => [],
    'backgroundColor' => '#f8fafc',
    'textColor' => '#3d4852',
    'fontWeight' => 'bold',
    'cellPadding' => '10px',
    'borderColor' => '#e8e5ef'
])

<tr>
    @foreach($columns as $column)
        <th style="padding: {{ $cellPadding }}; background-color: {{ $backgroundColor }}; color: {{ $textColor }}; font-weight: {{ $fontWeight }}; text-align: left; border: 1px solid {{ $borderColor }};">
            {{ $column }}
        </th>
    @endforeach
</tr>
