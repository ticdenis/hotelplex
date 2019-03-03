<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

// Load cached env vars if the .env.local.php file exists
// Run "composer dump-env prod" to create it (requires symfony/flex >=1.2)
if (is_array($env = @include dirname(__DIR__) . '/.env.local.php')) {
    $_SERVER += $env;
    $_ENV += $env;
} elseif (!class_exists(Dotenv::class)) {
    throw new RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv())->loadEnv(dirname(__DIR__) . '/.env');
}

$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? null) ?: 'dev';
$_SERVER['APP_DEBUG'] = $_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? 'prod' !== $_SERVER['APP_ENV'];
$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = (int)$_SERVER['APP_DEBUG'] || filter_var($_SERVER['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN) ? '1' : '0';

# Custom for tests!

if ($_SERVER['APP_ENV'] === 'test') {
    if (isset($_ENV['TEST_RESET_DATABASE']) && $_ENV['TEST_RESET_DATABASE'] === "1") {
        echo "Resetting test database...";
        passthru(sprintf(
            'php "%s/../bin/console" doctrine:database:drop --no-interaction --force --env=test',
            __DIR__
        ));
        passthru(sprintf(
            'php "%s/../bin/console" doctrine:database:create --if-not-exists --no-interaction --env=test',
            __DIR__
        ));
        passthru(sprintf(
            'php "%s/../bin/console" doctrine:migrations:migrate --no-interaction --env=test',
            __DIR__
        ));
        passthru(sprintf(
            'php "%s/../bin/console" doctrine:fixtures:load --no-interaction --env=test',
            __DIR__
        ));
        echo " Done" . PHP_EOL . PHP_EOL;
    }
}
