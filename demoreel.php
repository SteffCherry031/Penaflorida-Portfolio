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

    <main id="main">
      <section class="section" id="demoreel">
        <div class="container" style="max-width: 900px;"> 
          <h2 class="section__title" style="text-align: center;">Vision Board '26</h2>
          <p style="text-align: center; color: var(--subtext); margin-bottom: 40px;">A creative visual compilation of my goals, projects, and stories.</p>

          <div class="card" style="padding: 15px; margin-bottom: 30px;">
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
              
              <video controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                <!-- Dito ilagay ang file path ng iyong video -->
                <source src="vid/demo.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>

            </div>
          </div>

          <div class="card">
            <h3 style="margin-top: 0; color: var(--accent);">About This Project</h3>
            <p style="line-height: 1.6;">
              This video showcases a compilation of my creative works and aspirations. 
              The sequence highlights my passion for Photoghapy, Videography, blending aesthetic visuals with meaningful audio.
            </p>

            <hr style="border: 0; border-top: 1px solid rgba(191,167,255,0.1); margin: 30px 0;">

            <h4 style="margin-bottom: 10px;">Credits & Acknowledgements</h4>
            <p style="font-size: 13px; color: var(--subtext); line-height: 1.6; margin: 0;">
              <strong>Audio:</strong> supricing_media downloaded in Pixabay<br>
              <strong>Visuals:</strong> Original photography and video sequences shot on Canon 1500d and Cellphone.<br>
              <strong>Disclaimer:</strong> This video is strictly for educational purposes and portfolio showcasing as part of my BSIT program requirements. No copyright infringement is intended. All third-party assets belong to their respective owners.
            </p>
          </div>

        </div>
      </section>
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