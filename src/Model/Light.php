<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;
use PDO;

final class Light
{
    public function all(?int $manufacturerId = null): array
    {
        $sql = 'SELECT lights.*, manufacturers.name AS manufacturer_name
                FROM lights
                INNER JOIN manufacturers ON manufacturers.id = lights.manufacturer_id';
        $params = [];

        if ($manufacturerId !== null) {
            $sql .= ' WHERE lights.manufacturer_id = :manufacturer_id';
            $params['manufacturer_id'] = $manufacturerId;
        }

        $sql .= ' ORDER BY manufacturers.name ASC, lights.name ASC';

        $statement = Database::getConnection()->prepare($sql);
        $statement->execute($params);

        return $this->withFixtureImages($statement->fetchAll());
    }

    public function featured(int $limit = 6): array
    {
        $statement = Database::getConnection()->prepare(
            'SELECT lights.*, manufacturers.name AS manufacturer_name
             FROM lights
             INNER JOIN manufacturers ON manufacturers.id = lights.manufacturer_id
             WHERE lights.active = 1
             ORDER BY lights.rental_price DESC
             LIMIT :limit'
        );
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $this->withFixtureImages($statement->fetchAll());
    }

    public function find(int $id): ?array
    {
        $statement = Database::getConnection()->prepare(
            'SELECT lights.*, manufacturers.name AS manufacturer_name
             FROM lights
             INNER JOIN manufacturers ON manufacturers.id = lights.manufacturer_id
             WHERE lights.id = :id'
        );
        $statement->execute(['id' => $id]);
        $light = $statement->fetch();

        return $light ? $this->withFixtureImage($light) : null;
    }

    public function create(array $data): void
    {
        $statement = Database::getConnection()->prepare(
            'INSERT INTO lights
                (manufacturer_id, name, category, power_w, rental_price, stock, image_url, description, active)
             VALUES
                (:manufacturer_id, :name, :category, :power_w, :rental_price, :stock, :image_url, :description, :active)'
        );
        $statement->execute($this->payload($data));
    }

    public function update(int $id, array $data): void
    {
        $payload = $this->payload($data);
        $payload['id'] = $id;

        $statement = Database::getConnection()->prepare(
            'UPDATE lights SET
                manufacturer_id = :manufacturer_id,
                name = :name,
                category = :category,
                power_w = :power_w,
                rental_price = :rental_price,
                stock = :stock,
                image_url = :image_url,
                description = :description,
                active = :active
             WHERE id = :id'
        );
        $statement->execute($payload);
    }

