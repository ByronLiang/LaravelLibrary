<?php

namespace App\Http\Responses;

use Response;
use Illuminate\Support\Collection;

class JSendResponse
{
    const ERROR = 'error';
    const SUCCESS = 'success';

    protected $data;
    protected $status;
    protected $errorCode;
    protected $errorMessage;

    public function __construct($status, array $data = null, $errorMessage = null, $errorCode = null)
    {
        $this->data = $data;
        $this->status = $status;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }

    public static function success(array $data = null)
    {
        return new static(static::SUCCESS, $data);
    }

    public static function error($errorMessage, $errorCode = null, array $data = null)
    {
        return new static(static::ERROR, $data, $errorMessage, $errorCode);
    }

    public function toArray()
    {
        $arr = ['status' => $this->status];
        if ($this->status === self::SUCCESS) {
            $arr['data'] = empty($this->data) ? null : $this->data;
        } elseif ($this->status === self::ERROR) {
            $arr['message'] = (string) $this->errorMessage;
            if (! empty($this->errorCode)) {
                $arr['code'] = $this->errorCode;
            }
            if (! empty($this->data)) {
                $arr['data'] = $this->data;
            }
        }

        return $arr;
    }
}

class JSend
{
    private static function toString($data)
    {
        if (is_bool($data)) {
            return $data ? '1' : '0';
        } elseif (is_int($data) || is_float($data)) {
            return $data.'';
        } elseif (is_string($data)) {
            return $data;
        } elseif (is_null($data)) {
            return;
        } elseif ($data instanceof Collection) {
            return self::toString(
                $data->map(function ($item) {
                    return self::toString($item);
                })
                ->all()
            );
        } elseif (is_object($data)) {
            if (method_exists($data, 'toArray')) {
                return self::toString($data->toArray());
            } elseif (method_exists($data, 'getAttributes')) {
                return self::toString($data->getAttributes());
            } elseif (method_exists($data, '__toString')) {
                return $data->__toString();
            } elseif (get_class($data) === 'stdClass' && $data === new \stdClass()) {
                return;
            } else {
                return self::toString((array) $data);
            }
        } elseif (is_array($data)) {
            $output = [];
            foreach ($data as $key => $value) {
                $output[$key] = self::toString($value);
            }

            return $output;
        } else {
            return (string) $data;
        }
    }

    public static function success($data = null)
    {
        $success = JSendResponse::success(static::toString($data));

        return Response::json($success->toArray(), 200);
    }

    public static function error($errorMessage = null, $errorCode = null, $data = null)
    {
        $error = JSendResponse::error($errorMessage, $errorCode, static::toString($data));

        return Response::json($error->toArray(), 202);
    }
}
