<?php

/**
 * Ziggy - Use your Laravel Named Routes inside JavaScript
 * 
 * Creates a Blade directive which you can include in your views. 
 * This will export a JavaScript object of your application's named routes, 
 * keyed by their names (aliases), as well as a global route() helper function 
 * which you can use to access your routes in your JavaScript.
 * 
 * https://github.com/tightenco/ziggy
 */

return [
    // 'whitelist' => [],
    'blacklist' => ['debugbar.*'],
    'groups' => [
        'admin' => [
            'admin.*',
        ],
        'front' => [
            'front.*',
        ]
    ],
];