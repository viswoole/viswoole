<?php
// +----------------------------------------------------------------------
// | HTTP路由注册
// +----------------------------------------------------------------------

declare (strict_types=1);

use ViSwoole\Core\Route;
use ViSwoole\HttpServer\Request;
use ViSwoole\HttpServer\Response;

Route::get('/', function (Request $request, Response $response) {
  return $response->send('<h1>Hello ViSwoole. #' . rand(1000, 9999) . '</h1>');
});
Route::miss(
  function (Response $response) {
    return $response->exception('404', 404, 404);
  }
);
