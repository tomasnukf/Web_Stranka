<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

final class Manufacturer
{
    public function all(): array
    {
        return Database::getConnection()
            ->query('SELECT * FROM manufacturers ORDER BY name ASC')
            ->fetchAll();
    }
}
