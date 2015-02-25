# Herbert: The WordPress Plugin Framework

## Getting Started

Welcome, Herbert is a plugin framework for WordPress. We believe the current approach to building plugins is unorganised and difficult to understand. It makes working in teams or taking over from a previous developer time consuming. Its early days for Herbert but our aim is to solve this.

### Installation

Once Composer is installed, download the latest version of the Herbert framework and extract its contents into a directory on your server. Next, in the root of your plugin, run the php composer.phar install (or composer install) command to install all of the framework's dependencies. This process requires Git to be installed on the server to successfully complete the installation.

### Working with WordPress

Developing a plugin using Herbert should happen outside of your WordPress install. As in:

***WordPress Install***

    /path/to/sites/wordpress/wp-content/plugins/plugin-name

***Plugin***

    /path/to/projects/plugin-name
    
To achieve this we use a Symbolic Link.

    ln -s /path/to/projects/plugin-name /path/to/sites/wordpress/wp-content/plugins/plugin-name

### Naming your Plugin

Open the ``plugin.php`` and you will see a comment at the top where you set several settings. As standard it looks like so:

    /**
     * @wordpress-plugin
     * Plugin Name:       Plugin Name
     * Plugin URI:        http://plugin-name.com/
     * Description:       A plugin.
     * Version:           1.0.0
     * Author:            Author
     * Author URI:        http://author.com/
     * License:           MIT
     */

## Routes

### Basic Routing

Routes for your plugin will be defined in the ``plugin/routes.php`` file. Herbert routes consist of a Name, URI and a Closure callback. The URI will be appended to the site url, for example: ``http://example.com/simple``

#### Basic GET Route

    $plugin->route->get([
        'as'   => 'simpleRoute',
        'uri'  => '/simple'
    ], function() {
        return 'Hello World';
    });

#### Basic POST Route

    $plugin->route->post([
        'as'   => 'simpleRoute',
        'uri'  => '/simple'
    ], function() {
        return 'Hello World';
    });
    
#### Support for PUT & DELETE

Most browsers don't support ``PUT`` & ``DELETE`` yet so its recommended you avoid using these methods.

    $plugin->route->put();
    $plugin->route->delete();
    
#### Accessing Framework methods within the Closure

    $plugin->route->get([
        'as'   => 'simpleRoute',
        'uri'  => '/simple'
    ], function() use ($plugin) {
        return $plugin->response->json(['hello' => 'world']);
    });

#### Route Parameters

You can set route parameters in your URI by defining as ``:param``. These parameters then be accessed by your Closure or Controller as ``$param``

    $plugin->route->get([
        'as'   => 'userProfile',
        'uri'  => '/user/:id'
    ], function($id) {
        return 'User ' . $id;
    });

#### Routing To Controllers

Herbert allows you to not only route to Closures, but also to controller classes, visit the documentation on Controllers for more details.

    $plugin->route->get([
        'as'   => 'userProfile',
        'uri'  => '/user/:id'
    ], 'UserController@profile');

## Panels

### Main Panels

Panels (or menus) for your plugin will be defined in the ``plugin/panels.php`` file. Herbert panels refer to an option in left sidebar of WordPress admin area. They consist of a Type, Name, Title, Slug and a Closure callback. The Slug will be appended to the site admin url, for example: ``http://example.com/wp-admin/admin.php?page=myplugin-index``

#### Main Panel using Closure

    $plugin->panel->add([
        'type'   => 'panel',
        'as'     => 'mainPanel',
        'title'  => 'My Plugin',
        'slug'   => 'myplugin-index'
    ], function() use ($plugin) {
        return 'Hello World';
    });

#### Main Panel using a Controller

    $plugin->panel->add([
        'type'   => 'panel',
        'as'     => 'mainPanel',
        'title'  => 'My Plugin',
        'slug'   => 'myplugin-index'
    ], 'AdminController@index');

#### Supplying an Icon

Panels support four different icon methods, each detailed below:

    'dashicons-media-audio' //Dashicons Class
    'none' //Styleable Div
    '/img/icon.png' //Relative Path
    '//site.com/icon.png' //HTTP
    
Below is an example using ``dashicons``

    $plugin->panel->add([
        'type'   => 'panel',
        'as'     => 'mainPanel',
        'title'  => 'My Plugin',
        'slug'   => 'myplugin-index',
        'icon'   => 'dashicons-media-audio'
    ], 'AdminController@index');

#### Subpanels

If you require more than one panel for your plugin you may decided to add them as subpanel:

    My Plugin
    ├── Configure
    ├── Update

To add a subpanel, you set its Type to ``subpanel`` and supply a Parent Name.

    $plugin->panel->add([
        'type'   => 'subpanel',
        'parent' => 'mainPanel',
        'as'     => 'configure',
        'title'  => 'Configure',
        'slug'   => 'myplugin-configure'
    ], 'AdminController@configure');

#### Renaming the Root Subpanel

You will notice if you add the first subpanel that WordPress will automatically insert a subpanel named the same as parent:

    My Plugin
    ├── My Plugin
    ├── Configure

To rename this just supply the Name of the parent and the new Title

    $plugin->panel->renameDefaultSubpanel([
        'default' => 'mainPanel',
        'title'   => 'General'
    ]);

#### WordPress Subpanels

If you require a subpanel under one of the standard WordPress panels, for example:

    Dashboard
    ├── Home
    ├── Updates
    ├── Your Subpanel
    
To add a WordPress subpanel, you set its Type to ``wp-subpanel`` and supply a Parent Name.

    $plugin->panel->add([
        'type'   => 'wp-subpanel',
        'parent' => 'index.php',
        'as'     => 'dashboardSubpanel',
        'title'  => 'Your Subpanel'
        'slug'   => 'myplugin-dashboard'
        ], 'AdminController@dashboard');

There is 12 different types of WordPress panels which you can supply as a Parent Name:

    Dashboard: 'index.php'
    Posts: 'edit.php'
    Media: 'upload.php'
    Links: 'link-manager.php'
    Pages: 'edit.php?post_type=page'
    Comments:'edit-comments.php'
    Custom Post Types: 'edit.php?post_type=your_post_type'
    Appearance: 'themes.php'
    Plugins: 'plugins.php'
    Users: 'users.php'
    Tools: 'tools.php'
    Settings: 'options-general.php'

