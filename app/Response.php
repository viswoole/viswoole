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

namespace App;

use JsonSerializable;
use Override;
use ViSwoole\HttpServer\Contract\ResponseInterface;

/**
 * 自定义响应类
 */
class Response extends \ViSwoole\HttpServer\Response
{
  /**
   * @var bool 是否将响应输出到控制台
   */
  protected bool $echoToConsole = false;

  /**
   * 该方法用于异常时输出响应内容
   *
   * @param string $errMsg 错误信息
   * @param int $errCode 业务错误码
   * @param int $statusCode 状态码
   * @param array|JsonSerializable|null $errTrace 错误追踪信息
   * @return ResponseInterface
   */
  #[Override] public function exception(
    string                 $errMsg = '系统内部异常',
    int                    $errCode = 500,
    int                    $statusCode = 500,
    array|JsonSerializable $errTrace = null
  ): ResponseInterface
  {
    return $this->json(compact('errMsg', 'errCode', 'errTrace'), $statusCode);
  }
}
