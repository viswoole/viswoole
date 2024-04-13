<?php
// +----------------------------------------------------------------------
// | 缓存配置
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\Cache\Cache;

return [
  // 默认通道
  'default' => env('cache.store', 'file'),
  // 通道列表
  'stores' => [
    'file' => [
      // 驱动类需继承\ViSwoole\Cache\Driver，
      // 或实现\ViSwoole\Cache\Contract\CacheDriverInterface接口。
      'driver' => Cache::DRIVER_FILE,
      // 配置选项，参考驱动类构造函数参数
      'options' => [
        'storage' => BASE_PATH . '/runtime/cache',
        'prefix' => '',
        'tag_store' => 'TAG_STORE',
        'expire' => 0
      ]
    ],
    'redis' => [
      'driver' => Cache::DRIVER_REDIS,
      'options' => [
        'channel_name' => null,
      ]
    ]
  ]
];
