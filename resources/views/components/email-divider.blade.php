{{-- email-divider.blade.php --}}
@props([
    'marginTop' => '25px',
    'marginBottom' => '25px',
    'borderColor' => '#edeff2',
    'borderWidth' => '1px',
    'borderStyle' => 'solid'
])

<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation" style="margin-top:{{ $marginTop }}; margin-bottom:{{ $marginBottom }};">
    <tr>
        <td style="border-top:{{ $borderWidth }} {{ $borderStyle }} {{ $borderColor }}; font-size:1px; line-height:1px;">&nbsp;</td>
    </tr>
</table>

