<div style="text-align: center;margin-top:24px">
<img alt="logo" style="width: 300px;" src="/public/logo.png">
<br>

一款基于[swoole](https://www.swoole.com/)开发的轻量级`PHP`框架

[![Gitee](https://img.shields.io/badge/Gitee-blue?style=flat-square&logo=Gitee)](https://gitee.com/viswoole/viswoole)
[![GitHub Stars](https://img.shields.io/github/stars/viswoole/viswoole?style=flat-square&logo=Github)](https://github.com/viswoole/viswoole)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue?style=flat-square)](http://www.apache.org/licenses/LICENSE-2.0)
</div>

## 特性

- **易用**：遵循PSR规范，学习成本低，注释与异常反馈信息均为中文，轻松阅读。
- **安全**：优雅地依赖注入方式，提供了参数基本类型校验，以及扩展规则校验，无需额外编写validate去校验请求参数是否正确，现在您只需要关注业务代码，让框架帮你完成参数校验。
- **性能**：基于`swoole`的协程，在性能上比`PHP`原生的`fpm`要快很多。
- **扩展**：框架的扩展性非常强，提供了服务发现、依赖下发、`swoole`服务事件HOOK等常用功能，能够依据这些功能拓展你自定义的服务。
- **文档**：框架提供了API文档结构生成功能，能够根据路由树自动生成API文档，文档结构中包含了请求参数结构、响应数据结构等构建API文档所需的信息。
- **异步任务**：框架内置了轻量的异步任务管理器，中小型项目开箱即用。

> 框架运行环境依赖于 `PHP >= 8.3` + `swoole >= 5.0`

## 文档

[Viswoole开发文档](https://viswoole.com)

### 安装

```bash
composer create-project viswoole/viswoole myProject
```

### 启动服务

```bash
# 进入项目目录
cd myProject
# 安装依赖
composer install
# 启动服务
php viswoole server:start http -d # -d 参数代表后台启动
```

如需单独更新框架依赖，可以使用如下命令：

```bash
composer update viswoole/framework
```

### 重启服务

```bash
# 如果不传入serverName，则会关闭所有在运行的服务
# 默认重启worker和task进程，可以选择传入 -t 参数仅重启task进程
php viswoole reload:server http
```

### 关闭服务

```bash
# 如果不传入serverName，则会关闭所有在运行的服务
php viswoole server:close http
```

### 热重载

内置了一个shell脚本`watch`，可以用来监听文件修改，实现热重载。

```bash
 # 唯一可选参数[serverName]
/bin/sh watch http
```

## 参与开发

提交PR或Issue即可！

## 许可证书

`Viswoole`遵循[Apache-2.0](LICENSE)开源协议。
