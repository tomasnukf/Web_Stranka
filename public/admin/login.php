<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Security\Auth;
use App\Security\Csrf;

// Ha az admin mar be van jelentkezve, nem kell ujra login.
if (Auth::check()) {
    redirect('/admin/index.php');
}

$title = 'Admin prihlasenie | ProLux';
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Login urlap CSRF ellenorzese.
    if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
        $error = 'Neplatny bezpecnostny token.';
    } elseif ((new Auth())->attempt($_POST['email'] ?? '', $_POST['password'] ?? '')) {
        // Sikeres bejelentkezes utan admin dashboard.
        redirect('/admin/index.php');
    } else {
        $error = 'Nespravny email alebo heslo.';
    }
}

require __DIR__ . '/../partials/header.php';
?>

<section class="auth-screen">
    <form class="form-card auth-card" method="post">
        <?php // Token ved a hamis login kuldes ellen. ?>
        <input type="hidden" name="csrf_token" value="<?= e(Csrf::token()) ?>">
        <p class="eyebrow">Administracia</p>
        <h1>Prihlasenie</h1>
        <?php if ($error): ?>
            <div class="notice danger"><?= e($error) ?></div>
        <?php endif; ?>
        <label>Email
            <input type="email" name="email" value="admin@prolux.sk" required>
        </label>
        <label>Heslo
            <input type="password" name="password" required>
        </label>
        <button class="button primary" type="submit">Prihlasit sa</button>
    </form>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
