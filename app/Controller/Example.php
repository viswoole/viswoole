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
use Viswoole\HttpServer\AutoInject\File;
use Viswoole\HttpServer\Contract\ResponseInterface;
use Viswoole\HttpServer\Validate\FileRule;
use Viswoole\Router\Annotation\AutoRouteController;

/**
 * 示例
 */
#[AutoRouteController] class Example
{
  /**
   * 测试类用于依赖注入校验
   *
   * @param \App\Interface\Example $info
   * @param Response $response
   * @return ResponseInterface
   */
  public static function hello(
    \App\Interface\Example $info,
    Response               $response
  ): ResponseInterface
  {
    return $response->html('<h1>Hello ' . $info->name . '</h1>');
  }

  /**
   * @param File $file 上传的文件
   * @param Response $response
   * @return bool
   */
  public static function upload(
    #[FileRule('file', 'image/png')] File $file,
    Response                              $response
  )
  {
    return $response->sendfile($file->list[0]->tmp_path);
  }
}

