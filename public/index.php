<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Manufacturer;

// Fooldal: gyartok es kiemelt svetla betoltese adatbazisbol.
$title = 'ProLux | Rentovanie stage lighting techniky';
$manufacturers = (new Manufacturer())->all();
$featuredLights = (new Light())->featured(6);

require __DIR__ . '/partials/header.php';
?>

<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Festivaly, koncerty, eventy</p>
        <h1>ProLux</h1>
        <p>Profesionalna stage lighting show, technika a produkcne riesenia pre podujatia, ktore maju vyzerat silno uz od prveho momentu.</p>
        <div class="hero-actions">
            <a class="button primary" href="<?= BASE_URL ?>/products.php">Pozriet ponuku</a>
            <a class="button ghost" href="<?= BASE_URL ?>/contact.php">Nezavazny dopyt</a>
        </div>
    </div>
</section>

<section class="section service-intro">
    <div>
        <p class="eyebrow">Co ponukame</p>
        <h2>Profesionalna montaz stageov, svetiel a osvetlenie vasich podujati</h2>
    </div>
    <div class="service-grid">
        <article>
            <h3>Stage a rampy</h3>
            <p>Navrhneme a pripravime svetelne rampy, truss konstrukcie a stage riesenie podla velkosti priestoru.</p>
        </article>
        <article>
            <h3>Svetelna technika</h3>
            <p>Dodame beam, wash, spot, blinder, LED bary a hazery od vyrobcov Robe, Martin, Showtek, ADJ a DTS.</p>
        </article>
        <article>
            <h3>Osvetlenie eventu</h3>
            <p>Zabezpecime koncerty, festivaly, firemne akcie, kluby, plesy aj sukromne podujatia vratane technickej obsluhy.</p>
        </article>
    </div>
</section>

<section class="section split">
    <div>
        <p class="eyebrow">Ponuka znaciek</p>
        <h2>Spolupraca s vyrobcami</h2>
        <p>Produkty su nacitane dynamicky z databazy. V administracii mozes svetla pridavat, upravovat aj mazat.</p>
    </div>
    <div class="brand-grid">
        <?php // Gyarto csempek dinamikusan az adatbazisbol. ?>
        <?php foreach ($manufacturers as $manufacturer): ?>
            <a href="<?= BASE_URL ?>/products.php?manufacturer=<?= (int) $manufacturer['id'] ?>" class="brand-tile">
                <?= e($manufacturer['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="photo-strip" aria-label="Stage lighting ukazky">
    <img src="https://www.pulse-me.com/web/image/product.brand/417/logo" alt="MA Lighting logo">
    <img src="https://cdn.ecommercedns.uk/files/2/252792/0/37681080/avolites-logo-wine.png" alt="Avolites logo">
    <img src="https://cdn.shopify.com/s/files/1/0447/0413/7384/files/chamsys_logo_08dbfe95-9939-4107-829f-bc5f4a94853b.png?v=1733105549" alt="ChamSys logo">
</section>

<section class="section package-teaser">
    <div>
        <p class="eyebrow">Hotove zostavy</p>
        <h2>Balicky pre stage aj svetelne rampy</h2>
        <p>Ak zakaznik nechce vyberat jednotlive svetla, moze zvolit hotovy balik od 10 000 EUR. Najvacsi balik obsahuje 40 beam, 30 wash, 20 spot svetiel a 2 hazery.</p>
    </div>
    <a class="button primary" href="<?= BASE_URL ?>/packages.php">Pozriet balicky</a>
</section>

<section class="section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Vybrane svetla</p>
            <h2>Technika pripravena na prenajom</h2>
        </div>
        <a class="button small" href="<?= BASE_URL ?>/products.php">Cela ponuka</a>
    </div>
    <div class="product-grid">
        <?php // Kiemelt termekek dinamikus kiirasa. ?>
        <?php foreach ($featuredLights as $light): ?>
            <article class="product-card">
                <img src="<?= e($light['image_url']) ?>" alt="<?= e($light['name']) ?>">
                <div>
                    <span class="tag"><?= e($light['manufacturer_name']) ?></span>
                    <h3><?= e($light['name']) ?></h3>
                    <p><?= e($light['category']) ?> · <?= (int) $light['power_w'] ?> W</p>
                    <strong><?= number_format((float) $light['rental_price'], 2, ',', ' ') ?> EUR / den</strong>
                    <a href="<?= BASE_URL ?>/product.php?id=<?= (int) $light['id'] ?>">Detail</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
