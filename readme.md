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
![123](https://user-images.githubusercontent.com/27915539/57321176-94c0c980-7122-11e9-9752-02793f1a74f6.png)
