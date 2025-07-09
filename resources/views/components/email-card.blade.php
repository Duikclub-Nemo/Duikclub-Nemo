{{-- email-card.blade.php --}}
@props([
    'bgColor' => '#ffffff',
    'borderColor' => '#e8e5ef',
    'borderRadius' => '8px',
    'padding' => '25px',
    'marginBottom' => '25px',
    'boxShadow' => '0 2px 3px rgba(0, 0, 0, 0.16)'
])

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: {{ $marginBottom }};">
    <tr>
        <td>
            <div style="background-color: {{ $bgColor }}; border: 1px solid {{ $borderColor }}; border-radius: {{ $borderRadius }}; padding: {{ $padding }}; box-shadow: {{ $boxShadow }};">
                {{ $slot }}
            </div>
        </td>
    </tr>
</table>
