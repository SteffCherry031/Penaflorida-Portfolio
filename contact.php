<?php
// Handles the "Send us a message" form on contact.php.
// Messages are saved to MySQL (XAMPP defaults).
// The database and table are created automatically on first submit.

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';                              // set your MySQL root password here if you have one
$dbName = 'penaflorida_portfolio';

require_once __DIR__ . '/auth.php';

function back($status)
{
    header('Location: contact.php?status=' . $status . '#contact');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name    = trim($_POST['name']    ?? '');
$phone   = trim($_POST['phone']   ?? '');
$email   = trim($_POST['email']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields + lengths (matching the DB columns)
if (
    $name === '' || $subject === '' || $message === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    mb_strlen($name)    > 100 ||
    mb_strlen($phone)   > 30  ||
    mb_strlen($email)   > 150 ||
    mb_strlen($subject) > 200
) {
    back('invalid');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($dbHost, $dbUser, $dbPass);
    $conn->set_charset('utf8mb4');

    $conn->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->select_db($dbName);

    $conn->query("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        phone VARCHAR(30),
        email VARCHAR(150) NOT NULL,
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $stmt = $conn->prepare('INSERT INTO messages (name, phone, email, subject, message) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $name, $phone, $email, $subject, $message);
    $stmt->execute();

    $stmt->close();
    $conn->close();
} catch (mysqli_sql_exception $e) {
    back('error');
}

back('success');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PEÑAFLORIDA PORTFOLIO</title>
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
              <?php if (auth_is_logged_in()): ?>
                  <span class="topbar__user">Hi, <?= htmlspecialchars(auth_current_user()['name']) ?></span>
                  <a class="btn btn--ghost" href="logout.php">Logout</a>
              <?php else: ?>
                  <a class="btn btn--ghost" href="login.php">Login</a>
                  <a class="btn" href="signup.php">Sign Up</a>
              <?php endif; ?>
          </div>
        </nav> 
      </div>
    </header>

    <main id="main">
      <section class="section contact-page" id="contact">
        <div class="container">

          <div class="contact-header card--center">
            <h1 class="hero__name">Contact Me</h1>
            <p class="hero__sub">Start the conversation to established good relationship and business.</p>
          </div>

          <div class="contact-grid">

            <!-- LEFT COLUMN -->
            <div class="contact-left">
              <span class="pill pill__label">GET IN TOUCH</span>
              <h2 class="section__title" style="margin-top: 15px;">Seamless Communication, Global Impact.</h2>
              <p style="color: var(--subtext); margin-bottom: 30px;">
                Reach out to me for any inquiries, project collaborations, or just to say hello. I am always ready to connect.
              </p>

              <div class="contact-details-grid">
                <div class="contact-detail-item">
                  <div class="icon-circle">📍</div>
                  <div>
                    <strong>HEAD OFFICE</strong>
                    <p>Valenzuela, Metro Manila<br>Philippines</p>
                  </div>
                </div>

                <div class="contact-detail-item">
                  <div class="icon-circle">✉️</div>
                  <div>
                    <strong>EMAIL SUPPORT</strong>
                    <p>stepenaflor0606@gmail.com</p>
                  </div>
                </div>

                <div class="contact-detail-item">
                  <div class="icon-circle">📞</div>
                  <div>
                    <strong>LET'S TALK</strong>
                    <p>+63 920 4529 405</p>
                  </div>
                </div>

                <div class="contact-detail-item">
                  <div class="icon-circle">🕒</div>
                  <div>
                    <strong>WORKING HOURS</strong>
                    <p>Monday - Friday<br>07am - 09pm</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="social-icons" style="margin-top: 20px;">
              <div class="social-icons">
                <a href="https://www.instagram.com/steffanygrace17/" target="_blank" class="social-icon" title="Instagram">
                  <img src="imgs/ins_icon.jpg" alt="Instagram">
                </a>
                <a href="https://www.facebook.com/steffanygrace.penaflorida/" target="_blank" class="social-icon" title="Facebook">
                  <img src="imgs/fb_icon.jpg" alt="Facebook">
                </a>
                <a href="https://youtube.com/@teptep031?si=fGpX4q-E1XfCXYNV" target="_blank" class="social-icon" title="YouTube">
                  <img src="imgs/yt_icon.jpg" alt="YouTube">
                </a>
              </div>

            </div>

            <!-- /LEFT COLUMN -->

            <!-- RIGHT COLUMN -->
            <div class="contact-right card">
              <h3 style="font-size: 24px; margin-top: 0;">Send us a message</h3>
              <p style="color: var(--subtext); margin-bottom: 25px; font-size: 14px;">
                Please feel free to send us any questions, feedback or suggestions you might have.
              </p>

              <p id="form-status" style="display: none; margin-bottom: 20px; font-size: 14px;"></p>

              <form action="contact.php" method="POST">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" placeholder="Name" maxlength="100" required>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" placeholder="Phone" maxlength="30">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" maxlength="150" required>
                  </div>
                </div>

                <div class="form-group">
                  <label>Subject</label>
                  <input type="text" name="subject" placeholder="Subject" maxlength="200" required>
                </div>

                <div class="form-group">
                  <label>Message</label>
                  <textarea rows="4" name="message" placeholder="Message" required></textarea>
                </div>

                <button type="submit" class="btn btn-full" style="width: 100%; justify-content: center; margin-top: 10px;">
                  SEND MESSAGE
                </button>
              </form>
            </div>
            <!-- /RIGHT COLUMN -->

          </div>
          <!-- /.contact-grid -->

          <div class="contact-map" style="margin-top: 60px;">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123504.11642878482!2d120.89886361730043!3d14.700689944062534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b4c6e93eb77b%3A0x8660e51515288597!2sValenzuela%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph"
              width="100%"
              height="400"
              style="border:0; border-radius: 20px; filter: invert(90%) hue-rotate(180deg);"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

        </div>
      </section>
    </main>

    <footer class="container">
      <div class="footer">
        <p>Copyright © 2026 By Steffany Grace N. Peñaflorida</p>
        <a href="#main" class="footer__link">Back to top ↑</a>
      </div>
    </footer>

    <script>
      const status = new URLSearchParams(location.search).get('status');
      const messages = {
        success: ['Thank you! Your message has been sent.', '#4caf50'],
        invalid: ['Please fill in all required fields with a valid email.', '#f44336'],
        error:   ['Sorry, something went wrong. Please try again later.', '#f44336']
      };
      if (messages[status]) {
        const el = document.getElementById('form-status');
        el.textContent = messages[status][0];
        el.style.color = messages[status][1];
        el.style.display = 'block';
      }
    </script>
  </body>
</html>