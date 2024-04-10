<?php
// +----------------------------------------------------------------------
// | Redis配置
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\Cache\RedisConfig;

return [
  'default' => 'redis',
  'channels' => [
    'redis' => new RedisConfig(host: 'viswoole-redis-1')
  ]
];
