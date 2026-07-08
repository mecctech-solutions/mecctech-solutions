<?php

use App\Mcp\Servers\BlogServer;
use Laravel\Mcp\Server\Facades\Mcp;

Mcp::web('blog', BlogServer::class)
    ->middleware('auth:sanctum');
