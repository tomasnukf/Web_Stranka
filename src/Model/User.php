<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

// Admin felhasznalo keresese az adatbazisban.
final class User
{
    public function findByEmail(string $email): ?array
    {
        // Prepared statement: email alapjan biztonsagos keresest vegez.
        $statement = Database::getConnection()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        return $user ?: null;
    }
}
