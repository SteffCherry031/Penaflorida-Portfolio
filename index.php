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
      <section class="hero">
        <div class="container">
          <div class="hero__panel">
            <div class="hero__cols">
              <div class="hero__left">
                <p class="hero__kicker">Welcome, I am</p>
                <h1 class="hero__name">Steffany Grace Peñaflorida</h1>
                <p class="hero__sub">
                  A 2nd Year BSIT student at Pamantasan ng Lungsod ng Valenzuela. 
                  Aspiring Web Designer passionate about creating clean and aesthetic digital experiences.
                </p>
                <div class="hero__cta">
                  <a class="btn" href="#works">View My Featured Works</a>
                  <a class="btn btn--ghost hero__btn--secondary" href="#about">More About Me</a>
                </div>
                <div class="pill">
                  <span class="pill__label">Current Status</span><br>
                  <span class="pill__value">Junior IT Student @ PLV</span>
                </div>
              </div>

              <div class="hero__right">
                <div class="profile-card__frame">
                  <div class="profile-card__img">
                    <img src="imgs/profile pic.jpg" alt="prof pic" class="profile-image">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

      <section class="section" id="about">
        <div class="container">
          <h2 class="section__title">About Me</h2>
          <div class="card">
            <p>I am currently pursuing my <strong>Bachelor of Science in Information Technology</strong>. 
              I enjoy capturing photos and videos as it is my passion.</p>
            
            <div class="about__details">
              <div class="about__detail-item"><strong>Location:</strong> Malinta, Valenzuela City</div>
              <div class="about__detail-item"><strong>Focus:</strong> UI/UX & Frontend Development</div>
            </div> 

            <div class="about__cta-wrap">
              <a class="btn" href="about.php">Know Me More</a>
            </div>
            
          </div>
        </div>
      </section>

      <section class="section" id="works">
        <div class="container">
          <h2 class="section__title">Works</h2>
          <div class="projects">
            
            <article class="project-card">
              <div class="project-card__thumb"><img src="imgs/flowe02.JPG" alt="Aurora Landing"></div>
              <div class="project-card__body">
                <h3>Brand Board</h3>
                <p>A Brand Board for our past client.</p>
                <a href="works.php" class="nav__link">View Works →</a>
              </div>
            </article>

            <article class="project-card">
              <div class="project-card__thumb"><img src="imgs/bush0.JPG" alt="wor"></div>
              <div class="project-card__body">
                <h3>Church Service Poster</h3>
                <p>I am the multimedia head of our Churse in Bignay.</p>
                <a href="works.php" class="nav__link">View Works →</a>
              </div>
            </article>
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