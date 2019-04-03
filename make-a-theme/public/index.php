<?php

/*
 * Bear CMS demo theme
 * https://github.com/bearcms/demo-theme
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

require __DIR__ . '/../vendor/autoload.php';

$app = new BearFramework\App();
$app->enableErrorHandler(['logErrors' => false, 'displayErrors' => true]);
$app->data->useFileDriver(__DIR__ . '/../data');
$app->cache->useAppDataDriver();
$app->logs->useFileLogger(__DIR__ . '/../logs');
$app->contexts->add(__DIR__ . '/../app');
$app->run();
