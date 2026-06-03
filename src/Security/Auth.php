<?php

declare(strict_types=1);

namespace App\Security;

use App\Model\User;

final class Auth
{
    public function attempt(string $email, string $password): bool
    {
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
        return isset($_SESSION['admin_id']);
    }

    public static function requireAdmin(): void
    {
        if (!self::check()) {
            header('Location: ' . BASE_URL . '/admin/login.php');
            exit;
        }
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}
