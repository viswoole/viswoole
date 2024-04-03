<?php
// +----------------------------------------------------------------------
// | swoole服务配置文件
// +----------------------------------------------------------------------

declare (strict_types=1);

return [
  'default_start_server' => env('server', 'http'),
  'default_pid_store_dir' => BASE_PATH . '/runtime/server_pid',
];
