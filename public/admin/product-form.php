<section class="admin-layout">
    <aside class="admin-sidebar">
        <strong>ProLux admin</strong>
        <a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a>
        <a href="<?= BASE_URL ?>/admin/products.php">CRUD svetiel</a>
        <a href="<?= BASE_URL ?>/admin/inquiries.php">Dopyty</a>
        <a href="<?= BASE_URL ?>/admin/logout.php">Odhlasit</a>
    </aside>
    <div class="admin-content">
        <p class="eyebrow">Formular produktu</p>
        <h1><?= str_contains($_SERVER['SCRIPT_NAME'], 'create') ? 'Pridat svetlo' : 'Upravit svetlo' ?></h1>

        <?php foreach ($errors as $error): ?>
            <div class="notice danger"><?= e($error) ?></div>
        <?php endforeach; ?>

        <form class="form-card wide" method="post">
            <input type="hidden" name="csrf_token" value="<?= e(App\Security\Csrf::token()) ?>">
            <label>Vyrobca
                <select name="manufacturer_id" required>
                    <?php foreach ($manufacturers as $manufacturer): ?>
                        <option value="<?= (int) $manufacturer['id'] ?>" <?= (int) $light['manufacturer_id'] === (int) $manufacturer['id'] ? 'selected' : '' ?>>
                            <?= e($manufacturer['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Nazov
                <input name="name" value="<?= e($light['name']) ?>" required>
            </label>
            <label>Kategoria
                <input name="category" value="<?= e($light['category']) ?>" required>
            </label>
            <div class="form-grid">
                <label>Vykon W
                    <input type="number" name="power_w" value="<?= (int) $light['power_w'] ?>" min="0" required>
                </label>
                <label>Cena za den
                    <input type="number" step="0.01" name="rental_price" value="<?= e((string) $light['rental_price']) ?>" min="0" required>
                </label>
                <label>Sklad ks
                    <input type="number" name="stock" value="<?= (int) $light['stock'] ?>" min="0" required>
                </label>
            </div>
            <label>URL obrazka
                <input name="image_url" value="<?= e($light['image_url']) ?>" required>
            </label>
            <label>Popis
                <textarea name="description" rows="5" required><?= e($light['description']) ?></textarea>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="active" value="1" <?= (int) ($light['active'] ?? 0) === 1 ? 'checked' : '' ?>>
                Aktivne v ponuke
            </label>
            <button class="button primary" type="submit">Ulozit</button>
        </form>
    </div>
</section>
