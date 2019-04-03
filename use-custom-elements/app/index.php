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

// Request a context object. It will be useful below.
$context = $app->contexts->get();

$context->assets
        ->addDir('assets'); // Make the assets/ directory public.

// Let's create a home page that will render some Bear CMS custom elements.
$app->routes
        ->add('/', function() use ($app, $context) {
            $response = new App\Response\HTML(); // Create a new HTML response.

            $html = ''; // A string that will contain the response HTML code.
            
            // Below you will find a list of Bear CMS elements. The 'id' and 'editable' attributes are required if you want to enable administrators to make changes.

            // A heading element. The size attribute is set ot "large". This is the default value, so you can skip it.
            $html .= '<bearcms-heading-element text="Large heading" id="element-1" editable="true" size="large"/><br>';
            
            // A heading element. The size attribute is set ot "medium".
            $html .= '<bearcms-heading-element text="Medium heading" id="element-2" editable="true" size="medium"/><br>';
            
            // A heading element. The size attribute is set ot "small".
            $html .= '<bearcms-heading-element text="Small heading" id="element-3" editable="true" size="small"/><br>';
            
            // A text element.
            $html .= '<bearcms-text-element text="Some text" id="element-4" editable="true"/><br>';
            
            // A link element.
            $html .= '<bearcms-link-element url="https://bearcms.com/" text="A link" title="A link to bearcms.com" id="element-5" editable="true"/><br>';
            
            // An image element.
            $html .= '<bearcms-image-element onClick="fullscreen" filename="'. $context->dir .'/assets/example.jpg" id="element-6" editable="true"/><br>';
            
            // An image gallery element.
            $html .= '<bearcms-image-gallery-element id="element-6" editable="true">'
                    . '<file filename="'. $context->dir .'/assets/example.jpg">'
                    . '<file filename="'. $context->dir .'/assets/example.jpg">'
                    . '<file filename="'. $context->dir .'/assets/example.jpg">'
                    . '</bearcms-image-gallery-element><br>';
            
            // A video element.
            $html .= '<bearcms-video-element url="https://www.youtube.com/watch?v=nKIu9yen5nc" id="element-7" editable="true"/><br>';
            
            // A navigation element.
            $html .= '<bearcms-navigation-element source="topPages" id="element-8" editable="true"/><br>';
            
            // An HTML code element.
            $html .= '<bearcms-html-element code="'. htmlentities('<div style="color:red;">This is HTML</div>').'" id="element-9" editable="true"/><br>';
            
            // A blog posts element.
            $html .= '<bearcms-blog-posts-element source="allPosts" id="element-10" editable="true"/><br>';
            
            // A comments element.
            $html .= '<bearcms-comments-element threadID="thread-1" id="element-10" editable="true"/><br>';

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
