<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Light;
use App\Model\Inquiry;
use App\Security\Auth;

Auth::requireAdmin();

$title = 'Admin dashboard | ProLux';
$lights = (new Light())->all();
$newInquiries = (new Inquiry())->countNew();

require __DIR__ . '/../partials/header.php';
?>

<section class="admin-layout">
    <aside class="admin-sidebar">
        <strong>ProLux admin</strong>
        <a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a>
        <a href="<?= BASE_URL ?>/admin/products.php">CRUD svetiel</a>
        <a href="<?= BASE_URL ?>/admin/inquiries.php">Dopyty</a>
        <a href="<?= BASE_URL ?>/admin/logout.php">Odhlasit</a>
    </aside>
    <div class="admin-content">
        <p class="eyebrow">Vitaj, <?= e($_SESSION['admin_name'] ?? 'admin') ?></p>
        <h1>Administracia</h1>
        <div class="stat-grid">
            <div class="stat-card">
                <span>Pocet svetiel</span>
                <strong><?= count($lights) ?></strong>
            </div>
            <div class="stat-card">
                <span>Nove dopyty</span>
                <strong><?= $newInquiries ?></strong>
            </div>
            <div class="stat-card">
                <span>Backend</span>
                <strong>PHP OOP</strong>
            </div>
        </div>
        <a class="button primary" href="<?= BASE_URL ?>/admin/products.php">Spravovat svetla</a>
        <a class="button" href="<?= BASE_URL ?>/admin/inquiries.php">Zobrazit dopyty</a>
    </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
