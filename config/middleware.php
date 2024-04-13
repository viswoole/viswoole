<?php
// +----------------------------------------------------------------------
// | 全局中间件
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\Core\Middleware\AllowCrossDomain;

return [
  'http' => [
    // 跨域中间件
    AllowCrossDomain::class
  ]
];
