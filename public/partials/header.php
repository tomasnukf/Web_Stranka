<?php
$currentPath = $_SERVER['SCRIPT_NAME'] ?? '';
?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= BASE_URL ?>/index.php">
        <span class="brand-mark">PL</span>
        <span>ProLux</span>
    </a>
    <button class="nav-toggle" type="button" aria-label="Menu" data-nav-toggle>Menu</button>
    <nav class="main-nav" data-nav>
        <a href="<?= BASE_URL ?>/index.php" class="<?= str_contains($currentPath, 'index.php') ? 'active' : '' ?>">Domov</a>
        <a href="<?= BASE_URL ?>/products.php" class="<?= str_contains($currentPath, 'products.php') ? 'active' : '' ?>">Svetla</a>
        <a href="<?= BASE_URL ?>/packages.php" class="<?= str_contains($currentPath, 'packages.php') ? 'active' : '' ?>">Balicky</a>
        <a href="<?= BASE_URL ?>/contact.php" class="<?= str_contains($currentPath, 'contact.php') ? 'active' : '' ?>">Kontakt</a>
        <a href="<?= BASE_URL ?>/admin/login.php">Admin</a>
    </nav>
</header>
<main>
