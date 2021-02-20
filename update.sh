git reset --hard
git pull
composer install
npm install
chown -R apache:apache .
chmod -R 777 .
php artisan migrate