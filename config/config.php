<?php

declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_NAME = 'prolux';
const DB_USER = 'root';
const DB_PASS = '';
const APP_NAME = 'ProLux';

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$publicPosition = strpos($scriptName, '/public/');
$baseUrl = $publicPosition === false ? '' : substr($scriptName, 0, $publicPosition + 7);

define('BASE_URL', rtrim($baseUrl, '/'));
