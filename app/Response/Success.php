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
 * 成功响应
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class Success extends Returned
{
  /**
   * @param mixed $data 响应数据
   * @param string $message 提示信息
   */
  public function __construct(
    array  $data = [],
    string $message = 'success'
  )
  {
    parent::__construct(
      '成功响应',
      [
        'message|消息' => $message,
        'code|响应码' => 0,
        'data|响应数据' => $data,
      ],
      200,
      Returned::TYPE_JSON
    );
  }
}
