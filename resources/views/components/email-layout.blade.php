{{-- email-layout.blade.php --}}
@props([
    'title' => config('app.name'),
    'header' => null,
    'footer' => null,
    'preheader' => ''
])

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title ?? config('app.name') }}</title>
    <!--[if mso]>
    <style type="text/css">
        table {border-collapse: collapse;border-spacing: 0;margin: 0;}
        div, td {padding: 0;}
        div {margin: 0 !important;}
        img { -ms-interpolation-mode:bicubic; }
    </style>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #3d4852; background-color: #f8fafc; -webkit-text-size-adjust: none; line-height: 1.4; -webkit-font-smoothing: antialiased;" role="presentation">
@if(!empty($preheader))
    <span style="display:none; font-size:1px; line-height:1px; color:#ffffff; max-height:0; max-width:0; opacity:0; overflow:hidden;">{{ $preheader }}</span>
@endif
<!-- Begin Wrapper -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc;">
    <tr>
        <td align="center" style="padding: 10px;">
            <table width="600px" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px;">
                <!-- Logo Header -->
                {{ $header ?? '' }}

                <!-- Email Body -->
                <tr>
                    <td style="background-color: #ffffff; border-radius: 10px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td style="padding: 35px;">
                                    {{ $slot }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                {{ $footer ?? '' }}
            </table>
        </td>
    </tr>
</table>
</body>
</html>
