# 概要
このサンプルアプリは、ソフトウェアテスト手法の課題で利用するサンプルアプリになります。
以下の環境構築後に利用してください。
また各課題ごとにブランチを切りながら進めてください。

# 環境構築
1. **リポジトリのフォークとクローン**  
   - GitHub 上でリポジトリをフォークしてください。  
   - フォークしたリポジトリをクローンし、プロジェクトのルートディレクトリに移動します：
     ```bash
     git clone https://github.com/<your-username>/basic_phpunit_app.git
     cd basic_phpunit_app_exam
     ```
2. **作業ブランチの作成**  
   ```bash
   git checkout -b fix_testcode
   ```
3. **Docker コンテナのビルド＆起動**  
   ```bash
   docker compose build
   docker compose up -d
   ```

# テスト実行
- **PHPUnit テスト**  
  以下のコマンドでテストを実行します（アプリコンテナ内で実行）：
  ```bash
  docker compose exec app vendor/bin/phpunit
  ```
- **Laravel Dusk テスト**  
  Dusk テストは、以下のコマンドで実行します：
  ```bash
  docker compose exec app php artisan dusk
  ```

# 注意点
- **コミット履歴の整理**  
  修正の際には、適切な単位でコミットを分ける練習をしてください。  
- **Git の運用**  
  - リポジトリをクローンする前に、必ずフォーク済みか確認してください。
  - push 前に、作業ブランチを checkout しているか確認してください。
  - PR 作成時に、フォークしたリポジトリに対して PR を作成できているか確認してください。
- **テスト実行と手動操作のデータベース分離**  
  テスト環境用の `.env.dusk.local` を利用して、テスト実行時と手動操作時のデータベースを分離しています。  
  詳細はプロジェクト内の `.env.dusk.local` を確認してください。

# 参考資料
- [Laravel ドキュメント](https://laravel.com/docs)
- [Laravel Dusk ドキュメント](https://laravel.com/docs/dusk)
