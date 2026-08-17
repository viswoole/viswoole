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

namespace App\Dto;

use Viswoole\Core\Validate\Rules\Chinese;

/**
 * 用户资料
 */
class UserInfo
{
  /**
   * @param string $name 姓名
   * @param Gender $gender 性别
   */
  public function __construct(
    #[Chinese('姓名必须是汉字')]
    public string $name,
    public Gender $gender
  )
  {
  }
}
