<?php

declare(strict_types=1);

namespace App\Security;

// CSRF token vedelem az urlapokhoz.
final class Csrf
{
    public static function token(): string
    {
        // Ha meg nincs token, general egy veletlen biztonsagi kulcsot.
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function validate(?string $token): bool
    {
        // Ellenorzi, hogy az urlapbol kuldott token egyezik-e a session tokennel.
        return is_string($token)
            && isset($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}
