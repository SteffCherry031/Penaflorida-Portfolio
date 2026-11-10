<?php require_once __DIR__ . '/auth.php'; 

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
      <section class="section" id="works">
        <div class="container">
          <h2 class="section__title">Works</h2>
          
          <div class="projects">
            
            <article class="project-card">
              <div class="project-card__thumb">
                <img src="imgs/board.png" alt="Aurora Landing">
              </div>
              <div class="project-card__body">
                <h3>Brand Board</h3>
              </div>
            </article>

            <article class="project-card">
              <div class="project-card__thumb">
                <img src="imgs/Post bignay.png" alt="PLV Research">
              </div>
              <div class="project-card__body">
                <h3>Church Service Poster</h3>
              </div>
            </article>

          </div>
        </div>
      </section>

      <section id="imgs" class="section">
        <div class="container">
            <h2 class="section__title" style="margin-bottom: 20px;">My Photography Shots</h2>
            
            <div class="carousel-container">
                <div class="carousel-track">
                    <img src="imgs/canon pics/annex.jpg" alt="annex">
                    <img src="imgs/canon pics/bag.jpg" alt="bag">
                    <img src="imgs/canon pics/chair.jpg" alt="chair">
                    <img src="imgs/canon pics/festiv.jpg" alt="festiv">
                    <img src="imgs/canon pics/green bush.jpg" alt="green bush">
                    <img src="imgs/canon pics/hmm.jpg" alt="hmm">
                    <img src="imgs/kittycrop.JPG" alt="annex">
                    <img src="imgs/canon pics/lens cap.jpg" alt="lens cap">
                    <img src="imgs/canon pics/mug.jpg" alt="mug">
                    <img src="imgs/canon pics/nice.jpg" alt="nice"> 
                    <img src="imgs/canon pics/light.jpg" alt="light">
                    <img src="imgs/canon pics/meh.jpg" alt="meh">
                    <img src="imgs/kitty03.JPG" alt="annex">
                    <img src="imgs/bush02.JPG" alt="annex">

                    <img src="imgs/canon pics/annex.jpg" alt="annex">
                    <img src="imgs/canon pics/bag.jpg" alt="bag">
                    <img src="imgs/canon pics/chair.jpg" alt="chair">
                    <img src="imgs/canon pics/festiv.jpg" alt="festiv">
                    <img src="imgs/canon pics/green bush.jpg" alt="green bush">
                    <img src="imgs/canon pics/hmm.jpg" alt="hmm">
                    <img src="imgs/kittycrop.JPG" alt="annex">
                    <img src="imgs/canon pics/lens cap.jpg" alt="lens cap">
                    <img src="imgs/canon pics/mug.jpg" alt="mug">
                    <img src="imgs/canon pics/nice.jpg" alt="nice"> 
                    <img src="imgs/canon pics/light.jpg" alt="light">
                    <img src="imgs/canon pics/meh.jpg" alt="meh">
                    <img src="imgs/bush02.JPG" alt="annex">
                </div>
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