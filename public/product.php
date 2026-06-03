<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Light;

$light = (new Light())->find((int) ($_GET['id'] ?? 0));

if (!$light) {
    http_response_code(404);
    exit('Produkt neexistuje.');
}

$title = $light['name'] . ' | ProLux';
require __DIR__ . '/partials/header.php';
?>

<section class="detail-layout">
    <img class="detail-image" src="<?= e($light['image_url']) ?>" alt="<?= e($light['name']) ?>">
    <div class="detail-panel">
        <span class="tag"><?= e($light['manufacturer_name']) ?></span>
        <h1><?= e($light['name']) ?></h1>
        <p><?= e($light['description']) ?></p>
        <dl class="specs">
            <div><dt>Kategoria</dt><dd><?= e($light['category']) ?></dd></div>
            <div><dt>Vykon</dt><dd><?= (int) $light['power_w'] ?> W</dd></div>
            <div><dt>Skladom</dt><dd><?= (int) $light['stock'] ?> ks</dd></div>
            <div><dt>Cena</dt><dd><?= number_format((float) $light['rental_price'], 2, ',', ' ') ?> € / den</dd></div>
        </dl>
        <a class="button primary" href="<?= BASE_URL ?>/contact.php">Dopytovat techniku</a>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
