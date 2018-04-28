<?php
require_once 'vendor/autoload.php';
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\NativeMailerHandler;
use Monolog\handler\StreamHandler;
use Monolog\Logger;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required('PHP_ENV');
$env = getenv('PHP_ENV');

$log = new Monolog\Logger('koumei');
$log->pushHandler(new ChromePHPHandler(Logger::DEBUG));
$log->pushHandler(
  new Monolog\Handler\StreamHandler(
    './logs/app.log', Logger::WARNING
  )
);
$log->pushHandler(new NativeMailerHandler(
  'info@example.com'
  , 'Alert from koumei'
  , 'you@example.com'
  , Logger::CRITICAL
));

$log->debug('debug message');
$log->warning('warning message');
$log->error('error message');
$log->critical('critical message');
ChromePhp::log('Hello console!');
ChromePhp::log($_SERVER);
ChromePhp::warn('something went wrong!');
