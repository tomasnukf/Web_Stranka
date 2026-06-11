<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Manufacturer;
use App\Security\Auth;
use App\Security\Csrf;

// Uj svetlo pridanie: admin autorizacia.
Auth::requireAdmin();

$title = 'Pridat svetlo | ProLux';
$manufacturers = (new Manufacturer())->all();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Urlap biztonsagi token ellenorzese.
    if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Neplatny bezpecnostny token.';
    }

    // Minimalis validacio: nazov je povinny.
    if (trim($_POST['name'] ?? '') === '') {
        $errors[] = 'Nazov svetla je povinny.';
    }

    if (!$errors) {
        // Light model vytvori novy zaznam v databaze.
        (new Light())->create($_POST);
        redirect('/admin/products.php');
    }
}

// Predvolene hodnoty pre prazdny formular.
$light = [
    'manufacturer_id' => $manufacturers[0]['id'] ?? 1,
    'name' => '',
    'category' => '',
    'power_w' => 0,
    'rental_price' => 0,
    'stock' => 1,
    'image_url' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=900&q=80',
    'description' => '',
    'active' => 1,
];

require __DIR__ . '/../partials/header.php';
require __DIR__ . '/product-form.php';
require __DIR__ . '/../partials/footer.php';
