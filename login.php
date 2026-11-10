<?php
require_once __DIR__ . '/auth.php';

if (auth_is_logged_in()) {
    header('Location: index.php');
    exit;
}

$errors = [];
$old_email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $old_email = $email;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($password === '') {
        $errors[] = 'Please enter your password.';
    }

    if (!$errors) {
        try {
            auth_ensure_schema();
            $conn = auth_db();
            $stmt = $conn->prepare('SELECT id, name, email, password_hash FROM users WHERE email = ? LIMIT 1');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($user && password_verify($password, $user['password_hash'])) {
                auth_login_user($user);

                // Safe redirect back to a local .php page, if one was requested.
                $redirect = $_GET['redirect'] ?? 'index.php';
                if (!preg_match('/^[a-zA-Z0-9_\-.]+\.php$/', $redirect)) {
                    $redirect = 'index.php';
                }
                header('Location: ' . $redirect);
                exit;
            }
            $errors[] = 'Invalid email or password.';
        } catch (mysqli_sql_exception $e) {
            $errors[] = 'Something went wrong. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login — PEÑAFLORIDA PORTFOLIO</title>
    <link rel="icon" type="image/png" href="imgs/Logo-removebg-preview.png">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header class="site-header">
        <div class="container">
            <nav class="topbar">
                <div class="brand">
                    <a href="index.php" class="brand__logo-link">
                        <img src="imgs/Logo-removebg-preview.png" alt="SGP by Grace" class="brand__logo-img">
                    </a>
                </div>
                <ul class="nav">
                    <li><a class="nav__link" href="index.php">Home</a></li>
                    <li><a class="nav__link" href="about.php">About</a></li>
                    <li><a class="nav__link" href="works.php">Works</a></li>
                    <li><a class="nav__link" href="demoreel.php">Demo Reel</a></li>
                    <li><a class="nav__link" href="contact.php">Contact</a></li>
                </ul>
                <div class="topbar__actions">
                    <a class="btn btn--ghost" href="login.php">Login</a>
                    <a class="btn" href="signup.php">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="container section">
        <div class="auth-wrap">
            <div class="card auth-card">
                <h1 class="section__title">Welcome back</h1>
                <p style="color: var(--subtext); margin-bottom: 25px;">
                    Log in to your account to continue.
                </p>

                <?php if ($errors): ?>
                    <ul class="form-errors">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form method="post" action="login.php<?= isset($_GET['redirect']) ? '?redirect=' . urlencode($_GET['redirect']) : '' ?>" novalidate>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" maxlength="150"
                               value="<?= htmlspecialchars($old_email) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required>
                            <button type="button" class="toggle-password">Show</button>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="width:100%; justify-content:center;">Log In</button>
                </form>

                <p class="auth-switch">Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </main>

    <footer class="container">
        <div class="footer">
            <p>Copyright © 2026 By Steffany Grace N. Peñaflorida</p>
            <a href="#main" class="footer__link">Back to top ↑</a>
        </div>
    </footer>

    <script src="script.js"></script>

</body>
</html>