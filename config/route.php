<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // Add routes from commController and mount on comm/
            "mount" => "comm",
            "file" => __DIR__ . "/route/commController.php",
        ],
    ],
];
