#!/bin/bash
# 翻訳開発環境をセットアップする
# 使い方: bash scripts/dev-setup.sh
#
# pterodactyl/panel の upstream をクローンし、
# Git管理の翻訳ファイルで上書きする。
# VS Code で panel/ja/.dev/ を開けば補完・型チェック・リントが動く。

set -euo pipefail

PANEL_VERSION="v1.15.1"
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
DEV_DIR="$PROJECT_ROOT/panel/ja/.dev"
RESOURCES_DIR="$PROJECT_ROOT/panel/ja/resources"

echo "==> pterodactyl/panel ${PANEL_VERSION} をクローン"
rm -rf "$DEV_DIR"
git clone --depth 1 --branch "$PANEL_VERSION" https://github.com/pterodactyl/panel.git "$DEV_DIR"
rm -rf "$DEV_DIR/.git"

echo "==> 翻訳ファイルをコピー"
# Git管理の翻訳ファイルで upstream の同名ファイルを上書き
cd "$RESOURCES_DIR"
find . -type f | while IFS= read -r f; do
  target="$DEV_DIR/resources/$f"
  mkdir -p "$(dirname "$target")"
  cp -f "$(realpath "$f")" "$target"
done

echo "==> 依存関係をインストール (npm)"
cd "$DEV_DIR"
npm install --legacy-peer-deps

echo ""
echo "==> セットアップ完了"
echo ""
echo "    開発ディレクトリ:  $DEV_DIR"
echo ""
echo "    VS Code で開く:"
echo "      code $DEV_DIR"
echo ""
echo "    型チェック:        npx tsc --noEmit"
echo "    リント:            npx eslint resources/scripts/**/*.{ts,tsx}"
echo "    本番ビルド:        npx cross-env NODE_ENV=production node_modules/.bin/webpack --mode production"
echo ""
echo "    ※ 翻訳ファイルはコピーなので、.dev/ 側での編集は"
echo "      panel/ja/resources/ に手動で反映してください"
echo "    ※ 本番ビルドはDockerビルドで行うため、ローカルでは不要です"
echo "    ※ npm を使用します（upstream は yarn ですが開発用途なら npm で問題ありません）"
