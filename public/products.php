<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Manufacturer;

// Ponuka svetiel: a lista gyarto szerint szurheto.
$title = 'Ponuka svetiel | ProLux';
$manufacturerId = isset($_GET['manufacturer']) ? (int) $_GET['manufacturer'] : null;
$manufacturers = (new Manufacturer())->all();
$lights = (new Light())->all($manufacturerId ?: null);

require __DIR__ . '/partials/header.php';
?>

<section class="page-hero compact">
    <p class="eyebrow">Prenajom svetelnej techniky</p>
    <h1>Ponuka svetiel</h1>
    <p>Filtrovanie podla vyrobcu je dynamicke a nacitava produkty priamo z databazy.</p>
</section>

<section class="section">
    <div class="filters">
        <a class="<?= $manufacturerId === null ? 'selected' : '' ?>" href="<?= BASE_URL ?>/products.php">Vsetko</a>
        <?php // Szuro linkek minden gyartohoz. ?>
        <?php foreach ($manufacturers as $manufacturer): ?>
            <a class="<?= $manufacturerId === (int) $manufacturer['id'] ? 'selected' : '' ?>" href="<?= BASE_URL ?>/products.php?manufacturer=<?= (int) $manufacturer['id'] ?>">
                <?= e($manufacturer['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="product-grid">
        <?php // Termek kartyak a Light modelbol kapott adatokbol. ?>
        <?php foreach ($lights as $light): ?>
            <article class="product-card">
                <img src="<?= e($light['image_url']) ?>" alt="<?= e($light['name']) ?>">
                <div>
                    <span class="tag"><?= e($light['manufacturer_name']) ?></span>
                    <h3><?= e($light['name']) ?></h3>
                    <p><?= e($light['description']) ?></p>
                    <strong><?= number_format((float) $light['rental_price'], 2, ',', ' ') ?> € / den</strong>
                    <a href="<?= BASE_URL ?>/product.php?id=<?= (int) $light['id'] ?>">Detail svetla</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
