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

use App\Dto\UserInfo;
use App\Response;
use Viswoole\HttpServer\AutoInject\InjectFile;
use Viswoole\HttpServer\AutoInject\InjectGet;
use Viswoole\HttpServer\AutoInject\InjectHeader;
use Viswoole\HttpServer\AutoInject\InjectPost;
use Viswoole\HttpServer\Contract\ResponseInterface;
use Viswoole\HttpServer\Message\UploadedFile;
use Viswoole\HttpServer\Validate\FileRule;
use Viswoole\Router\Annotation\AutoController;
use Viswoole\Router\Annotation\RouteMapping;
use Viswoole\Router\Router;

/**
 * 示例
 */
#[AutoController(sort: 999)]
class Example
{
  /**
   * 获取api列表
   *
   * @param Router $router
   * @return array
   */
  public static function getApiList(Router $router): array
  {
    return $router->getApiList();
  }

  /**
   * 获取API接口详情，包含了参数、返回值等
   *
   * @param string $citeLink 路由完整引用链路
   * @param Router $router 路由管理器，自动注入
   * @return array
   */
  public static function getApiDetail(
    #[InjectGet] string $citeLink,
    Router              $router,
  ): array
  {
    return $router->getApiDetail($citeLink);
  }

  /**
   * 测试类用于依赖注入校验
   *
   * @access public
   * @param string $name 名称
   * @return string
   */
  public static function hello(#[InjectGet] string $name): string
  {
    return $name;
  }

  /**
   * 自动将json请求数据转换为对象
   *
   * @param UserInfo $userInfo
   * @return array
   */
  #[RouteMapping(method: 'POST')]
  public static function userInfo(#[InjectPost] UserInfo $userInfo): array
  {
    return ['name' => $userInfo->name, 'gender' => $userInfo->gender->name];
  }

  /**
   * 上传文件注入
   *
   * @access public
   * @param UploadedFile $file 上传的文件，必须为png图片
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
   * 动态路径匹配，与路径变量获取
   *
   * @access public
   * @param int|null $id
   * @return string
   */
  #[RouteMapping('dynamic/{id?}')]
  public static function dynamic(#[InjectGet] ?int $id): string
  {
    return "<h1>可选动态参数id匹配到：$id</h1>";
  }
}

