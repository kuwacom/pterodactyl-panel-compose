#!/bin/bash
set -e

# shellcheck disable=SC1091
source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/common.sh"

load_env

# Check if required PANEL_ADMIN variables are set
if [ -z "$PANEL_ADMIN_NAME" ] || [ -z "$PANEL_ADMIN_EMAIL" ] || [ -z "$PANEL_ADMIN_PASSWORD" ]; then
    echo "PANEL_ADMIN variables not set in .env file!"
    exit 1
fi

echo "Creating admin user with the following details:"
echo "Name: $PANEL_ADMIN_NAME"
echo "First Name: $PANEL_ADMIN_FIRST_NAME"
echo "Last Name: $PANEL_ADMIN_LAST_NAME"
echo "Email: $PANEL_ADMIN_EMAIL"
echo "Password: [HIDDEN]"

# うまく動作しない場合、以下のコマンドに直接値を入力して試してみてください
if ! docker exec pterodactyl-panel php artisan p:user:make \
  --username="$PANEL_ADMIN_NAME" \
  --name-first="$PANEL_ADMIN_FIRST_NAME" \
  --name-last="$PANEL_ADMIN_LAST_NAME" \
  --email="$PANEL_ADMIN_EMAIL" \
  --password="$PANEL_ADMIN_PASSWORD" \
  --admin=1; then
    echo "Failed to create admin user."
    echo "マイグレーションが未実行の可能性があります。以下を実行してください:"
    echo "  docker exec pterodactyl-panel php artisan migrate --force"
    exit 1
fi

echo "Admin user created successfully!"
