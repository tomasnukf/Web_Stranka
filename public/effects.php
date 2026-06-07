<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\SpecialEffect;

$title = 'Specialne efekty | ProLux';
$effects = (new SpecialEffect())->all();

require __DIR__ . '/partials/header.php';
?>

<section class="page-hero effects-hero compact">
    <p class="eyebrow">Show efekty</p>
    <h1>Specialne efekty</h1>
    <p>Confetti, CO2 dela, studene iskry, plamene, haze a laser show pre koncerty, festivaly, kluby aj firemne eventy.</p>
</section>

<section class="section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Doplnky ku stage lighting</p>
            <h2>Efekty, ktore zdvihnu energiu celej show</h2>
        </div>
        <a class="button primary small" href="<?= BASE_URL ?>/contact.php">Dopytovat efekty</a>
    </div>

    <div class="effects-grid">
        <?php foreach ($effects as $effect): ?>
            <article class="effect-card">
                <img src="<?= e($effect['image_url']) ?>" alt="<?= e($effect['name']) ?>">
                <div>
                    <span class="tag"><?= e($effect['category']) ?></span>
                    <h3><?= e($effect['name']) ?></h3>
                    <p><?= e($effect['description']) ?></p>
                    <?php if ((float) $effect['price'] > 0): ?>
                        <strong>od <?= number_format((float) $effect['price'], 0, ',', ' ') ?> EUR / <?= e($effect['unit']) ?></strong>
                    <?php else: ?>
                        <strong>Cena podla technickej specifikacie</strong>
                    <?php endif; ?>
                    <small><?= e($effect['safety_note']) ?></small>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section safety-band">
    <div>
        <p class="eyebrow">Bezpecnost</p>
        <h2>Efekty riesime s obsluhou a kontrolou priestoru</h2>
    </div>
    <p>Pri CO2, plamenoch, studenych iskrach a laseroch vzdy pocitame s bezpecnou vzdialenostou, technickou obsluhou a podmienkami miesta. Vdaka tomu sa efekt pouzije presne v momente, ked ma najvacsi dopad.</p>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
