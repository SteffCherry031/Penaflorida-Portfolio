<?php require_once __DIR__ . '/auth.php'; ?>

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

    <main class="container section">
        <h1 class="section__title">About Me</h1>

        <div class="about-grid">
            <!-- LEFT: photo + intro -->
            <div class="about-left">
                <div class="profile-card__frame">
                    <div class="profile-card__img">
                        <img src="imgs/mepic2.jpg" alt="Steffany Grace Peñaflorida" class="profile-image">
                    </div>
                </div>

                <p class="about__text">
                    I am a 3rd Year BSIT student at <strong>Pamantasan ng Lungsod ng Valenzuela</strong>.
                    I love blending the logic of IT with the creativity of design. When I'm not coding,
                    you'll find me taking photos with my Canon 1500D or hanging out with my favorite
                    Golden Retriever and Black Cat.
                </p>
            </div>

            <!-- RIGHT: skills + interests -->
            <div class="skills-column">
                <h3 class="subsection-title">Technical Skills</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <span class="skill-icon">🌐</span>
                        <span class="skill-name">HTML5 · CSS3<br>Python · Java</span>
                    </div>
                    <div class="skill-item">
                        <span class="skill-icon">🎨</span>
                        <span class="skill-name">UI/UX Design</span>
                    </div>
                    <div class="skill-item">
                        <span class="skill-icon">💻</span>
                        <span class="skill-name">Web Development</span>
                    </div>
                </div>

                <h3 class="subsection-title">Work Experience</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <span class="skill-icon">🍟</span>
                        <span class="skill-name">1 Month<br>McDonald's</span>
                    </div>
                </div>

                <h3 class="subsection-title">Interests &amp; Hobbies</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <span class="skill-icon">📸</span>
                        <span class="skill-name">Photography</span>
                    </div>
                    <div class="skill-item">
                        <span class="skill-icon">🎬</span>
                        <span class="skill-name">Videography</span>
                    </div>
                    <div class="skill-item">
                        <span class="skill-icon">🎵</span>
                        <span class="skill-name">Rex Orange County<br>Laufey</span>
                    </div>
                    <div class="skill-item">
                        <span class="skill-icon">📖</span>
                        <span class="skill-name">Reading<br>Manga &amp; Manhwa</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="container">
      <div class="footer">
        <p>Copyright © 2026 By Steffany Grace N. Peñaflorida</p>
        
        <!-- SOCIAL MEDIA ICONS -->
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

        <a href="#main" class="footer__link">Back to top ↑</a>
      </div>
    </footer>
</body>
</html>