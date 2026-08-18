#!/bin/bash
set -e

# スクリプトのディレクトリを取得
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "=== Pterodactyl Panel 初回セットアップを開始します ==="
echo ""

# ステップ1: データベースマイグレーション
echo "--- [1/2] データベースマイグレーション ---"
bash "$SCRIPT_DIR/scripts/migrate.sh"
echo ""

# ステップ2: 管理者ユーザー作成
echo "--- [2/2] 管理者ユーザー作成 ---"
bash "$SCRIPT_DIR/scripts/create-admin-user.sh"
echo ""

echo "=== 初回セットアップが完了しました ==="
