# 基础镜像
FROM zhuchonglin/php_swoole:php8.3.4-swoole5.1.1

# 版本号变量
ARG APP_VERSION=1.0.0-dev

# 设置镜像的作者信息
LABEL authors="zhuchonglin"

# 镜像版本号
LABEL version="${APP_VERSION}"

# 设置工作目录
WORKDIR /var/www/app

# 复制项目文件到工作目录
COPY . /var/www/app

# 暴露容器监听的端口号
EXPOSE 9501

# 入口文件 在容器启动时自动执行
#ENTRYPOINT []

#CMD [ "tail", "-f", "/dev/null" ]
