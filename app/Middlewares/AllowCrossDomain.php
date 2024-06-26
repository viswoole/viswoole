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

namespace App\Middlewares;

use Closure;
use Override;
use ViSwoole\Core\Contract\MiddlewareInterface;
use ViSwoole\HttpServer\Contract\RequestInterface;
use ViSwoole\HttpServer\Contract\ResponseInterface;

/**
 * 跨域中间件
 */
class AllowCrossDomain implements MiddlewareInterface
{
  public function __construct(
    protected RequestInterface  $request,
    protected ResponseInterface $response
  )
  {
  }

  /**
   * @inheritDoc
   */
  #[Override] public function process(Closure $handler): mixed
  {
    if ($this->request->getMethod() === 'OPTIONS') {
      $this->response->setHeader([
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => '*'
      ]);
      return $this->response;
    }
    return $handler();
  }
}
