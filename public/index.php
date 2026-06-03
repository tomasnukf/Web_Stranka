<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Manufacturer;

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
        <h2>Oficialni vyrobcovia v nasej databaze</h2>
        <p>Produkty su nacitane dynamicky z databazy. V administracii mozes svetla pridavat, upravovat aj mazat.</p>
    </div>
    <div class="brand-grid">
        <?php foreach ($manufacturers as $manufacturer): ?>
            <a href="<?= BASE_URL ?>/products.php?manufacturer=<?= (int) $manufacturer['id'] ?>" class="brand-tile">
                <?= e($manufacturer['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="photo-strip" aria-label="Stage lighting ukazky">
    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=900&q=80" alt="Koncertne stage svetla">
    <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=900&q=80" alt="Festivalovy stage">
    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&w=900&q=80" alt="Hudobny koncert">
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
