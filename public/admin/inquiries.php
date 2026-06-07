<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Model\Inquiry;
use App\Security\Auth;
use App\Security\Csrf;

Auth::requireAdmin();

$model = new Inquiry();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Csrf::validate($_POST['csrf_token'] ?? null)) {
    $id = (int) ($_POST['id'] ?? 0);

    if (($_POST['action'] ?? '') === 'done') {
        $model->markDone($id);
    }

    if (($_POST['action'] ?? '') === 'delete') {
        $model->delete($id);
    }

    redirect('/admin/inquiries.php');
}

$title = 'Dopyty | ProLux';
$inquiries = $model->all();

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
        <div class="section-heading">
            <div>
                <p class="eyebrow">Objednavky a dopyty</p>
                <h1>Dopyty zakaznikov</h1>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Stav</th>
                    <th>Meno</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Datum eventu</th>
                    <th>Sprava</th>
                    <th>Odoslane</th>
                    <th>Akcie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td><span class="status <?= e($inquiry['status']) ?>"><?= $inquiry['status'] === 'new' ? 'Novy' : 'Vybavene' ?></span></td>
                        <td><?= e($inquiry['name']) ?></td>
                        <td><a href="mailto:<?= e($inquiry['email']) ?>"><?= e($inquiry['email']) ?></a></td>
                        <td><?= e($inquiry['phone']) ?></td>
                        <td><?= e($inquiry['event_date'] ?: '-') ?></td>
                        <td class="message-cell"><?= e($inquiry['message']) ?></td>
                        <td><?= e($inquiry['created_at']) ?></td>
                        <td class="actions">
                            <?php if ($inquiry['status'] === 'new'): ?>
                                <form method="post">
                                    <input type="hidden" name="csrf_token" value="<?= e(Csrf::token()) ?>">
                                    <input type="hidden" name="id" value="<?= (int) $inquiry['id'] ?>">
                                    <input type="hidden" name="action" value="done">
                                    <button type="submit">Vybavene</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" onsubmit="return confirm('Naozaj vymazat dopyt?')">
                                <input type="hidden" name="csrf_token" value="<?= e(Csrf::token()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $inquiry['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit">Vymazat</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$inquiries): ?>
                    <tr>
                        <td colspan="8">Zatial nebol odoslany ziadny dopyt.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
