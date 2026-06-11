<?php

declare(strict_types=1);

namespace App\Security;

use App\Model\User;

// Admin bejelentkezes es jogosultsag ellenorzese.
final class Auth
{
    public function attempt(string $email, string $password): bool
    {
        // Megkeresi a felhasznalot es ellenorzi a hashelt jelszot.
        $user = (new User())->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return false;
        }

        $_SESSION['admin_id'] = (int) $user['id'];
        $_SESSION['admin_name'] = $user['name'];

        return true;
    }

    public static function check(): bool
    {
        // Ha van admin_id a sessionben, akkor be van jelentkezve.
        return isset($_SESSION['admin_id']);
    }

    public static function requireAdmin(): void
    {
        // Admin oldalak vedelme: belepes nelkul login oldalra kuld.
        if (!self::check()) {
            header('Location: ' . BASE_URL . '/admin/login.php');
            exit;
        }
    }

    public static function logout(): void
    {
        // Kijelentkezeskor torli a session adatokat.
        $_SESSION = [];
        session_destroy();
    }
}
