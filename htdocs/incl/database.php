<?php
define("FIND_DB_PATH", realpath(__DIR__ . "/../../../../../"));
$find_db = FIND_DB_PATH . "/data/db.sqlite";
return [
    "dsn"             => "sqlite:" . $find_db,
    "username"        => null,
    "password"        => null,
    "driver_options"  => null,
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",

    // True to be very verbose during development
    "verbose"         => null,

    // True to be verbose on connection failed
    "debug_connect"   => false,
];
