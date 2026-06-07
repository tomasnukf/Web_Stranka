<?php

require_once __DIR__ . '/../src/Bootstrap.php';

use App\Model\Inquiry;
use App\Security\Csrf;

$title = 'Kontakt | ProLux';
$sent = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Neplatny bezpecnostny token.';
    }

    if (trim($_POST['name'] ?? '') === '') {
        $errors[] = 'Meno je povinne.';
    }

    if (!filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email nie je platny.';
    }

    if (trim($_POST['message'] ?? '') === '') {
        $errors[] = 'Sprava je povinna.';
    }

    if (!$errors) {
        (new Inquiry())->create($_POST);
        $sent = true;
        $_POST = [];
    }
}

require __DIR__ . '/partials/header.php';
?>

<section class="page-hero compact">
    <p class="eyebrow">Kontakt</p>
    <h1>Dopyt na techniku</h1>
    <p>Napiste typ eventu, datum, miesto a priblizny pocet svetiel. ProLux pripravi ponuku prenajmu.</p>
</section>

<section class="contact-layout">
    <form class="form-card" method="post">
        <input type="hidden" name="csrf_token" value="<?= e(Csrf::token()) ?>">
        <?php if ($sent): ?>
            <div class="notice">Dakujeme, dopyt bol odoslany. Najdes ho v administracii v sekcii Dopyty.</div>
        <?php endif; ?>
        <?php foreach ($errors as $error): ?>
            <div class="notice danger"><?= e($error) ?></div>
        <?php endforeach; ?>
        <label>Meno
            <input name="name" value="<?= e($_POST['name'] ?? '') ?>" required>
        </label>
        <label>Email
            <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" required>
        </label>
        <label>Telefon
            <input name="phone" value="<?= e($_POST['phone'] ?? '') ?>">
        </label>
        <label>Datum podujatia
            <input type="date" name="event_date" value="<?= e($_POST['event_date'] ?? '') ?>">
        </label>
        <label>Sprava
            <textarea name="message" rows="6" required><?= e($_POST['message'] ?? '') ?></textarea>
        </label>
        <button class="button primary" type="submit">Odoslat dopyt</button>
    </form>
    <aside class="contact-info">
        <h2>ProLux stage lighting</h2>
        <p>Email: info@prolux.sk</p>
        <p>Telefon: +421 904 001 907</p>
        <p>Sluzby: koncerty, kluby, festivaly, firemne akcie, divadla.</p>
    </aside>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
