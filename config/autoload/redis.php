<?php
// +----------------------------------------------------------------------
// | Redis配置
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\Cache\RedisConfig;

return [
  'default' => 'redis',
  'channels' => [
    'redis' => new RedisConfig(host: env('redis_host', '127.0.0.1'))
  ]
];
