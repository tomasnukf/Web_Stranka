<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Light;
use App\Security\Auth;
use App\Security\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Csrf::validate($_POST['csrf_token'] ?? null)) {
    (new Light())->delete((int) ($_POST['id'] ?? 0));
}

redirect('/admin/products.php');
