<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>
        @if ($formType === 'quote')
            Запрос ценового предложения
        @elseif ($formType === 'newsletter')
            Новая подписка на рассылку
        @else
            Сообщение с сайта
        @endif
    </title>
</head>
<body style="margin:0;padding:24px;background:#f4f7f9;color:#0b283b;font-family:Arial,sans-serif;">
<div style="max-width:680px;margin:0 auto;padding:28px;background:#ffffff;border-radius:12px;">
    <h1 style="margin:0 0 24px;font-size:22px;">
        @if ($formType === 'quote')
            Запрос ценового предложения
        @elseif ($formType === 'newsletter')
            Новая подписка на рассылку
        @else
            Новое сообщение с сайта
        @endif
    </h1>

    @if ($formType === 'newsletter')
        <p style="margin:0;line-height:1.55;">
            Пользователь <a href="mailto:{{ $submission['email'] }}">{{ $submission['email'] }}</a>
            согласился получать информационную рассылку.
        </p>
    @else
        <table style="width:100%;border-collapse:collapse;">
            <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Имя</td><td style="padding:7px 0;">{{ $submission['firstName'] }} {{ $submission['lastName'] }}</td></tr>
            <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Email</td><td style="padding:7px 0;"><a href="mailto:{{ $submission['email'] }}">{{ $submission['email'] }}</a></td></tr>
            <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Телефон</td><td style="padding:7px 0;">{{ $submission['phone'] }}</td></tr>
            <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Компания</td><td style="padding:7px 0;">{{ $submission['companyName'] }}</td></tr>
            @if ($formType === 'quote')
                <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Страна</td><td style="padding:7px 0;">{{ $submission['country'] }}</td></tr>
                <tr><td style="padding:7px 12px 7px 0;font-weight:bold;">Тип продукта</td><td style="padding:7px 0;">{{ $submission['productType'] }}</td></tr>
            @endif
        </table>

        <h2 style="margin:26px 0 10px;font-size:17px;">Сообщение</h2>
        <div style="white-space:pre-wrap;line-height:1.55;">{{ $submission['message'] }}</div>
    @endif
</div>
</body>
</html>
