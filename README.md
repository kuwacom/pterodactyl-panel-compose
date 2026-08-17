# 🖥️ Pterodactyl panel with Docker-Compose

Pterodactyl を Docker Compose + CFTunnelで簡単に構築

このリポジトリは、Pterodactyl panel を Docker Compose で簡単にセットアップするためのものです

> Pterodactyl wingsはこちら -> [kuwacom/pterodactyl-wings-compose](https://github.com/kuwacom/pterodactyl-wings-compose)

---

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

以下の内容を .env ファイルとしてルートディレクトリに作成し、自分の環境に合わせて編集してください

- `DB_ROOT_PASSWORD`: MySQL のルートパスワード
- `DB_DATABASE`: データベース名
- `DB_USER`: データベースユーザー
- `DB_PASSWORD`: データベースユーザーのパスワード
- `PMA_HOST`: phpMyAdmin のホスト
- `PMA_USER`: phpMyAdmin ユーザー
- `PMA_PASSWORD`: phpMyAdmin パスワード
- `PANEL_ADMIN_*`: 管理者ユーザーの情報
- `TUNNEL_TOKEN`: Cloudflare Tunnel のトークン


### 3. Cloudflare Tunnel で公開する

セットアップ後、Cloudflare Tunnelのダッシュボード側で、`http://localhost:80`へ公開設定をしておきましょう

CFTunnelのコンテナネットワークは、Pterodactyl-panel 内部になるようにしています(Proxy(CFTunnel)経由で接続元IPを正確に取得するために、trustedIPにlocalアドレスを設定しているため)

### 4. Docker Composeで起動
```bash
docker-compose up -d
```

## 🔧 Pterodactyl panelの初期設定

セットアップが完了したら、次に初期ユーザーを作成します

```bash
bash ./make-admin-user.sh
```

`.env` に記載されてあるユーザー及びパスワードにて`admin`アカウントを作成します

## 🌐 nginxについて
デフォルトではnginxは構成されていません  
公式 Pterodactyl-panel イメージ内部で起動しているサーバーを利用しています

`nginx/conf.d/default.conf`

## 👾 使用方法

| サービス     | URL                  |
|-------------|----------------------|
| **Panel**   | `http://localhost:8080` |
| **phpMyAdmin** | `http://localhost:8081` |

### データベースのバックアップと復元

- **バックアップ**:
  ```bash
  bash ./db-dump.sh
  ```

- **復元**:
  ```bash
  bash ./db-restore.sh
  ```

これらのスクリプトは `.env` ファイルを読み込んでデータベース操作を行います