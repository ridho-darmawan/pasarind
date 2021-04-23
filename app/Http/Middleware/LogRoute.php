<?php

namespace App\Http\Middleware;

use Closure;
use Egulias\EmailValidator\Warning\Warning;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */ 




    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $dt = [
            'IP_ADDRESS'=> $_SERVER["REMOTE_ADDR"],
            'URI'=>$request->getUri(),
            'METHOD'=>$request->getMethod(),
            'DATA_LAMA'=>$request['log_data_lama'],
            'DATA_BARU' => $request['log_data_baru'],
            'BROWSER'=>$request->header('User-Agent'),
            'user'=>$request->auth
        ];
        $log = new Logger('my_loger');
        $log -> pushHandler(new StreamHandler(storage_path("/logs/".date('Y')."/".date('F')."/info/".date('d-m-Y')."-info.log")))->info(json_encode($dt));

        // $log -> pushHandler(new StreamHandler(storage_path("/logs/".date('Y')."/".date('F')."/info/".date('d-m-Y')."-ridho.log"),Logger::DEBUG));
        // $log->DEBUG('Bar');


        
        
        return $response;
    }
}
