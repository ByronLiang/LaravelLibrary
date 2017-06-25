<?php

namespace App\Services;

use Log;
use Config;
use GuzzleHttp\Client;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuService
{
    private $accessKey;
    private $secretKey;
    private $bucket;
    private $domain;
    private $uploadUrl;

    public function __construct()
    {
        $qiniu = Config::get('services.qiniu');
        $this->accessKey = $qiniu['accesskey'];
        $this->secretKey = $qiniu['secretkey'];
        $this->bucket = $qiniu['bucket'];
        $this->domain = $qiniu['domain'];
        $this->uploadUrl = $qiniu['uploadUrl'];
    }

    public function getToken()
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucket, null, 60 * 60);
        $domain = $this->domain;
        $uploadUrl = $this->uploadUrl;

        return compact('token', 'domain', 'uploadUrl');
    }

    public function uploadUrl($url)
    {
        $client = new Client(['timeout' => 120]);
        $response = $client->get($url);
        $token = $this->getToken()['token'];
        $uploader = new UploadManager();
        $result = $uploader->put($token, null, $response->getBody());
        if ($result[1]) {
            Log::error('QiniuService upload url error, url: '.$url.', '.$result[1]);
        }

        return $result[0]['key'];
    }

    public function upload($file)
    {
        $token = $this->getToken()['token'];
        $uploader = new UploadManager();
        $result = $uploader->putFile($token, null, $file);
        if ($result[1]) {
            Log::error('QiniuService upload error, '.$result[1]);
        }

        return $result[0]['key'];
    }
}
