# 1行日記サイト (Daily Note)

Laravel を使った 1 行日記サイトです。

## 動作環境

- Docker（Docker Compose v2 想定）
- コンテナ内: PHP 8.4、MySQL 8.4、Nginx
- アプリ: Laravel 13

## 環境構築手順（初回・クリーンな状態から）

リポジトリのルートを `daily_note` とします。

### 1. 環境変数ファイルの作成

Laravel 用の `.env` を用意します（**マイグレーションより前**に作成しておきます）。

```bash
cd /path/to/daily_note
cp src/.env.example src/.env
```

### 2. Docker イメージのビルドと起動

```bash
cd containers
docker compose build
docker compose up -d
```

### 3. PHP 依存関係のインストール

```bash
docker compose exec php composer install --no-interaction
```

### 4. アプリケーションキーの生成

```bash
docker compose exec php php artisan key:generate
```

### 5. データベースマイグレーション

```bash
docker compose exec php php artisan migrate --force
```

### 6. ストレージのシンボリックリンク作成

画像をアップロード・表示するために必要です。

```bash
docker compose exec php php artisan storage:link
```

### 7. フロントエンドのビルド（Vite）

Blade + Breeze のアセット用です。

```bash
docker compose exec php npm ci
docker compose exec php npm run build
```

### 8. 動作確認

ブラウザで次を開きます。

- **http://localhost:8080**

## 2 回目以降の起動

```bash
cd /path/to/daily_note/containers
docker compose up -d
```
