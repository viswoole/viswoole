<?php
/*
 *  +----------------------------------------------------------------------
 *  | Viswoole [基于swoole开发的高性能快速开发框架]
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2024 https://viswoole.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 *  +----------------------------------------------------------------------
 *  | Author: ZhuChongLin <8210856@qq.com>
 *  +----------------------------------------------------------------------
 */

declare (strict_types=1);

namespace App\Controller;

use App\Response;
use Viswoole\HttpServer\Contract\ResponseInterface;
use Viswoole\Router\Annotation\AutoRouteController;

/**
 * 示例
 */
#[AutoRouteController] class Example
{
  /**
   * 测试依赖注入
   *
   * @param \App\Interface\Example $info
   * @param Response $response
   * @return ResponseInterface
   */
  public static function test(
    \App\Interface\Example $info,
    Response               $response
  ): ResponseInterface
  {
    return $response->html('<h1>Hello ' . $info->name . '</h1>');
  }
}

