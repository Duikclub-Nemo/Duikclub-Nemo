{{-- email-alert.blade.php --}}
@props([
    'type' => 'info', // info, success, warning, danger
    'padding' => '16px',
    'borderRadius' => '4px',
    'marginBottom' => '25px'
])

@php
    $colors = [
        'info' => ['bg' => '#e3f2fd', 'border' => '#2196F3', 'text' => '#0c5460'],
        'success' => ['bg' => '#d4edda', 'border' => '#28a745', 'text' => '#155724'],
        'warning' => ['bg' => '#fff3cd', 'border' => '#ffc107', 'text' => '#856404'],
        'danger' => ['bg' => '#f8d7da', 'border' => '#dc3545', 'text' => '#721c24'],
    ];

    $bgColor = $colors[$type]['bg'];
    $borderColor = $colors[$type]['border'];
    $textColor = $colors[$type]['text'];
@endphp

<table width="100%" border="0" role="presentation"  cellpadding="0" cellspacing="0" style="margin-bottom: {{ $marginBottom }};">
    <tr>
        <td>
            <div style="background-color: {{ $bgColor }}; border-left: 4px solid {{ $borderColor }}; padding: {{ $padding }}; border-radius: {{ $borderRadius }};">
                <p style="color: {{ $textColor }}; font-size: 16px; line-height: 1.5em; margin: 0;">
                    {{ $slot }}
                </p>
            </div>
        </td>
    </tr>
</table>
