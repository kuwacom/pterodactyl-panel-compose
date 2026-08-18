#!/bin/bash
set -e

# shellcheck disable=SC1091
source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/common.sh"

load_env
check_panel_container

echo "=== データベースマイグレーションを開始します ==="
docker exec pterodactyl-panel php artisan migrate --seed --force
echo "=== マイグレーションが完了しました ==="
