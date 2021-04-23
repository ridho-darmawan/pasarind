<?php

namespace App\Http\Middleware;

use Closure;
use Egulias\EmailValidator\Warning\Warning;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;

use Monolog\Formatter\LineFormatter as FormatterLineFormatter;

class Loggi
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
        $d  =   date('Y-m-d');
        // $handlers       = [];
        $handlers = $next($request);
        $handler = new Logger('sd');
        $handlers ->  pushHandler (new StreamHandler(storage_path("logs/ln_info_{$d}.log"), Logger::INFO))->json_encode($d)->setFormatter(new LineFormatter(null, null, true, true));
        // $handlers[]     =   (new StreamHandler(storage_path("logs/ln_warning_{$d}.log"), Logger::WARNING))->setFormatter(new LineFormatter(null, null, true, true));
        // $handlers[]     =   (new StreamHandler(storage_path("logs/ln_error_{$d}.log"), Logger::ERROR))->setFormatter(new LineFormatter(null, null, true, true));
        // $handlers[]     =   (new StreamHandler(storage_path("logs/ln_critical_{$d}.log"), Logger::CRITICAL))->setFormatter(new LineFormatter(null, null, true, true));
        
        return $handlers;           
    }
}
