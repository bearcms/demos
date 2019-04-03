<?php

/*
 * Bear CMS demo theme
 * https://github.com/bearcms/demo-theme
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

use BearFramework\App;

$app = App::get();

$context = $app->contexts->get();

// Add the Bear CMS client addon
$app->addons->add('bearcms/bearframework-addon');

// Initialize the Bear CMS client
$app->bearCMS->initialize([
    'serverUrl' => 'https://r05.bearcms.com/', // The Bear CMS server url
    'appSecretKey' => 'TODO', // The Bear CMS site secret key
    'defaultThemeID' => 'demo-author/demo-theme-1' // Set the default theme
]);

// Register the demo theme
$app->bearCMS->themes
        ->register('demo-author/demo-theme-1', function(\BearCMS\Themes\Theme $theme) use ($context) {
            // This property is optional, but helps the Bear CMS client cache the theme for better performance.
            // Don't forget to update it if you change some of the code below. While developing you can comment it out.
            $theme->version = '1.0';

            // Register a callback that returns the theme template.
            // The current page content will be inserted into the {{body}} part.
            $theme->get = function(\BearCMS\Themes\Theme\Customizations $customizations) {
                // There are customization options defined for this theme below. This is how to get their current values.
                $textColor = $customizations->getValue('textColor');
                $backgroundColor = $customizations->getValue('backgroundColor');

                // Return the HTML template for the theme. For simlicity the HTML code is hard coded into this PHP file,
                // but feel free to organize it however you like.
                return '<html>
                            <head>
                                <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,minimal-ui">
                                <style>
                                    html,body{padding:0;margin:0;min-height:100vh;}
                                    body{
                                        font-size:15px;
                                        color:' . $textColor . ';
                                        background-color:' . $backgroundColor . ';
                                        line-height:180%;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style="min-height:100vh;font-family:Helvetica;padding:30px;max-width:600px;margin:0 auto;">
                                    <main>
                                        <div style="padding:50px 20px 80px 20px;font-size:30px;line-height:180%;text-align:center;border-bottom:1px solid ' . $textColor . ';">THIS IS A DEMO THEME</div>
                                        <div style="padding:40px 0;">{{body}}</div>
                                    </main>
                                </div>
                            </body>
                        </html>';
            };

            // This property is optional and recommended for advanced usage only.
            // Here you can modify the response object and apply your theme this way. It's called after the 'get' callback registered above.
            $theme->apply = function(App\Response $response, \BearCMS\Themes\Theme\Customizations $customizations) {
                // May the Force be with you
            };

            // This property is optional. The callback registered can return an information about the theme,
            // that will be shown in the CMS Appearance UI
            $theme->manifest = function() use ($theme, $context) {
                $manifest = $theme->makeManifest(); // Create a new manifest object.
                $manifest->name = "Demo theme 1"; // The name of the theme
                $manifest->description = "This is a demo theme"; // The description of the theme
                $manifest->author = [// The author of the theme
                    'name' => 'Demo author',
                    'url' => 'https://example.com/',
                    'email' => 'demo@example.com',
                ];
                $manifest->media = [// Array of images that will be shown in the CMS Appearance UI
                    [
                        'filename' => $context->dir . '/assets/theme-media-1.png', // The filename of the image
                        'width' => 1000, // The width of the image
                        'height' => 750 // The height of the image
                    ]
                ];
                return $manifest;
            };

            // Helper function that is used below. It returns the default values for the default style.
            $getDefaultStyleValues = function() {
                return [
                    'backgroundColor' => '#8a20ad',
                    'textColor' => '#ffffff'
                ];
            };

            // This property is optional. Can be used to register theme options that can be used by the administrators to customize the theme from the CMS UI.
            $theme->options = function() use ($theme, $getDefaultStyleValues) {
                $options = $theme->makeOptions(); // Create the options objects.
                $group = $options->addGroup('Colors'); // Create a new group
                $group->addOption('backgroundColor', 'color', 'Background color'); // Add a option to the group
                $group->addOption('textColor', 'color', 'Text color');
                $options->setValues($getDefaultStyleValues()); // Set the default values of the options.
                return $options;
            };

            // This property is optional. Can be used to register styles that can be applied by the administrators from the CMS UI.
            $theme->styles = function() use ($theme, $context, $getDefaultStyleValues) {
                // Create an array that will contain the styles.
                $styles = [];

                // Define the first style
                $style = $theme->makeStyle(); // Create a style object
                $style->media = [// Adds a preview image that will be shown to the administrators when choosing a style
                    [
                        'filename' => $context->dir . '/assets/theme-media-1.png', // The filename of the style's preview image
                        'width' => 1000, // The width of the image
                        'height' => 750 // The height of the image
                    ]
                ];
                $style->values = $getDefaultStyleValues(); // The helper function is used to return the values for the first style.
                $styles[] = $style;

                // Define the second style
                $style = $theme->makeStyle();
                $style->media = [
                    [
                        'filename' => $context->dir . '/assets/theme-media-2.png',
                        'width' => 1000,
                        'height' => 750
                    ]
                ];
                $style->values = [
                    'backgroundColor' => '#044418',
                    'textColor' => '#ffffff'
                ];
                $styles[] = $style;

                // Define the third style
                $style = $theme->makeStyle();
                $style->media = [
                    [
                        'filename' => $context->dir . '/assets/theme-media-3.png',
                        'width' => 1000,
                        'height' => 750
                    ]
                ];
                $style->values = [
                    'backgroundColor' => '#f5f5f5',
                    'textColor' => '#000000'
                ];
                $styles[] = $style;

                // Return the styles list.
                return $styles;
            };
        });
