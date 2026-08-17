<?php
// app/config/config.php

function loadEnv(string $path): void
{
    if (!is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }
        putenv($line);
    }
}

loadEnv(dirname(__DIR__, 2) . '/.env');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'techdonaciones');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') === false ? 'Derecktiti12345@' : getenv('DB_PASS'));
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8');

define('APP_PATH', dirname(__DIR__) . '/');
define('VIEW_PATH', APP_PATH . 'views/');
define('LAYOUT_PATH', VIEW_PATH . 'layouts/');
define('BASE_URL', 'http://localhost:8080/proyecto-programacion-web/');