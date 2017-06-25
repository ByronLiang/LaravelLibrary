<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="x5-page-mode" content="app"/>
        <meta name="browsermode" content="application">
        <meta name="description" content="">
        <meta name="format-detection" content="telephone=no" />
        <title>Wechat</title>

        <!-- 阿里iconfont在线链接 -->
        <link rel="stylesheet" href="//at.alicdn.com/t/font_iy91m8e0r2lz0k9.css">
        <link rel="stylesheet" href="{{ mix('/vue/css/app.css') }}">
    </head>
    <body>
        <div id="app"></div>
        <script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script src="{{ mix('/vue/js/manifest.js') }}"></script>
        <script src="{{ mix('/vue/js/vendor.js') }}"></script>
        <script src="{{ mix('/vue/js/app.js') }}"></script>
    </body>
</html>
