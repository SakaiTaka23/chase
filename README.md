# Chase
会員の居場所を知ることができるアプリ

# インストール
laravel・データベースの環境は持っていることが前提

git clone https://github.com/SakaiTaka23/chase.git  
cd chase  
composer install  
データベースを作成  
cp .env.example .env  
.envファイルのデータベース、ユーザーネーム、パスワードの修正  
php artisan key:generate  
php artisan migrate:fresh --seed  
php artisan serve  

# ログインurl
## ユーザーurl

{domain}/login

## 管理者url

{domain}/admin/login 

# 注意点
## 新規登録

・学籍番号は 小文字の英字１文字 + 数字５桁