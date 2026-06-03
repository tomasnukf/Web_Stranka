<?php

require_once __DIR__ . '/../../src/Bootstrap.php';

use App\Security\Auth;

Auth::logout();
redirect('/admin/login.php');
