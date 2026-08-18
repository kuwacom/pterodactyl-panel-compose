# 🖥️ Pterodactyl Panel with Docker Compose

[Pterodactyl Panel](https://pterodactyl.io/) を Docker Compose + Cloudflare Tunnel で簡単に構築するためのリポジトリです

> [!NOTE]
> Pterodactyl Wings（ゲームサーバー実行デーモン）はこちら -> [kuwacom/pterodactyl-wings-compose](https://github.com/kuwacom/pterodactyl-wings-compose)

## 📋 前提条件

| 項目 | 要件 |
|------|------|
| **OS** | Docker が動作する環境（Linux / Windows / macOS） |
| **Docker** | Docker Engine + Docker Compose（v2 推奨） |
| **Cloudflare** | Cloudflare アカウント + 管理済みドメイン |

## 📦 セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/kuwacom/pterodactyl-panel-compose.git
cd pterodactyl-panel-compose
```

### 2. `.env` ファイルを作成

```bash
cp example.env .env
```

`.env` をエディタで開き、以下の変数を自分の環境に合わせて編集してください

#### データベース設定

| 変数 | 説明 |
|------|------|
| `DB_HOST` | データベースのホスト名（コンテナ間通信用に `mysql` 固定） |
| `DB_PORT` | データベースのポート（`3306` 固定） |
| `DB_ROOT_PASSWORD` | MySQL のルートパスワード |
| `DB_DATABASE` | Pterodactyl 用データベース名 |
| `DB_USER` | Pterodactyl 用データベースユーザー名 |
| `DB_PASSWORD` | Pterodactyl 用データベースパスワード |

#### phpMyAdmin 設定

| 変数 | 説明 |
|------|------|
| `PMA_HOST` | phpMyAdmin が接続する DB ホスト（`mysql:3306` 固定） |
| `PMA_USER` | phpMyAdmin で使用する DB ユーザー名 |
| `PMA_PASSWORD` | phpMyAdmin で使用する DB パスワード |

#### Panel 設定

| 変数 | 説明 |
|------|------|
| `APP_NAME` | Panel の表示名 |
| `APP_ENV` | 環境（`production` を推奨） |
| `APP_DEBUG` | デバッグモード（本番では `false`） |
| `APP_URL` | Panel の公開 URL（Cloudflare Tunnel 使用時は `https://your-domain.com` に変更） |
| `APP_KEY` | Laravel 暗号化キー（後述の手順で生成） |
| `APP_SERVICE_AUTHOR` | サービスメールの差出人アドレス |

#### 管理者ユーザー設定

| 変数 | 説明 |
|------|------|
| `PANEL_ADMIN_NAME` | 管理者のログインユーザー名 |
| `PANEL_ADMIN_FIRST_NAME` | 管理者の名 |
| `PANEL_ADMIN_LAST_NAME` | 管理者の姓 |
| `PANEL_ADMIN_EMAIL` | 管理者のメールアドレス |
| `PANEL_ADMIN_PASSWORD` | 管理者のパスワード |

#### Cloudflare Tunnel 設定

| 変数 | 説明 |
|------|------|
| `TUNNEL_TOKEN` | Cloudflare Tunnel のトークン（後述の手順で取得） |
| `TUNNEL_TRANSPORT_PROTOCOL` | 通信プロトコル（`http2` を推奨） |

### 3. Cloudflare Tunnel の設定

Cloudflare Tunnel は、ポートを外部に公開せずに安全に Panel をインターネットに公開するための仕組みです

#### 3-1. トンネルの作成とトークンの取得

1. [Cloudflare Zero Trust ダッシュボード](https://one.dash.cloudflare.com/) にログイン
2. 左メニュー **Networks** -> **Tunnels** を開く
3. **Create a tunnel** をクリック
4. トンネル名を入力（例: `pterodactyl-panel`）し **Save tunnel**
5. インストール手順画面が表示されるので、**Docker** タブを選択
6. 表示されるトークンをコピーし、`.env` の `TUNNEL_TOKEN` に設定

#### 3-2. Public Hostname の設定

トンネル作成後、**Public Hostname** タブで Panel を公開するホスト名を追加します

1. トンネルの **Public Hostname** タブを開く
2. **Add a public hostname** をクリック
3. 以下を入力:

   | 項目 | 設定値 |
   |------|--------|
   | **Subdomain** | 任意（例: `panel`） |
   | **Domain** | Cloudflare で管理済みのドメインを選択 |
   | **Path** | 空 |
   | **Service Type** | `HTTP` |
   | **URL** | `localhost:80` |

4. **Save hostname** をクリック

> [!NOTE]
> cloudflared コンテナは Panel コンテナのネットワークに所属しているため、`localhost:80` で Panel にアクセスできます

5. `.env` の `APP_URL` を公開 URL に変更:
   ```
   APP_URL=https://panel.your-domain.com
   ```

#### 3-3. TRUSTED_PROXIES について

`docker-compose.yaml` で `TRUSTED_PROXIES: "127.0.0.1"` を設定しています
これにより、Cloudflare Tunnel 経由で接続元 IP を正しく取得できます
追加のプロキシを使用する場合は、該当 IP を追記してください

### 4. APP_KEY の生成

初回セットアップ前に、Laravel の暗号化キーを生成して `.env` に設定します

```bash
# base64: プレフィックス付きで生成
echo "base64:$(openssl rand -base64 32)"
```

出力された文字列を `.env` の `APP_KEY` に設定してください:

```
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

> [!WARNING]
> **APP_KEY は必ずサーバー外にバックアップしてください。**
> 紛失すると暗号化されたデータ（API キー等）が永久に復元不可になります

> [!NOTE]
> `base64:` プレフィックスは必須です。プレフィックスなしでは Laravel がキーを正しく読み込めません
> この Docker 構成では `env_file: .env` でホスト側の `.env` がコンテナの環境変数として渡されるため、ホスト側で生成して `.env` に直接記述する必要があります

### 5. Docker Compose で全サービス起動

```bash
docker compose up -d
```

### 6. 初回セットアップ（マイグレーション + 管理者ユーザー作成）

```bash
bash ./setup.sh
```

以下の処理が順次実行されます:

1. **データベースマイグレーション** (`scripts/migrate.sh`) -> `php artisan migrate --seed --force`
2. **管理者ユーザー作成** (`scripts/create-admin-user.sh`) -> `.env` に記載されたユーザー情報で `admin` アカウントを作成

## 🌐 アクセス先

| サービス | URL |
|----------|-----|
| **Panel** | `APP_URL` に設定した URL（例: `https://panel.your-domain.com`） |
| **Panel（ローカル）** | `http://127.0.0.1:8080` |
| **phpMyAdmin** | `http://127.0.0.1:8081` |

> [!NOTE]
> phpMyAdmin はローカルアクセスのみ（`127.0.0.1`）に制限されています

## 🔧 運用コマンド

### データベースのバックアップ

```bash
bash ./db-dump.sh
```

`dump.sql` に全データベースのダンプが出力されます

### データベースの復元

```bash
bash ./db-restore.sh
```

`dump.sql` からデータベースをリストアします

### 個別スクリプトの実行

初回セットアップ以外で個別に実行することも可能です:

```bash
# マイグレーションのみ
bash ./scripts/migrate.sh

# 管理者ユーザー作成のみ
bash ./scripts/create-admin-user.sh
```

## 🗂️ ディレクトリ構成

```
.
├── docker-compose.yaml
├── example.env
├── .env
├── setup.sh
├── scripts/
├── db-dump.sh
├── db-restore.sh
├── nginx/
├── mysql/                  # MySQL データ（永続化）
├── redis/                  # Redis データ（永続化）
└── pterodactyl/            # Panel 永続データ（公式推奨パス）
    ├── var/                # サーバーアップロードファイル等
    └── logs/               # Panel ログ
```

## 🌐 Nginx について

デフォルトでは Nginx は構成されていません
公式 Pterodactyl Panel イメージ内部の Web サーバーを直接利用しています

リバースプロキシが必要な場合は、`docker-compose.yaml` の `nginx` サービスをコメントアウトから解除し、`nginx/conf.d/default.conf` を編集してください

## 🐳 サービス構成

| サービス | イメージ | 役割 |
|----------|----------|------|
| **panel** | `ghcr.io/pterodactyl/panel:latest` | Pterodactyl Panel 本体 |
| **queue** | `ghcr.io/pterodactyl/panel:latest` | Queue Worker（バックグラウンドジョブ処理） |
| **mysql** | `mysql:8.4` | データベース（永続化） |
| **redis** | `redis:alpine` | キャッシュ・キュー・セッション |
| **phpmyadmin** | `phpmyadmin` | DB 管理ツール（ローカルのみ） |
| **cloudflared** | `cloudflare/cloudflared` | Cloudflare Tunnel（安全な公開） |

## 🛠️ トラブルシューティング

### 管理者ユーザー作成エラー

マイグレーションが未実行の場合、管理者ユーザー作成に失敗します
先に `setup.sh` を実行するか、`scripts/migrate.sh` を単独で実行してください