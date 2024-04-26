<?php
// +----------------------------------------------------------------------
// | 全局中间件定义
// +----------------------------------------------------------------------

declare (strict_types=1);

use App\Middlewares\AllowCrossDomain;
use ViSwoole\HttpServer\Middleware;

// 该中间件用于解决跨域问题
Middleware::add(AllowCrossDomain::class);
