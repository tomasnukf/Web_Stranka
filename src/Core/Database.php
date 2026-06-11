<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

// Ez az osztaly kezeli a PDO adatbazis kapcsolatot.
final class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        // Csak egyszer hozza letre a kapcsolatot, utana ugyanazt hasznalja.
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASS,
                    [
                        // Hibak es SQL lekerdezesek biztonsagosabb kezelese.
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $exception) {
                exit('Database connection failed: ' . $exception->getMessage());
            }
        }

        return self::$connection;
    }
}
