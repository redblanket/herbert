<?php

return [

    /**
     * Auto-load all required files.
     */
    'requires' => [
        __DIR__ . '/herbert.php'
    ],

    /**
     * The routes to auto-load.
     */
    'routes' => [
        __DIR__ . '/routes.php'
    ],

    /**
     * The panels to auto-load.
     */
    'panels' => [
        __DIR__ . '/panels.php'
    ],

    /**
     * The shortcodes to auto-load.
     */
    'shortcodes' => [
        __DIR__ . '/shortcodes.php'
    ],

    /**
     * The widgets to auto-load.
     */
    'widgets' => [
        __DIR__ . '/widgets.php'
    ],

    /**
     * The widgets to auto-load.
     */
    'enqueue' => [
        __DIR__ . '/enqueue.php'
    ],

    /**
     * The APIs to auto-load.
     */
    'apis' => [
        'lorem_ipsum' => __DIR__ . '/api.php'
    ],

    /**
     * The view paths to register.
     *
     * E.G: 'lorem_ipsum' => __DIR__ . '/views'
     * can be referenced via @lorem_ipsum/
     * when rendering a view in twig.
     */
    'views' => [
        'lorem_ipsum' => __DIR__ . '/views'
    ],

];
