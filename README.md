alphasmanifesto
===============

Wordpress theme for Alpha's Manifesto. You can see it live working on [http://blog.alphasmanifesto.com](http://blog.alphasmanifesto.com). More info to come later.

## Configuring the dock menu

The dock menu at the bottom can be configured through the `Themes` -> `Appearance` -> `Menus` option in the Wordpress admin section.

### Image configuration

After a menu is created and assigned to the available place for the theme, you can add links into it. For these links to be displayed in the dock menu you will need to also complete the `Image URL` field in the menu item edition. This Image URL field should contain the absolute or relative path to the place where your image files are hosted. If you are not sure on the relative path part, you just need to know that whatever you include in this field will be used for the `src` attribute of the images.

The images are recommended to be 128 pixels x 128 pixels, althgouth they will be shrinked down to 48 x 48 dynamically in order to create the animation and still look good while the image is made large again.

## Custom fields

This theme makes use of the `subtitle` custom field on each of the posts. The subtitle appears next to the title of each of the posts, and as a sub-header to the page when seeing a post page. If this field is left empty, nothing is shown.

## Third Party Libraries

Libraries used in this theme:

* [jquery](http://jquery.com/)
* [jqDock](http://www.wizzud.com/jqdock/)
* [1140 CSS Grid](http://cssgrid.net/)
* [Eric Meyer's Reset CSS](http://meyerweb.com/eric/tools/css/reset/)
