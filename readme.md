## Basic Steps

```bash
git clone https://github.com/iamroll/calendar
cp .env.example .env
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan fill:calendar
php artisan serve
crontab -e
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```
