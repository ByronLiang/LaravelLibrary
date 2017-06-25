<?php

namespace App\Services;

use Log;
use Config;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

class WechatService
{
    private $app;

    public function __construct()
    {
        $cfg = Config::get('services.wechat');
        $config = [
            'debug' => $cfg['debug'],
            'app_id' => $cfg['appid'],
            'secret' => $cfg['appsecret'],
            'log' => [
                'level' => 'debug',
                'file' => storage_path('logs/wechat-'.date('Y-m-d').'.log'),
            ],
            'oauth' => [
                'scopes' => ['snsapi_userinfo'],
                // 'callback' => action('WechatController@getOauth'),
            ],
            'payment' => [
                'merchant_id' => $cfg['merchantid'],
                'key' => $cfg['paykey'],
                'cert_path' => $cfg['paycertpath'],
                'key_path' => $cfg['paykeypath'],
            ],
            'guzzle' => [
                'timeout' => 60, // 超时时间（秒）
            ],
        ];
        $this->app = new Application($config);
    }

    public function getApplication()
    {
        return $this->app;
    }

    public function oauthRedirect()
    {
        return $this->app->oauth->redirect();
    }

    public function oauthUser()
    {
        return $this->app->oauth->user();
    }

    public function jsSdkConfig()
    {
        return $this->app->js->config([
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'hideAllNonBaseMenuItem',
            'showMenuItems',
        ]);
    }

    public function configForPayment(array $data)
    {
        $order = new Order($data);
        $result = $this->app->payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            return $this->app->payment->configForPayment($result->prepay_id);
        } else {
            Log::error('wechat config payment fail: '.json_encode($result));
        }
    }

    public function queryPayment($out_trade_no)
    {
        $result = $this->app->payment->query($out_trade_no);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            return $result;
        } else {
            Log::error('wechat query payment fail: '.json_encode($result));
        }
    }

    public function isSuccessPayment($result)
    {
        return $result->trade_state == 'SUCCESS';
    }

    public function refundPayment($out_trade_no, $refund_no, $total_fee)
    {
        $result = $this->app->payment->refund($out_trade_no, $refund_no, $total_fee);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            return $result;
        } else {
            Log::error('wechat refund fail: '.json_encode($result));
        }
    }
}
