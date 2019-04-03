<?php

/*
 * Bear CMS demos
 * https://github.com/bearcms/demos
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

use BearFramework\App;

// Get a Bear Framework application instance.
$app = App::get();

// Let's create a home page that will render information retrieved by the Data API.
$app->routes
        ->add('/', function() use ($app) {
            $response = new App\Response\HTML(); // Create a new HTML response.

            $html = ''; // A string that will contain the response HTML code.

            $getDataTable = function($object) { // A utility function used to render object properties into an HTML table.
                $data = $object->toArray();
                $result = '<table style="border:1px solid rgba(0,0,0,0.2);padding:10px;width:100%;margin-top:10px;">';
                foreach ($data as $name => $value) {
                    $result .= '<tr><td>' . $name . '</td><td>' . ($value === null ? '<i>null</i>' : print_r($value, true)) . '</td></tr>';
                }
                $result .= '</table>';
                return $result;
            };

            $html .= '<bearcms-heading-element text="Pages"/>';
            $list = $app->bearCMS->data->pages->getList(); // Get list of all pages.
            foreach ($list as $page) {
                // You can access
                // $page->id
                // $page->name
                // etc.
                $html .= $getDataTable($page); // Render page properties as HTML table.
            }

            $html .= '<bearcms-heading-element text="Blog posts"/>';
            $list = $app->bearCMS->data->blogPosts->getList(); // Get list of all blog posts.
            foreach ($list as $blogPost) {
                $html .= $getDataTable($blogPost); // Render blog post properties as HTML table.
            }

            $html .= '<bearcms-heading-element text="Users"/>';
            $list = $app->bearCMS->data->users->getList(); // Get list of all users.
            foreach ($list as $user) {
                $html .= $getDataTable($user); // Render use properties as HTML table.
            }

            $html .= '<bearcms-heading-element text="Settings"/>';
            $settings = $app->bearCMS->data->settings->get(); // Get the site settings.
            $html .= $getDataTable($settings); // Render settings properties as HTML table.

            $response->content = $html; // Update the content of the reponse.
            $app->bearCMS->apply($response); // Call Bear CMS to apply the theme and make it's magic.
            return $response; // Return the response.
        });

// Add the Bear CMS client addon
$app->addons->add('bearcms/bearframework-addon');

// Initialize the Bear CMS client.
$app->bearCMS->initialize([
    'serverUrl' => 'https://r05.bearcms.com/', // The Bear CMS server url
    'appSecretKey' => BEARCMS_APP_SECRET_KEY, // The Bear CMS site secret key configured at public/index.php
    'defaultThemeID' => 'bearcms/themeone' // Set the default theme
]);
