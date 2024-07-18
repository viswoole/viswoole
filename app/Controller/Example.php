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

use App\BaseController;
use ViSwoole\Core\Router;
use ViSwoole\Core\Router\Annotation\AutoRouteController;

class Userinfo
{

}

#[AutoRouteController('', describe: '示例022')]
class Example extends BaseController
{
  public static function test(?Userinfo $info): array
  {
    return Router::collector()->getApiDoc();
  }
}