<?php
// +----------------------------------------------------------------------
// | 全局中间件定义
// +----------------------------------------------------------------------

declare (strict_types=1);

use App\Middlewares\AllowCrossDomain;
use ViSwoole\HttpServer\Middleware;

Middleware::add(AllowCrossDomain::class);
