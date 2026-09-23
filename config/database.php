<?php
// +----------------------------------------------------------------------
// | 数据库配置
// +----------------------------------------------------------------------

declare (strict_types=1);

use Viswoole\Database\Channel\PDO\PDOChannel;
use Viswoole\Database\Facade\Db;

return [
  // 默认通道
  'default' => env('DATABASE_DEFAULT', 'default'),
  // 是否开启调试模式
  'debug' => env('app_debug', true),
  // 调试信息保存方式，1 保存到控制台，2 保存到日志文件，3 同时保存到控制台和日志文件
  'info_save_manner' => Db::DEBUG_SAVE_CONSOLE | Db::DEBUG_SAVE_LOGGER,
  // 全局查询监听器（仅支持在此配置注册，全局唯一，未配置零开销）：
  // 每条 SQL 执行后触发，经容器依赖注入调用，支持闭包、函数名、
  // '类名::静态方法名'、[类名/对象, 方法名] 形态（非静态方法须用数组形态），
  // 签名 fn(RunInfo $info, ...容器依赖): void——RunInfo 按位置注入首参：
  // $info->channel 通道名；$info->route 读写路由 read|write（区分主从库）；
  // $info->time['cost_time_ms'] 耗时——如慢查询过滤等逻辑在监听器内自行实现
  // 'listen' => function (Viswoole\Database\Query\RunInfo $info): void {
  //   if ($info->time['cost_time_ms'] >= 500) { /* 告警/记录慢查询 */ }
  // },
  // 通道列表
  'channels' => [
    'default' => [
      // 驱动类，必须继承 Viswoole\Database\Channel
      'driver' => PDOChannel::class,
      // PDOChannel 通道构造参数
      'options' => [
        'host' => env('DATABASE_HOST', '127.0.0.1'),
        'port' => (int)env('DATABASE_PORT', 3306),
        'database' => env('DATABASE_NAME', ''),
        'username' => env('DATABASE_USER', 'root'),
        'password' => env('DATABASE_PASSWORD', '123456')
      ]
    ]
  ]
];
