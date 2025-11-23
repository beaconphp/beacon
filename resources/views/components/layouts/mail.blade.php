<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beacon</title>
</head>
<body style="color: #2a2627; background-color: #f5f4f4; margin: 0; padding: 0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="color: #2a2627; font-size: 16px; width: 500px; margin: 0 auto;" width="500">
                <tr>
                    <td style="padding: 35px 30px 20px; text-align: center">
                        <x-logo color style="height: 30px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding: 30px; color: #2a2627; text-align: left; background-color: #ffffff;">{{ $slot }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 30px 30px 40px; color: #9f9fa9; font-size: 12px; text-align: center">
                        <p style="color: #9f9fa9;">Powered by Beacon</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>