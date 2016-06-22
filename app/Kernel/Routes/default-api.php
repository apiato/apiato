<?php

// Default root route
$router->any('/', function () {
    return response()->json(['Welcome to ' . env('API_NAME') . '.']);
});
