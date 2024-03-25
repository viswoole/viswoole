<?php
// +----------------------------------------------------------------------
// | 全局事件监听注册
// | return['event'=>[class,method],'event'=>listen:class,'event'=>callback]
// +----------------------------------------------------------------------

declare (strict_types=1);

return [
  // 应用初始化
  'AppInit' => [],
  // 应用销毁
  'AppDestroyed' => [],
  // 路由加载完毕
  'RouteLoaded' => []
];
