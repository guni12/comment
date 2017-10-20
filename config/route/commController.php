<?php
/**
 * Routes for controller.
 */
return [
    "mount" => "comm",
    "routes" => [
        [
            "info" => "Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commController", "getIndex"],
        ],
        [
            "info" => "Create an item.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["commController", "getPostCreateItem"],
        ],
        [
            "info" => "Create a comment.",
            "requestMethod" => "get|post",
            "path" => "create/{id:digit}",
            "callable" => ["commController", "getPostCreateItem"],
        ],
        [
            "info" => "Delete an item.",
            "requestMethod" => "get|post",
            "path" => "delete/{id:digit}",
            "callable" => ["commController", "getPostDeleteItem"],
        ],
        [
            "info" => "Delete an item.",
            "requestMethod" => "get|post",
            "path" => "admindelete",
            "callable" => ["commController", "getPostAdminDeleteItem"],
        ],
        [
            "info" => "Update an item.",
            "requestMethod" => "get|post",
            "path" => "update/{id:digit}",
            "callable" => ["commController", "getPostUpdateItem"],
        ],
        [
            "info" => "See an item.",
            "requestMethod" => "get|post",
            "path" => "view-one/{id:digit}",
            "callable" => ["commController", "getPostShow"],
        ],
    ]
];
