<?php
// +----------------------------------------------------------------------
// | HTTP路由注册
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\HttpServer\Request;
use ViSwoole\HttpServer\Response;
use ViSwoole\HttpServer\Route;

Route::get('/', function (Request $request, Response $response) {
  return $response->send('<h1>hello viswoole ' . rand(1000, 9999) . '</h1>');
});
Route::miss(
  function (Request $request, Response $response) {
    $path = $request->getPath();
    if ($path === '/favicon.ico') {
      return $response->sendfile(BASE_PATH . '/static/favicon.ico');
    }
    return $response->exception('404', 404, 404);
  }
);
