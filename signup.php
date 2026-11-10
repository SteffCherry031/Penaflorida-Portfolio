<?php
require_once __DIR__ . '/auth.php';

if (auth_is_logged_in()) {
    header('Location: index.php');
    exit;
}

$errors = [];
$old = ['name' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    $old['name']  = $name;
    $old['email'] = $email;

    if ($name === '' || mb_strlen($name) > 100) {
        $errors[] = 'Please enter a name (max 100 characters).';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        try {
            auth_ensure_schema();
            $conn = auth_db();
            $stmt = $conn->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $name, $email, $hash);
            $stmt->execute();
            $id = $conn->insert_id;
            $stmt->close();

            auth_login_user(['id' => $id, 'name' => $name, 'email' => $email]);
            header('Location: index.php');
            exit;
        } catch (mysqli_sql_exception $e) {
            if ((int) $e->getCode() === 1062) {
                $errors[] = 'An account with that email already exists.';
            } else {
                $errors[] = 'Something went wrong. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up — PEÑAFLORIDA PORTFOLIO</title>
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
                <h1 class="section__title">Create your account</h1>
                <p style="color: var(--subtext); margin-bottom: 25px;">
                    Join to save your favorite works and reach out faster.
                </p>

                <?php if ($errors): ?>
                    <ul class="form-errors">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form method="post" action="signup.php" novalidate>
                    <div class="form-group">
                        <label for="name">Full name</label>
                        <input type="text" id="name" name="name" maxlength="100"
                               value="<?= htmlspecialchars($old['name']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" maxlength="150"
                               value="<?= htmlspecialchars($old['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" minlength="8" required>
                            <button type="button" class="toggle-password">Show</button>
                        </div>
                        <small class="form-help">At least 8 characters.</small>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm password</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
                            <button type="button" class="toggle-password">Show</button>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="width:100%; justify-content:center;">Sign Up</button>
                </form>

                <p class="auth-switch">Already have an account? <a href="login.php">Log in</a></p>
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