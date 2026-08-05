<?php

// Single entry point for the DB connection.
// Credentials come from the .env file at the proyect root, not tracked by git.
// Copy .env.example to .env and fill it in.

$envPath = dirname(__DIR__) . '/.env';

if (!is_readable($envPath)) { 
    die('Missing .env file. Copy .env.example to .env and fill in your credentials.');
}

$env = parse_ini_file($envPath);

try { 
    $conn = mysqli_init();

    // MYSQLI_CLIENT_FOUND_ROWS makes affected_rows report the rows that matched
    // the WHERE clause instead of the rows whose values actually changed. Without
    // it, saving a review without editing anything reports 0 rows and is
    // indistinguishable from trying to edit someone else's review.
    $conn -> real_connect($env['DB_HOST'],
        $env['DB_USER'],
        $env['DB_PASS'],
        $env['DB_NAME'],
        null,
        null,
        MYSQLI_CLIENT_FOUND_ROWS
    );

    $conn -> set_charset('utf8mb4');

} catch (mysqli_sql_exception $e){ 
    die('Database connection failed.');
}