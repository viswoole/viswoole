<?php
// +----------------------------------------------------------------------
// | 任务注册
// | 示例1：\ViSwoole\Core\Server\Task::register('sendLoginCode', [sendCode::class,'login'])
// | 示例2：\ViSwoole\Core\Server\Task::registers('sendCode', sendCode::class)
// +----------------------------------------------------------------------

declare (strict_types=1);

use Swoole\Server;
use ViSwoole\Core\Server\Task;

Task::register('test', function (Server $server, Server\Task $task) {
  dump($task->data, 'test task data');
  $task->finish('test task finish');
});

