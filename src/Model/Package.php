<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;
use PDOException;

// Stage lighting balicky adatainak kezelese.
final class Package
{
    public function all(): array
    {
        // Balicky betoltese adatbazisbol, ar szerint csokkeno sorrendben.
        try {
            return Database::getConnection()
                ->query('SELECT * FROM rental_packages ORDER BY price DESC')
                ->fetchAll();
        } catch (PDOException) {
            return $this->fallback();
        }
    }

    private function fallback(): array
    {
        // Tartalek adatok, ha a balicky tabla meg nem letezik az adatbazisban.
        return [
            [
                'name' => 'Arena Tour XL',
                'category' => 'Velky stage',
                'price' => 24500.00,
                'beam_count' => 40,
                'wash_count' => 30,
                'spot_count' => 20,
                'hazer_count' => 2,
                'truss_meters' => 96,
                'crew_count' => 8,
                'description' => 'Kompletny svetelny balik pre festival, halu alebo velky open-air koncert.',
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:FilePath/FlexiFlex%20Touring%20Truss.jpg?width=1200',
            ],
            [
                'name' => 'Club Pro M',
                'category' => 'Stredny stage',
                'price' => 16800.00,
                'beam_count' => 24,
                'wash_count' => 18,
                'spot_count' => 12,
                'hazer_count' => 2,
                'truss_meters' => 60,
                'crew_count' => 5,
                'description' => 'Balik pre klubove koncerty, firemne eventy a stredne velke podia.',
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Hanging%20stage%20lights.jpg?width=1200',
            ],
            [
                'name' => 'Event Start S',
                'category' => 'Mensi stage',
                'price' => 10000.00,
                'beam_count' => 16,
                'wash_count' => 12,
                'spot_count' => 8,
                'hazer_count' => 1,
                'truss_meters' => 36,
                'crew_count' => 3,
                'description' => 'Zakladny profesionalny balik pre mensie koncerty, party a prezentacie.',
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Traverse%20%28Truss%29.JPG?width=1200',
            ],
        ];
    }
}
