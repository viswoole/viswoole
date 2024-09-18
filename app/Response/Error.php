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

namespace App\Response;

use Attribute;
use Viswoole\Router\ApiDoc\Annotation\Returned;

/**
 * 错误响应
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class Error extends Returned
{
  /**
   * 构建错误响应
   *
   * @param string $message 提示信息
   * @param int $code 响应码
   * @param array $data 响应数据
   */
  public function __construct(
    string $message,
    int    $code = -1,
    array  $data = [],
  )
  {
    parent::__construct(
      '失败响应',
      [
        'message|消息' => $message,
        'code|响应码' => $code,
        'data|响应数据' => $data,
      ],
      200,
      Returned::TYPE_JSON
    );
  }
}
