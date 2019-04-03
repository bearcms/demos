<?php

/*
 * Bear CMS demos
 * https://github.com/bearcms/demos
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

// Place the secret key (from bearcms.com) here.
define('BEARCMS_APP_SECRET_KEY', 'PASTE-YOUR-APP-SECRET-KEY-HERE');

// Require the Composer autoloader. Run 'composer install' to create this file.
$composerAutoloaderFilePath = __DIR__ . '/../vendor/autoload.php';
if (!is_file($composerAutoloaderFilePath)) {
    echo 'Run \'composer install\' to install the required dependencies!';
    exit;
}
require $composerAutoloaderFilePath;

// Initialize and configure the application. The demo source code (the interesting part) is located at app/index.php
$app = new BearFramework\App();
$app->enableErrorHandler(['displayErrors' => true]);
$app->data->useFileDriver(__DIR__ . '/../data');
$app->cache->useAppDataDriver();
$app->logs->useNullLogger();
$app->contexts->add(__DIR__ . '/../app');
$app->run();
