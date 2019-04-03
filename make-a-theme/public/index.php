<?php

/*
 * Bear CMS demos
 * https://github.com/bearcms/demos
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

// Place the secret key (from bearcms.com) here
define('BEARCMS_APP_SECRET_KEY', 'PASTE-YOUR-APP-SECRET-KEY-HERE');

require __DIR__ . '/../vendor/autoload.php';

$app = new BearFramework\App();
$app->enableErrorHandler(['logErrors' => false, 'displayErrors' => true]);
$app->data->useFileDriver(__DIR__ . '/../data');
$app->cache->useAppDataDriver();
$app->logs->useFileLogger(__DIR__ . '/../logs');
$app->contexts->add(__DIR__ . '/../app');
$app->run();
