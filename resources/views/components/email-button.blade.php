{{-- email-button.blade.php --}}
@props([
    'url',
    'color' => '#ea580c',
    'textColor' => '#ffffff',
    'align' => 'center',
    'width' => '200px',
    'padding' => '12px 24px'
])

<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}" style="padding: 0px 0 30px;">
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $url }}" style="height:40px;v-text-anchor:middle;width:{{ $width }};" arcsize="10%" stroke="f" fillcolor="{{ $color }}">
                <w:anchorlock/>
                <center style="color:{{ $textColor }};font-family:sans-serif;font-size:16px;font-weight:bold;">{{ $slot }}</center>
            </v:roundrect>
            <![endif]-->
            <!--[if !mso]><!-->
            <a href="{{ $url }}" target="_blank" style="display: inline-block; min-width: {{ $width }}; color: {{ $textColor }}; background-color: {{ $color }}; border: solid 1px {{ $color }}; border-radius: 4px; padding: {{ $padding }}; font-size: 16px; font-weight: 600; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);">
                {{ $slot }}
            </a>
            <!--<![endif]-->
        </td>
    </tr>
</table>
