# syntax=docker/dockerfile:1

# ============================================
# Stage 1: フロントエンドアセットのビルド
# 公式イメージにはNode.js/yarnが含まれないため、別ステージでビルドする
# ============================================
FROM node:22-alpine AS frontend-builder

RUN apk add --no-cache git

WORKDIR /app

ARG PANEL_VERSION=v1.15.1

# 公式ソースを取得（PANEL_VERSIONが変わらない限りキャッシュ再利用）
RUN git clone --depth 1 --branch ${PANEL_VERSION} https://github.com/pterodactyl/panel.git /app \
    && rm -rf /app/.git

# 依存関係インストール（翻訳ファイルCOPY前に実行 -> 翻訳変更時に再インストールされない）
RUN --mount=type=cache,target=/yarn-cache \
    YARN_CACHE_FOLDER=/yarn-cache yarn install --frozen-lockfile

# 日本語化ファイルで上書き（翻訳したファイルのみ、差分管理）
COPY panel/ja/resources/ /app/resources/

# 本番ビルド
RUN yarn run build:production

# ============================================
# Stage 2: 最終イメージ
# 公式イメージをベースに、ビルド済みアセットと翻訳ファイルを配置する
# ============================================
FROM ghcr.io/pterodactyl/panel:${PANEL_VERSION}

LABEL org.opencontainers.image.title="Pterodactyl Panel (Japanese)"
LABEL org.opencontainers.image.description="Pterodactyl Panel with full Japanese localization"
LABEL org.opencontainers.image.source="https://github.com/kuwacom/Pterodactyl-panel-docker-compose"
LABEL org.opencontainers.image.licenses="MIT"

# ビルド済みの日本語化アセットを配置
COPY --from=frontend-builder /app/public/assets/ /app/public/assets/
# 翻訳済みの言語ファイルとBladeビューを配置
COPY --from=frontend-builder /app/resources/lang/en/ /app/resources/lang/en/
COPY --from=frontend-builder /app/resources/views/ /app/resources/views/
