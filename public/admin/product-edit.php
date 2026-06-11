<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Manufacturer;
use App\Security\Auth;
use App\Security\Csrf;

// Uprava svetla je pristupna iba adminovi.
Auth::requireAdmin();

$model = new Light();
// Edituje sa konkretne svetlo podla ID z URL.
$light = $model->find((int) ($_GET['id'] ?? 0));

if (!$light) {
    http_response_code(404);
    exit('Svetlo neexistuje.');
}

$title = 'Upravit svetlo | ProLux';
$manufacturers = (new Manufacturer())->all();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF kontrola chrani formular pred cudzim odoslanim.
    if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Neplatny bezpecnostny token.';
    }

    if (trim($_POST['name'] ?? '') === '') {
        $errors[] = 'Nazov svetla je povinny.';
    }

    if (!$errors) {
        // Update ulozi zmenene udaje do tabulky lights.
        $model->update((int) $light['id'], $_POST);
        redirect('/admin/products.php');
    }

    // Pri chybe ostanu vo formulari zadane hodnoty.
    $light = array_merge($light, $_POST);
}

require __DIR__ . '/../partials/header.php';
require __DIR__ . '/product-form.php';
require __DIR__ . '/../partials/footer.php';
