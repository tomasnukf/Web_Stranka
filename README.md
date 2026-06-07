# ProLux - PHP OOP projekt

Webova stranka pre rentovanie svetelnej techniky stage lighting.

## Splnene kriteria

- ciste PHP bez frameworku
- PHP 8.0+
- MySQL/MariaDB databaza
- OOP triedy v priecinku `src`
- CRUD operacie nad entitou `lights`
- administracia chranena prihlasenim
- hesla cez `password_hash` / `password_verify`
- sessions a CSRF tokeny pri formularoch
- PDO prepared statements
- dynamicky vypis vyrobcov a svetiel z databazy
- databaza obsahuje vyrobcov Robe, Martin, Showtek, ADJ, DTS a minimalne 5 svetiel pre kazdeho

## Spustenie v XAMPP

1. Skopiruj priecinok `prolux` do `C:\xampp\htdocs\prolux`.
2. Zapni v XAMPP `Apache` a `MySQL`.
3. Otvor `http://localhost/phpmyadmin`.
4. V phpMyAdmin otvor kartu `Import` a nahraj subor `database.sql`.
5. Skontroluj nastavenie databazy v `config/config.php`.
6. Otvor web: `http://localhost/prolux/public`.
7. Administracia: `http://localhost/prolux/public/admin/login.php`.

## Prihlasenie do administracie

- email: `admin@prolux.sk`
- heslo: `admin123`

Po prvom prihlaseni si heslo zmen v databaze alebo vytvor vlastneho admina pomocou PHP funkcie `password_hash`.

## Odporucany Git postup

```bash
git init
git add .
git commit -m "Initial ProLux PHP OOP project"
git add .
git commit -m "Add product CRUD administration"
git add .
git commit -m "Add seeded stage lighting database"
```

Potom vytvor verejny GitHub repozitar a projekt tam nahraj.
