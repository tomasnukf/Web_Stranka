<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Security\Auth;

// Odhlasenie admina a navrat na login.
Auth::logout();
redirect('/admin/login.php');
