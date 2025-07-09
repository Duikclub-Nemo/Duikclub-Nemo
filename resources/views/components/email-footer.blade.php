{{-- email-footer.blade.php --}}
@props([
    'companyName' => config('app.name'),
    'companyAddress' => null,
    'unsubscribeUrl' => null,
    'textColor' => '#b0adc5'
])

<tr>
    <td>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation">
            <tr>
                <td style="padding: 35px; text-align: center;">
                    <p style="color: {{ $textColor }}; font-size: 12px; text-align: center; margin-top: 0; margin-bottom: 8px;">© {{ date('Y') }} {{ $companyName }}. Alle rechten voorbehouden.</p>
                    @if($companyAddress)
                        <p style="color: {{ $textColor }}; font-size: 12px; text-align: center; margin-top: 0; margin-bottom: 8px;">
                            {{ $companyName }}<br>
                            {{ $companyAddress }}
                        </p>
                    @endif
                    @if($unsubscribeUrl)
                        <p style="color: {{ $textColor }}; font-size: 12px; text-align: center; margin-top: 0;">
                            <a href="{{ $unsubscribeUrl }}" target="_blank" rel="noopener" style="color: {{ $textColor }}; text-decoration: underline;">Uitschrijven</a>
                        </p>
                    @endif

                    {{ $slot ?? '' }}
                </td>
            </tr>
        </table>
    </td>
</tr>
