{{-- email-header.blade.php --}}
@props([
    'url' => config('app.url'),
    'logo' => config('app.url'). '/images/notification-logo.png',
    'companyName' => config('app.name')
])

<tr>
    <td align="center" style="padding: 25px 0 10px; text-align: center;">
        <a href="{{ $url }}" target="_blank" rel="noopener"
           style="font-size: 19px; font-weight: bold; text-decoration: none; color: #3d4852;">
            @if ($logo)
                <img width="100%" src="{{ $logo }}" alt="{{ $companyName }}"
                     style="border: 0; border-radius: 10px; max-width: 100%; height: auto;"/>
            @else
                {{ $companyName }}
            @endif
        </a>
    </td>
</tr>
