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
use Viswoole\HttpServer\AutoInject\InjectFile;
use Viswoole\HttpServer\AutoInject\InjectGet;
use Viswoole\HttpServer\AutoInject\InjectHeader;
use Viswoole\HttpServer\AutoInject\InjectPost;
use Viswoole\HttpServer\Contract\ResponseInterface;
use Viswoole\HttpServer\Message\UploadedFile;
use Viswoole\HttpServer\Validate\FileRule;
use Viswoole\Router\Annotation\AutoRouteController;
use Viswoole\Router\Annotation\RouteMapping;
use Viswoole\Router\RouterManager;

/**
 * 示例
 */
#[AutoRouteController(options: ['sort' => 999])]
class Example
{
  /**
   * 测试类用于依赖注入校验
   *
   * @access public
   * @param string $name
   * @return string
   */
  public static function hello(#[InjectGet] string $name): string
  {
    return $name;
  }

  /**
   * 测试上传文件于自动注入
   *
   * @access public
   * @param UploadedFile $file 上传的文件
   * @param Response $response
   * @return ResponseInterface
   */
  public static function upload(
    #[FileRule('image/png'), InjectFile] UploadedFile $file,
    Response                                          $response
  ): ResponseInterface
  {
    // 获取上传文件名称
    $name = $file->getClientFilename();
    // 上传文件类型
    // $type = $file->getClientMediaType();
    return $response->html("<h1>共上传了 $name 文件</h1>");
  }

  /**
   * 获取请求头用例
   *
   * @param string $accept
   * @return string
   */
  public static function header(#[InjectHeader] string $accept): string
  {
    return $accept;
  }

  /**
   * 获取API文档
   *
   * @param RouterManager $router
   * @return array
   */
  #[Response\Success(['test|测试' => 1])]
  public static function api(RouterManager $router): array
  {
    return $router->getApiShape();
  }

  /**
   * 动态路径匹配
   *
   * @access public
   * @param int|null $id
   * @param ResponseInterface $response
   * @return ResponseInterface
   */
  #[RouteMapping('dynamic/{id?}')]
  public static function dynamic(
    #[InjectPost] ?int $id
  ): string
  {
    return "<h1>可选动态参数id匹配到：$id</h1>";
  }
}

