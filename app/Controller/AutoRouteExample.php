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

use App\Response;
use ViSwoole\HttpServer\Contract\ResponseInterface;
use ViSwoole\HttpServer\Router\Annotation\AutoRouteController;
use ViSwoole\HttpServer\Router\Annotation\RouteMapping;

#[AutoRouteController]
class AutoRouteExample
{
  public function example1(Response $response): ResponseInterface
  {
    return $response->setContentType('text/html')
                    ->setContent('<h1>自动路由注解示例:/AutoRouteExample/example1</h1>');
  }

  #[RouteMapping('/diy')]
  public function example2(Response $response): ResponseInterface
  {
    return $response->setContentType('text/html')
                    ->setContent('<h1>自动路由注解示例,自定义路径:/AutoRouteExample/diy</h1>');
  }
}
