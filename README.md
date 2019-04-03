# Bear CMS demos repository

This repository contains some simple Bear CMS applications, that will help you learn to code for Bear CMS. You can download the whole repo as a ZIP archive and extract it locally. To run it you will need a web server (NGINX or Apache) and PHP version 7.1 (or higher).

## How to run a demo
1. Get an application secret key from [bearcms.com](https://bearcms.com/). [Learn more](https://bearcms.com/support/register-your-new-website/).
2. Update the `BEARCMS_APP_SECRET_KEY` constant located at `path-to-the-demo/public/index.php`
3. Run `composer install` in the demo directory (`path-to-the-demo/`).
4. Open `http://localhost/path-to-the-demo/public/index.php` in your browser.
Every demo application comes with an administrator user already set up so you can log in by opening `http://localhost/path-to-the-demo/public/index.php/admin` and using the email `demo@example.com` and the password `123456`.

## Available demos

### [Make a theme](https://github.com/bearcms/demos/tree/master/make-a-theme)
This demo will teach you how to create your own Bear CMS theme. More information is available at [https://bearcms.com/support/make-a-theme/](https://bearcms.com/support/make-a-theme/)

### [Access the data](https://github.com/bearcms/demos/tree/master/access-the-data)
The website administrators will use the CMS UI to manage pages, text, images, blog posts, etc. You as developer can access the data they've created to build something more complex. More information is available at [https://bearcms.com/support/access-the-data/](https://bearcms.com/support/access-the-data/)

### [Use custom elements](https://github.com/bearcms/demos/tree/master/use-custom-elements)
Bear CMS provides custom HTML elements (that are processed to valid HTML tags on the server) that you can use to define the content structure of a page. For example, you can specify an image (and set its default value) and later administrators can change it. More information is available at [https://bearcms.com/support/use-custom-elements/](https://bearcms.com/support/use-custom-elements/)


## Contact us
This demos are created and maintained by the Bear CMS team. Feel free to contact us at support@bearcms.com or [bearcms.com](https://bearcms.com/).