## HotelPlex

```bash
composer install
composer update

bin/console doctrine:database:create # Only dev or test
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load # Only dev or test

bin/console server:start # Only dev or test
bin/console server:stop # Only dev or test
```

