<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

// Dopytok / erdeklodesek adatbazis muveletei.
final class Inquiry
{
    public function all(): array
    {
        // Admin oldalon a legujabb erdeklodesek jelennek meg elol.
        return Database::getConnection()
            ->query('SELECT * FROM inquiries ORDER BY created_at DESC')
            ->fetchAll();
    }

    public function countNew(): int
    {
        // Dashboardon megmutatja, hany uj dopyt van.
        return (int) Database::getConnection()
            ->query("SELECT COUNT(*) FROM inquiries WHERE status = 'new'")
            ->fetchColumn();
    }

    public function create(array $data): void
    {
        // Kapcsolat urlap adatait menti az inquiries tablaba.
        $statement = Database::getConnection()->prepare(
            'INSERT INTO inquiries (name, email, phone, event_date, message, status)
             VALUES (:name, :email, :phone, :event_date, :message, :status)'
        );
        $statement->execute([
            'name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'phone' => trim((string) ($data['phone'] ?? '')),
            'event_date' => ($data['event_date'] ?? '') !== '' ? $data['event_date'] : null,
            'message' => trim((string) $data['message']),
            'status' => 'new',
        ]);
    }

    public function markDone(int $id): void
    {
        // A dopyt statuszat vybavene/done allapotra allitja.
        $statement = Database::getConnection()->prepare("UPDATE inquiries SET status = 'done' WHERE id = :id");
        $statement->execute(['id' => $id]);
    }

    public function delete(int $id): void
    {
        // Dopyt torlese az admin feluletrol.
        $statement = Database::getConnection()->prepare('DELETE FROM inquiries WHERE id = :id');
        $statement->execute(['id' => $id]);
    }
}
