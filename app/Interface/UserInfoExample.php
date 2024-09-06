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

namespace App\Interface;

use Viswoole\Core\Validate\Rules\Chinese;
use Viswoole\Core\Validate\Rules\Length;

/**
 * 该类用于演示将类，用于参数校验
 */
class UserInfoExample
{
  /**
   * @param string $name 名称
   */
  public function __construct(
    #[Chinese, Length(3, 10)] public string $name
  )
  {
  }
}
