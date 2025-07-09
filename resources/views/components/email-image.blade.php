{{-- email-image.blade.php --}}
@props([
    'src',
    'alt' => '',
    'width' => null,
    'height' => null,
    'align' => 'center',
    'marginTop' => '20px',
    'marginBottom' => '20px',
    'borderRadius' => '0'
])

<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top: {{ $marginTop }}; margin-bottom: {{ $marginBottom }};">
    <tr>
        <td align="{{ $align }}">
            <img src="{{ $src }}"
                 alt="{{ $alt }}"
                 style="border: 0; {{ $width ? 'width: '.$width.';' : '' }} {{ $height ? 'height: '.$height.';' : '' }} max-width: 100%; border-radius: {{ $borderRadius }};"
            >
        </td>
    </tr>
</table>
