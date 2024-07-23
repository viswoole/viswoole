#!/bin/sh

# 监听的目录
WATCH_DIR="$(dirname "$(readlink -f "$0")")"

# Swoole 服务启动命令
SWOOLE_START_COMMAND="php viswoole server:start -f"
# Swoole 服务停止命令
SWOOLE_CLOSE_COMMAND="php viswoole server:close"
# 要排除的目录
EXCLUDE_DIRS="runtime|vendor"
# 设置防抖间隔（以秒为单位）
DEBOUNCE_INTERVAL=1
# 用来保存上次重启时间的时间戳
LAST_RESTART_TIME=0
# 设置一个trap来捕获中断信号并执行清理操作
trap 'printf "\n\033[0;33m🛑 捕获到停止信号，正在停止服务运行...\033[0m\n"; '"$SWOOLE_CLOSE_COMMAND"'; exit 0' INT
# 获取当前 Swoole 服务的 PID
get_swoole_pid() {
    pid=$(pgrep -f "$SWOOLE_START_COMMAND" | head -n 1)
    echo "$pid"
}
# 启动 Swoole 服务
start_swoole() {
    pid=$(get_swoole_pid)
    if [ -n "$pid" ]; then
        kill -15 "$pid"
        printf "\033[0;33m🔄 Swoole server restarting...\033[0m\n"
        wait "$pid"  # 等待服务器完全停止
    fi
    $SWOOLE_START_COMMAND &
    printf "\033[0;33m✅  Swoole server start.\033[0m\n"
}
# 取消先前的延迟执行任务
cancel_delayed_restart() {
    if [ -n "$delayed_restart_pid" ]; then
        kill -9 "$delayed_restart_pid" >/dev/null 2>&1
        delayed_restart_pid=""
    fi
}

# 修改后的restart_swoole函数，添加了延迟执行逻辑
restart_swoole_debounced() {
    current_time=$(date +%s)
    # 使用expr进行算术比较（注意expr语法需要空格和转义）
    if [ $((current_time - LAST_RESTART_TIME)) -ge $DEBOUNCE_INTERVAL ]; then
        elapsed_seconds=$((current_time - LAST_RESTART_TIME))
        if [ $elapsed_seconds -ge $DEBOUNCE_INTERVAL ]; then
            # 更新上次重启时间
            LAST_RESTART_TIME=$current_time
            # 取消先前的延迟执行任务
            cancel_delayed_restart
            # 延迟执行重启操作
            ( sleep $DEBOUNCE_INTERVAL && start_swoole ) &
            delayed_restart_pid=$!
        else
            # 如果还在防抖间隔内，则取消先前的延迟执行任务并重新延迟执行
            cancel_delayed_restart
            ( sleep $DEBOUNCE_INTERVAL && start_swoole ) &
            delayed_restart_pid=$!
            echo "Restart delayed due to debounce interval."
        fi
    fi
}
# 使用inotifywait监文件变动，并在 Watches established. 后执行一次restart_swoole
inotifywait --recursive --monitor --event modify,create,delete --format '%w%f' "$WATCH_DIR" | (
    start_swoole  # 初始启动一次 Swoole 服务器
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
                restart_swoole_debounced
            fi
        fi
    done
)
