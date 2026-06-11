<?php

declare(strict_types=1);

namespace App\Core {
    // A projekt indito osztalya: session, config es autoload beallitasa.
    final class Bootstrap
    {
        public static function init(): void
        {
            self::startSession();
            self::loadConfig();
            self::registerAutoload();
        }

        private static function startSession(): void
        {
            // A session kell az admin bejelentkezeshez es CSRF vedelemhez.
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }

        private static function loadConfig(): void
        {
            // Beolvassa az adatbazis es oldal beallitasait.
            require_once __DIR__ . '/../config/config.php';
        }

        private static function registerAutoload(): void
        {
            // Automatikusan betolti az App namespace alatti osztalyokat.
            spl_autoload_register(static function (string $class): void {
                $prefix = 'App\\';

                if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
                    return;
                }

                $relativeClass = substr($class, strlen($prefix));
                $file = __DIR__ . '/' . str_replace('\\', '/', $relativeClass) . '.php';

                if (is_file($file)) {
                    require_once $file;
                }
            });
        }
    }
}

namespace {
    App\Core\Bootstrap::init();

    // Biztonsagos HTML kiiras XSS tamadas ellen.
    function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

    // Atiranyitas masik oldalra a BASE_URL hasznalataval.
    function redirect(string $path): never
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }
}
