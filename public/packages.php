<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Package;

$title = 'Balicky stage lighting | ProLux';
$packages = (new Package())->all();

require __DIR__ . '/partials/header.php';
?>

<section class="page-hero packages-hero compact">
    <p class="eyebrow">Kompletne riesenia</p>
    <h1>Stage lighting balicky</h1>
    <p>Tri hotove konfiguracie od velkej koncertnej produkcie po mensi event. Ceny su zoradene od najdrahsej po najlacnejsiu.</p>
</section>

<section class="section">
    <div class="package-list">
        <?php foreach ($packages as $package): ?>
            <article class="package-card">
                <img src="<?= e($package['image_url']) ?>" alt="<?= e($package['name']) ?>">
                <div class="package-body">
                    <div class="package-top">
                        <div>
                            <span class="tag"><?= e($package['category']) ?></span>
                            <h2><?= e($package['name']) ?></h2>
                        </div>
                        <strong class="package-price"><?= number_format((float) $package['price'], 0, ',', ' ') ?> EUR</strong>
                    </div>
                    <p><?= e($package['description']) ?></p>
                    <div class="package-specs">
                        <div><span>Beam</span><strong><?= (int) $package['beam_count'] ?> ks</strong></div>
                        <div><span>Wash</span><strong><?= (int) $package['wash_count'] ?> ks</strong></div>
                        <div><span>Spot</span><strong><?= (int) $package['spot_count'] ?> ks</strong></div>
                        <div><span>Hazer</span><strong><?= (int) $package['hazer_count'] ?> ks</strong></div>
                        <div><span>Rampy</span><strong><?= (int) $package['truss_meters'] ?> m</strong></div>
                        <div><span>Technici</span><strong><?= (int) $package['crew_count'] ?></strong></div>
                    </div>
                    <a class="button primary" href="<?= BASE_URL ?>/contact.php">Dopytovat balik</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
