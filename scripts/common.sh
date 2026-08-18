#!/bin/bash

# 共通関数を定義するスクリプト
# 各スクリプトから source して使用する

# スクリプトのディレクトリを取得
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# .env を読み込む
# set -a (allexport) で source 中の代入をすべて export する。
# source でシェル構文として評価するため、インラインコメント (KEY=val # comment) も正しく処理される。
load_env() {
    local env_file="$SCRIPT_DIR/../.env"
    if [ -f "$env_file" ]; then
        # CRLF -> LF 変換（Windows環境で編集された .env に対応）
        local env_content
        env_content="$(sed 's/\r$//' "$env_file")"
        # ヒアドキュメントで source して環境変数を export する
        set -a
        eval "$env_content"
        set +a
    else
        echo ".env file not found at $env_file"
        exit 1
    fi
}

# Panel コンテナが起動しているか確認
check_panel_container() {
    if ! docker ps --format '{{.Names}}' | grep -q '^pterodactyl-panel$'; then
        echo "pterodactyl-panel コンテナが起動していません。docker-compose up -d を先に実行してください"
        exit 1
    fi
}
