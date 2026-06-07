<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;
use PDOException;

final class SpecialEffect
{
    public function all(): array
    {
        try {
            return Database::getConnection()
                ->query('SELECT * FROM special_effects ORDER BY price DESC, name ASC')
                ->fetchAll();
        } catch (PDOException) {
            return $this->fallback();
        }
    }

    private function fallback(): array
    {
        return [
            [
                'name' => 'CO2 dela',
                'category' => 'Stage FX',
                'price' => 1800.00,
                'unit' => 'show',
                'image_url' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Silne CO2 vystrely pre dropy, DJ sety a hlavne momenty koncertu.',
                'safety_note' => 'Pouzitie len s technikom a bezpecnou vzdialenostou od publika.',
            ],
            [
                'name' => 'Studene iskry',
                'category' => 'Spark FX',
                'price' => 1500.00,
                'unit' => 'show',
                'image_url' => 'https://images.unsplash.com/photo-1508973379184-7517410fb0bc?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Fontany studenych iskier pre svadby, koncerty, nastupy a finalne momenty.',
                'safety_note' => 'Potrebne je schvalenie miesta a kontrola vysky efektu.',
            ],
            [
                'name' => 'Plamene',
                'category' => 'Pyro FX',
                'price' => 2200.00,
                'unit' => 'show',
                'image_url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Kontrolovane flame efekty pre velke stage show a festivalove podia.',
                'safety_note' => 'Vyhradne s obsluhou, povolenim a presnym bezpecnostnym planom.',
            ],
            [
                'name' => 'Confetti',
                'category' => 'Party FX',
                'price' => 950.00,
                'unit' => 'show',
                'image_url' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Confetti vystrely, streamery a farebne finale pre koncerty, party aj firemne eventy.',
                'safety_note' => 'Vhodne do interieru aj exterieru podla typu naplne.',
            ],
            [
                'name' => 'Hmla a haze',
                'category' => 'Atmosphere FX',
                'price' => 650.00,
                'unit' => 'den',
                'image_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Haze a hmla pre zvyraznenie svetelnych lucov, laserov a atmosfery v priestore.',
                'safety_note' => 'Treba zohladnit poziarne cidla a ventilaciu priestoru.',
            ],
            [
                'name' => 'Laser show',
                'category' => 'Laser FX',
                'price' => 0.00,
                'unit' => 'show',
                'image_url' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1000&q=80',
                'description' => 'Laserove efekty synchronizovane so svetlami, hudbou a dymom.',
                'safety_note' => 'Nastavenie musi respektovat bezpecnost oci a smerovanie lucov.',
            ],
        ];
    }
}
