{{-- email-panel.blade.php --}}
@props([
    'bgColor' => '#f1f5f8',
    'padding' => '16px'
])

<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation" style="margin-bottom:35px;">
    <tr>
        <td bgcolor="{{ $bgColor }}" style="padding:{{ $padding }}; border-radius:3px;">
            <p style="margin:0; padding:0; color:#3d4852; font-size:16px; line-height:1.5em; mso-line-height-rule:exactly;">
                {{ $slot }}
            </p>
        </td>
    </tr>
</table>
