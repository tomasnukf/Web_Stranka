<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

// A gyartok adatbazis muveletei.
final class Manufacturer
{
    public function all(): array
    {
        // Visszaadja az osszes gyartot nev szerint rendezve.
        return Database::getConnection()
            ->query('SELECT * FROM manufacturers ORDER BY name ASC')
            ->fetchAll();
    }
}
