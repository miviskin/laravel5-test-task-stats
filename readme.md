laravel5-test-task-stats
=====================

Run composer install

```shell
$ composer install
```

Edit .env file

Configure .env 
use Redis cache driver for geo
```vim
CACHE_DRIVER=redis
```

Run artisan commands

```shell
$ php artisan geoip:update
$ php artisan migrate --seed
```

