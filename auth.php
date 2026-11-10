<?php
// auth.php — shared session + user helpers.
// Include at the top of every page that needs to know who is logged in.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

const AUTH_DB_HOST = 'localhost';
const AUTH_DB_USER = 'root';
const AUTH_DB_PASS = '';                 // change if your MySQL has a password
const AUTH_DB_NAME = 'penaflorida_portfolio';

function auth_current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function auth_is_logged_in(): bool
{
    return !empty($_SESSION['user']);
}

function auth_require_login(string $redirect = 'login.php'): void
{
    if (!auth_is_logged_in()) {
        header('Location: ' . $redirect);
        exit;
    }
}

function auth_login_user(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id'    => (int) $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
    ];
}

function auth_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $p['path'],
            $p['domain'],
            $p['secure'],
            $p['httponly']
        );
    }
    session_destroy();
}

function auth_db(): mysqli
{
    static $conn = null;
    if ($conn instanceof mysqli) {
        return $conn;
    }
    $conn = new mysqli(AUTH_DB_HOST, AUTH_DB_USER, AUTH_DB_PASS, AUTH_DB_NAME);
    $conn->set_charset('utf8mb4');
    return $conn;
}

function auth_ensure_schema(): void
{
    static $done = false;
    if ($done) {
        return;
    }
    $root = new mysqli(AUTH_DB_HOST, AUTH_DB_USER, AUTH_DB_PASS);
    $root->set_charset('utf8mb4');
    $root->query(
        "CREATE DATABASE IF NOT EXISTS `" . AUTH_DB_NAME . "`
         CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
    );
    $root->select_db(AUTH_DB_NAME);
    $root->query(
        "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY uniq_email (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
    );
    $root->close();
    $done = true;
}