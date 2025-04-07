# お問い合わせフォーム  

- お問い合わせフォームの送信、確認、管理画面での一覧・検索・CSVエクスポート機能を備えたLaravelアプリケーションです。  

## 主な機能

### 一般ユーザー  

- お問い合わせフォーム入力・確認・送信
- バリデーション付きのフォーム
- 送信完了ページ表示

### 管理画面  

- お問い合わせ一覧の表示（ページネーションあり）
- 名前、メール、性別、カテゴリー、日付による絞り込み検索（部分一致・完全一致）
- CSVエクスポート（全件または絞り込み後）
- 詳細モーダル表示
- お問い合わせの削除

## 環境構築  

### Dockerビルド  

- ディレクトリの作成
- Docker-compose.yml の作成
- Nginx の設定
- PHP の設定
- MySQL の設定
- phpMyAdmin の設定
- docker-compose up -d --build

### Laravel環境構築  

- docker-compose exec php bash
- composer -v
- composer create-project "laravel/laravel=8.*" . --prefer-dist
- fashionablylateディレクトリ上でsudo chmod -R 777 src/*を実行
- app.php（'timezone' => 'Asia/Tokyo',）
- php artisan tinker
- echo Carbon\Carbon::now();
- .envファイルの設定

## ビューの作成  

- app.blade.php (common.css)
- contact.blade.php (contact.css)
- confirm.blade.php (confirm.css)
- thanks.blade.php (thanks.css)
- login.blade.php (login.css)
- register.blade.php (register.css)
- admin.blade.php (admin.css)

## コントローラー設定  

- docker-compose exec php bash
- php artisan make:controller ContactController
- php artisan make:controller LoginController
- php artisan make:controller AdminController
- コントローラにアクション追加
- ルーティング設定（web.php）
- php artisan key:generate
  
## テーブル作成（マイグレーション）  

- php artisan make:migration create_categories_table
- マイグレーションファイルに記述追加（カラムの設定）
- php artisan migrate
- php artisan make:model Category
  
- php artisan make:migration create_contacts_table
- マイグレーションファイルに記述追加（カラムの設定）
- php artisan migrate
- php artisan make:model Contact

## シーティング  

- php artisan make:seeder CategoriesTableSeeder
- runメソッドにCategoriesテーブルのシードを作成する処理を記載
- DatabaseSeeder.phpを開き、runメソッドにシーダーを実行する処理を記載、$this->call(CategoriesTableSeeder::class);
- php artisan db:seed
  
- php artisan make:seeder ContactsTableSeeder
- runメソッドにContactsテーブルのシードを作成する処理を記載
- DatabaseSeeder.phpを開き、runメソッドにシーダーを実行する処理を記載、$this->call(ContactsTableSeeder::class);
- php artisan db:seed

## 使用技術(実行環境)  
  
- PHP 7.4.9
- MySQL 8.0.26  
- Laravel Framework 8.83.29
- Nginx
- Docker / Docker Compose
- Bootstrap 5.3
- Bladeテンプレートエンジン

## ER図  

![image](https://github.com/user-attachments/assets/6b0b5c99-51ce-4dc7-aa3b-aac07625e20a)

- index.drawio.pngに記載

## URL　　

- 開発環境：http://localhost/
