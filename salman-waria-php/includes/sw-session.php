<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['sw_csrf_contact'])) {
    $_SESSION['sw_csrf_contact'] = bin2hex(random_bytes(32));
}