    public function delete(int $id): void
    {
        $statement = Database::getConnection()->prepare('DELETE FROM lights WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    private function payload(array $data): array
    {
        return [
            'manufacturer_id' => (int) $data['manufacturer_id'],
            'name' => trim((string) $data['name']),
            'category' => trim((string) $data['category']),
            'power_w' => (int) $data['power_w'],
            'rental_price' => (float) $data['rental_price'],
            'stock' => (int) $data['stock'],
            'image_url' => trim((string) $data['image_url']),
            'description' => trim((string) $data['description']),
            'active' => isset($data['active']) ? 1 : 0,
        ];
    }

    private function withFixtureImages(array $lights): array
    {
        return array_map(fn (array $light): array => $this->withFixtureImage($light), $lights);
    }

    private function withFixtureImage(array $light): array
    {
        $image = $this->fixtureImage((string) $light['name'], (string) $light['category']);

        if ($image !== null && (
            str_contains((string) $light['image_url'], 'images.unsplash.com')
            || str_contains((string) $light['image_url'], 'commons.wikimedia.org')
        )) {
            $light['image_url'] = $image;
        }

        return $light;
    }

    private function fixtureImage(string $name, string $category): ?string
    {
        $images = [
            'robe megapointe' => 'https://cdn.aws.robe.cz/v1/image/resize/025ed591ad67ff06e9dd82b461e0c345ba595d4a?width=900&height=900&fit=cover&withoutEnlargement=false',
            'robe spiider' => 'https://cdn.aws.robe.cz/v1/image/resize/bacf4d213ec3c79f0b0fbc9128588eea91297efa?width=900&height=900&fit=cover&withoutEnlargement=false',
            'robe bmfl spot' => 'https://cdn.aws.robe.cz/v1/image/resize/d017cced42e33d41104c891055714cc77a84a0be?width=900&height=900&fit=cover&withoutEnlargement=false',
            'robe ledbeam 150' => 'https://cdn.aws.robe.cz/v1/image/resize/371252fca4e93281166480433c3fbbc5635c6c8e?width=900&height=900&fit=cover&withoutEnlargement=false',
            'robe tarrantula' => 'https://cdn.aws.robe.cz/v1/image/resize/6c9de341cb1ae82efd1cbaa4693d7540565e81c6?width=900&height=900&fit=cover&withoutEnlargement=false',
            'martin mac aura xb' => 'https://adn.harmanpro.com/product_attachments/product_attachments/4821_1728940605/AuraXB_main_1_x_large.webp',
            'martin mac quantum profile' => 'https://adn.harmanpro.com/product_attachments/product_attachments/4808_1728940618/MACQuantumProfile_x_large.webp',
            'martin mac viper profile' => 'https://adn.harmanpro.com/product_attachments/product_attachments/4793_1728940678/macviperprofile_x_large.webp',
            'martin rush mh 7 hybrid' => 'https://adn.harmanpro.com/product_attachments/product_attachments/4802_1728124309/RUSH-MH-7_main_1000_x_large.webp',
            'martin elp cl' => 'https://adn.harmanpro.com/product_attachments/product_attachments/7028_1728934714/ELP_WhiteBlack_x_large.webp',
            'showtek phantom 130 spot' => 'https://thumbs.static-thomann.de/thumb/padthumb600x600/pics/bdb/_41/419265/12454598_800.jpg',
            'showtek shark beam one' => 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/5/45040_41.png',
            'showtek spectral m800 q4' => 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/3/43570_38.png',
            'showtek helix s5000 q4' => 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/3/43724_27.png',
            'showtek sunstrip active mkii' => 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/3/0/30714_16.png',
            'adj vizi beam rxone' => 'https://www.adj.com/cdn/shop/files/d2955ef038890dc62bd727161c26ce4b12769d4b_VIZ354__IMG__001__872f0672d46d.jpg?v=1776712400&width=2048',
            'adj focus spot 5z' => 'https://www.adj.com/cdn/shop/files/e127e0529de247aaac8275c88cfb3612c8863191_Focus_Spot_5Z_red_RT.jpg?v=1778225517&width=2048',
            'adj jolt 300' => 'https://www.adj.eu/media/catalog/product/j/o/jolt30002.jpg_5_1.jpg',
            'adj encore profile 1000' => 'https://www.adj.com/cdn/shop/files/8f3a3fbe6c042973d9a6fa3ea614a0e3d4b4352a_ENC264__IMG__002__638b790e8afe.png?v=1776713507&width=2048',
            'adj hydro beam x2' => 'https://www.adj.com/cdn/shop/files/794d4926b2e29b3c6ee3382b627784b59c64863e_HYD210__IMG__001__29b121373dd0.jpg?v=1776712428&width=2048',
            'dts synergy 5 profile' => 'https://www.imlight.ru/images/KATALOG/SVET/DTS/Povorotnue_Golovu/LED/SPOT_PROFILE_HYBRID/SYNERGY_5_PROFILE/SYNERGY_5_PROFILE.jpg',
            'dts jack' => 'https://art-complex.ru/userfiles/DTS/dts-jack.jpg',
            'dts katana' => 'https://portal.fullavl.nl/2230-large_default/dts-katana.jpg',
            'dts scena led 200' => 'https://www.pasolutions.gr/images/thumbs/0572345_550.jpeg',
            'dts nick nrg 1201' => 'https://www.pasolutions.gr/images/thumbs/0572470_550.jpeg',
        ];

        $name = strtolower(trim($name));
        $category = strtolower($category);

        if (isset($images[$name])) {
            return $images[$name];
        }

        $filePath = 'https://commons.wikimedia.org/wiki/Special:FilePath/';

        if (str_contains($name, 'ledbeam') || str_contains($name, 'beam') || str_contains($category, 'beam')) {
            return $filePath . 'MovingYoke.JPG?width=900';
        }

        if (str_contains($name, 'aura') || str_contains($name, 'spiider') || str_contains($name, 'wash') || str_contains($category, 'wash')) {
            return $filePath . 'LED_par.JPG?width=900';
        }

        if (str_contains($name, 'profile') || str_contains($name, 'elp') || str_contains($category, 'profile')) {
            return $filePath . 'Source_Four_ERS.jpg?width=900';
        }

        if (str_contains($name, 'fresnel') || str_contains($name, 'scena') || str_contains($category, 'fresnel')) {
            return $filePath . 'Fresnel_Spotlight.jpg?width=900';
        }

        if (str_contains($name, 'sunstrip') || str_contains($name, 'jolt') || str_contains($category, 'blinder')) {
            return $filePath . 'Stage_lights.jpg?width=900';
        }

        if (str_contains($name, 'katana') || str_contains($category, 'bar')) {
            return $filePath . 'ETC_Source_4s_and_intelligent_lights_at_marine_corps_museum_4.jpg?width=900';
        }

        if (str_contains($category, 'spot')) {
            return $filePath . 'Miniarc2.jpg?width=900';
        }

        return $filePath . 'MovingYoke.JPG?width=900';
    }
}
