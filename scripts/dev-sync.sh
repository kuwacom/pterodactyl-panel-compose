#!/bin/bash
# .dev/ で編集した翻訳ファイルを Git管理側に同期する
# 使い方: bash scripts/dev-sync.sh
#
# dev-setup.sh で構築した .dev/resources/ の内容を
# panel/ja/resources/ にコピーする。
# 編集後、ビルド前に実行すること。

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
DEV_RESOURCES="$PROJECT_ROOT/panel/ja/.dev/resources"
GIT_RESOURCES="$PROJECT_ROOT/panel/ja/resources"

if [ ! -d "$DEV_RESOURCES" ]; then
  echo "エラー: .dev/ が存在しません。先に bash scripts/dev-setup.sh を実行してください"
  exit 1
fi

synced=0
cd "$GIT_RESOURCES"
find . -type f | while IFS= read -r f; do
  dev_file="$DEV_RESOURCES/$f"
  if [ -f "$dev_file" ]; then
    if ! diff -q "$f" "$dev_file" >/dev/null 2>&1; then
      cp -f "$dev_file" "$f"
      echo "  更新: $f"
      synced=1
    fi
  fi
done

if [ "$synced" -eq 0 ]; then
  echo "変更なし"
else
  echo ""
  echo "同期しました。git diff で確認後、コミットしてください"
fi
