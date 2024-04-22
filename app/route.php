<?php
// +----------------------------------------------------------------------
// | HTTP路由注册
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\HttpServer\Request;
use ViSwoole\HttpServer\Response;
use ViSwoole\HttpServer\Route;

Route::get('/', function (Request $request, Response $response) {
  return 'hello viswoole';
});
Route::miss(
  function (Request $request, Response $response) {
    if ($request->getMethod() === 'OPTIONS') {
      // 跨域
      $response->setHeader([
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => '*',
        'Access-Control-Allow-Methods' => 'GET,POST,PATCH,PUT,DELETE,OPTIONS,DELETE',
      ]);
      return $response->success();
    } else {
      $path = $request->getPath();
      if ($path === '/favicon.ico') {
        return $response->sendfile(BASE_PATH . '/static/favicon.ico');
      }
      return $response->exception('404', 404, 404);
    }
  }
);
