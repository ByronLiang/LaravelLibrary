<?php

return [

    'leancloud' => [
        'url' => env('LEANCLOUD_URL'),
        'appid' => env('LEANCLOUD_APP_ID'),
        'appkey' => env('LEANCLOUD_APP_KEY'),
        'masterkey' => env('LEANCLOUD_MASTER_KEY'),
        'prod' => env('LEANCLOUD_PROD'),
        // 甘果Android部专用
        'action' => env('LEANCLOUD_ACTION'),
    ],

    'qiniu' => [
        'accesskey' => env('QINIU_ACCESS_KEY'),
        'secretkey' => env('QINIU_SECRET_KEY'),
        'domain' => env('QINIU_DOMAIN'),
        'bucket' => env('QINIU_BUCKET'),
        'uploadUrl' => env('QINIU_UPLOAD_URL'),
    ],

    'wechat' => [
        'debug' => env('WECHAT_DEBUG'),
        'appid' => env('WECHAT_APP_ID'),
        'appsecret' => env('WECHAT_APP_SECRET'),
        'merchantid' => env('WECHAT_MERCHANT_ID'),
        'paykey' => env('WECHAT_PAY_KEY'),
        'paycertpath' => env('WECHAT_PAY_CERT_PATH'),
        'paykeypath' => env('WECHAT_PAY_KEY_PATH'),
    ],

];
