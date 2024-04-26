<?php
/*
 *  +----------------------------------------------------------------------
 *  | ViSwoole [基于swoole开发的高性能快速开发框架]
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2024
 *  +----------------------------------------------------------------------
 *  | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 *  +----------------------------------------------------------------------
 *  | Author: ZhuChongLin <8210856@qq.com>
 *  +----------------------------------------------------------------------
 */

declare (strict_types=1);

namespace App\Controller;

use Swoole\Server as SwooleServer;
use ViSwoole\Core\Exception\TaskException;
use ViSwoole\Core\Server\Task;
use ViSwoole\HttpServer\Router\Annotation\RouteController;
use ViSwoole\HttpServer\Router\Annotation\RouteMapping;

#[RouteController('')]
class TaskExample
{
  #[RouteMapping]
  public function task(): string
  {
    try {
      $task_id = Task::push('test', 'hello task', callback: function (
        SwooleServer $server, int $task_id, mixed $data
      ) {
        var_dump($data);
      });
    } catch (TaskException $e) {
      // 如果任务投递失败会抛出一个TaskException异常
      return $e->getMessage();
    }
    return '投递了一个任务:' . $task_id;
  }
}
