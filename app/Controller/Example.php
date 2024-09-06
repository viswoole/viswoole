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

use App\Interface\UserInfoExample;
use App\Response;
use Viswoole\HttpServer\AutoInject\File;
use Viswoole\HttpServer\AutoInject\Header;
use Viswoole\HttpServer\Contract\ResponseInterface;
use Viswoole\HttpServer\Validate\FileRule;
use Viswoole\HttpServer\Validate\HeaderRule;
use Viswoole\Router\Annotation\AutoRouteController;
use Viswoole\Router\Annotation\RouteMapping;
use Viswoole\Router\RouterManager;

/**
 * 示例
 */
#[AutoRouteController] class Example
{
  /**
   * 测试类用于依赖注入校验
   *
   * @param UserInfoExample|null $info
   * @param Response $response
   * @return ResponseInterface
   */
  public static function hello(
    ?UserInfoExample $info,
    Response         $response
  ): ResponseInterface
  {
    return $response->html('<h1>Hello ' . $info?->name . '</h1>');
  }

  /**
   * 测试上传文件于自动注入
   *
   * @param File $file 上传的文件
   * @param Response $response
   * @return ResponseInterface
   */
  public static function upload(
    #[FileRule('file', 'image/png')] File $file,
    Response                              $response
  ): ResponseInterface
  {
    $count = $file->count();
    return $response->html("<h1>共上传了 $count 个文件,name $file->name</h1>");
  }

  /**
   * 测试请求头验证和注入
   *
   * @param Header $header
   * @return string
   */
  public static function header(#[HeaderRule('accept')] Header $header): string
  {
    return $header->value;
  }

  /**
   * 获取API文档
   *
   * @param RouterManager $router
   * @return array
   */
  public static function api(RouterManager $router): array
  {
    return $router->getApiShape();
  }

  /**
   * 动态路径匹配
   *
   * @param int|null $id
   * @param ResponseInterface $response
   * @return ResponseInterface
   */
  #[RouteMapping('dynamic/{id?}')] public static function dynamic(
    ?int              $id,
    ResponseInterface $response
  ): ResponseInterface
  {
    return $response->html("<h1>可选动态参数匹配到：$id</h1>");
  }
}

