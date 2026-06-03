<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Light;
use App\Security\Auth;
use App\Security\Csrf;

Auth::requireAdmin();

$title = 'CRUD svetiel | ProLux';
$lights = (new Light())->all();

require __DIR__ . '/../partials/header.php';
?>

<section class="admin-layout">
    <aside class="admin-sidebar">
        <strong>ProLux admin</strong>
        <a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a>
        <a href="<?= BASE_URL ?>/admin/products.php">CRUD svetiel</a>
        <a href="<?= BASE_URL ?>/admin/logout.php">Odhlasit</a>
    </aside>
    <div class="admin-content">
        <div class="section-heading">
            <div>
                <p class="eyebrow">CRUD</p>
                <h1>Svetelna technika</h1>
            </div>
            <a class="button primary small" href="<?= BASE_URL ?>/admin/product-create.php">Pridat svetlo</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Vyrobca</th>
                    <th>Kategoria</th>
                    <th>Cena/den</th>
                    <th>Sklad</th>
                    <th>Akcie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lights as $light): ?>
                    <tr>
                        <td><?= e($light['name']) ?></td>
                        <td><?= e($light['manufacturer_name']) ?></td>
                        <td><?= e($light['category']) ?></td>
                        <td><?= number_format((float) $light['rental_price'], 2, ',', ' ') ?> €</td>
                        <td><?= (int) $light['stock'] ?> ks</td>
                        <td class="actions">
                            <a href="<?= BASE_URL ?>/admin/product-edit.php?id=<?= (int) $light['id'] ?>">Upravit</a>
                            <form method="post" action="<?= BASE_URL ?>/admin/product-delete.php" onsubmit="return confirm('Naozaj vymazat svetlo?')">
                                <input type="hidden" name="csrf_token" value="<?= e(Csrf::token()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $light['id'] ?>">
                                <button type="submit">Vymazat</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
