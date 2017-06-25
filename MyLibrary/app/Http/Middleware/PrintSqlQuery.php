<?php

namespace App\Http\Middleware;

use DB;
use Log;
use Closure;
use Carbon\Carbon;

class PrintSqlQuery
{
    public function handle($request, Closure $next)
    {
        $printSqlLog = env('PRINT_SQL_LOG');
        if ($printSqlLog === true) {
            DB::connection()->enableQueryLog();
            DB::connection()->flushQueryLog();
        }

        $response = $next($request);

        if ($printSqlLog === true) {
            $this->printSqlLog($request);
        }

        return $response;
    }

    private function queryValueToString($val)
    {
        if ($val instanceof Carbon) {
            $val = (string) $val;
        }
        if (is_string($val)) {
            return "'{$val}'";
        } elseif (is_bool($val)) {
            return (string) (int) $val;
        } else {
            return (string) $val;
        }
    }

    private function printSqlLog($request)
    {
        $path = $request->path();
        $queries = DB::getQueryLog();
        $time = 0;
        foreach ($queries as $key => $query) {
            $sql = $query['query'];
            foreach ($query['bindings'] as $val) {
                $sql = preg_replace('/\?/', $this->queryValueToString($val), $sql, 1);
            }
            $time += $query['time'];
            $info = '['.($key + 1).']['.$path.'] '.$sql.' ['.$query['time'].'ms]';
            error_log($info);
            Log::info($info);
        }
        $total = '['.$path.'] total time '.$time.'ms';
        error_log($total);
        Log::info($total);
    }
}
