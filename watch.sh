#!/bin/sh

# 监听的目录
WATCH_DIR="$(dirname "$(readlink -f "$0")")"

# Swoole 服务启动命令
SWOOLE_START_COMMAND="php viswoole server:start -f"
# Swoole 服务停止命令
SWOOLE_CLOSE_COMMAND="php viswoole server:close"
# 要排除的目录
EXCLUDE_DIRS="runtime|vendor"
# 设置一个trap来捕获中断信号并执行清理操作
trap 'printf "\n\033[0;33m🛑 捕获到停止信号，正在停止服务运行...\033[0m\n"; '"$SWOOLE_CLOSE_COMMAND"'; exit 0' INT
# 获取当前 Swoole 服务的 PID
get_swoole_pid() {
    pid=$(pgrep -f "$SWOOLE_START_COMMAND" | head -n 1)
    echo "$pid"
}
# 重启 Swoole 服务
restart_swoole() {
    pid=$(get_swoole_pid)
    if [ -n "$pid" ]; then
        kill -15 "$pid"
    fi
    $SWOOLE_START_COMMAND &
}
restart_swoole
# 使用inotifywait监文件变动
inotifywait --recursive --monitor --event modify,create,delete --format '%w%f' "$WATCH_DIR" |
while read -r changed_file; do
    # 检查文件类型和排除目录
    file_extension="${changed_file##*.}"
    file_path="${changed_file%/*}"
    # 使用 EXCLUDE_DIRS 中的目录列表构建正则表达式，并对 | 进行转义
    exclude_pattern=$(echo "$EXCLUDE_DIRS" | sed 's/|/\\\|/g')
    # 判断后缀是否为php或env
    if [ "$file_extension" = php ] || [ "$file_extension" = env ]; then
        if ! echo "$file_path" | grep -qE "(^|/)($exclude_pattern)(/|$)"; then
            printf "\033[0;33m🆕 Detected changes in file: %s\033[0m\n" "$changed_file"
            restart_swoole
            printf "\033[0;33m🔄 Swoole server restarted.\033[0m\n"
        fi
    fi
done
