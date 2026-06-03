<?php

require_once __DIR__ . '/../src/Bootstrap.php';

$title = 'Kontakt | ProLux';
$sent = $_SERVER['REQUEST_METHOD'] === 'POST';

require __DIR__ . '/partials/header.php';
?>

<section class="page-hero compact">
    <p class="eyebrow">Kontakt</p>
    <h1>Dopyt na techniku</h1>
    <p>Napiste typ eventu, datum, miesto a priblizny pocet svetiel. ProLux pripravi ponuku prenajmu.</p>
</section>

<section class="contact-layout">
    <form class="form-card" method="post">
        <?php if ($sent): ?>
            <div class="notice">Dakujeme, dopyt bol odoslany ukazkovo. Pre realne odosielanie mozes doplnit ulozenie do databazy alebo email.</div>
        <?php endif; ?>
        <label>Meno
            <input name="name" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Sprava
            <textarea name="message" rows="6" required></textarea>
        </label>
        <button class="button primary" type="submit">Odoslat dopyt</button>
    </form>
    <aside class="contact-info">
        <h2>ProLux stage lighting</h2>
        <p>Email: info@prolux.sk</p>
        <p>Telefon: +421 900 123 456</p>
        <p>Sluzby: koncerty, kluby, festivaly, firemne akcie, divadla.</p>
    </aside>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
