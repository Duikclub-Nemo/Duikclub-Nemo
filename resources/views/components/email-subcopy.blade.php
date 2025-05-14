{{-- email-subcopy.blade.php --}}
@props([
    'url' => null,
    'textColor' => '#6c757d',
    'linkColor' => '#3490dc'
])

<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #edeff2;">
    <tr>
        <td>
            <p style="font-size: 14px; color: {{ $textColor }};">
                {{ $slot }}
                @if($url)
                    <br><a href="{{ $url }}" style="color: {{ $linkColor }}; text-decoration: underline;">{{ $url }}</a>
                @endif
            </p>
        </td>
    </tr>
</table>
