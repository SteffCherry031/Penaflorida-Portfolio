/* =========================================================
   Portfolio interactions — vanilla JS, no dependencies.
   Drop this file next to your HTML pages.
   ========================================================= */
(function () {
  'use strict';

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* -------------------------------------------------------
     1. Highlight the nav link for the current page
     ------------------------------------------------------- */
  const here = (location.pathname.split('/').pop() || 'index.php').toLowerCase();
  document.querySelectorAll('.nav__link').forEach(function (link) {
    const href = (link.getAttribute('href') || '').toLowerCase();
    if (href === here) {
      link.classList.add('is-active');
      link.setAttribute('aria-current', 'page');
    }
  });

  /* -------------------------------------------------------
     2. Sticky header gets a shadow once you scroll
     ------------------------------------------------------- */
  const header = document.querySelector('.site-header');
  if (header) {
    const sync = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
    sync();
    window.addEventListener('scroll', sync, { passive: true });
  }

  /* -------------------------------------------------------
     3. Scroll-reveal (fade + rise) — skipped if user prefers
        reduced motion or the browser lacks IntersectionObserver
     ------------------------------------------------------- */
  const revealTargets = document.querySelectorAll(
    '.hero__left, .hero__right, .section__title, .card, .project-card, ' +
    '.skill-item, .contact-detail-item, .contact-header'
  );

  if (!reduceMotion && 'IntersectionObserver' in window && revealTargets.length) {
    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    revealTargets.forEach(function (el) {
      el.classList.add('reveal');
      const siblings = Array.prototype.filter.call(
        el.parentElement.children,
        (c) => c.classList.contains('reveal')
      );
      el.style.transitionDelay = (Math.min(siblings.indexOf(el), 5) * 70) + 'ms';
      io.observe(el);
    });
  }

  /* -------------------------------------------------------
     4. Lightbox for photos (carousel, project cards, profile)
     ------------------------------------------------------- */
  const gallerySelectors =
    '.carousel-track img, .project-card__thumb img, .profile-card__img img';

  const gallery = [];
  const seenSrc = new Set();
  document.querySelectorAll(gallerySelectors).forEach(function (img) {
    const src = img.getAttribute('src');
    if (!src || seenSrc.has(src)) return;   // de-dupe the carousel's clone set
    seenSrc.add(src);
    gallery.push(img);
  });

  if (gallery.length) {
    const overlay = document.createElement('div');
    overlay.className = 'lightbox';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.setAttribute('aria-label', 'Image preview');
    overlay.innerHTML =
      '<button type="button" class="lightbox__close" aria-label="Close preview">&times;</button>' +
      '<button type="button" class="lightbox__nav lightbox__nav--prev" aria-label="Previous image">&lsaquo;</button>' +
      '<img class="lightbox__img" alt="">' +
      '<button type="button" class="lightbox__nav lightbox__nav--next" aria-label="Next image">&rsaquo;</button>';
    document.body.appendChild(overlay);

    const lbImg  = overlay.querySelector('.lightbox__img');
    const btnX   = overlay.querySelector('.lightbox__close');
    const btnPrev = overlay.querySelector('.lightbox__nav--prev');
    const btnNext = overlay.querySelector('.lightbox__nav--next');
    let index = 0;
    let lastFocus = null;

    function show(i) {
      index = (i + gallery.length) % gallery.length;
      const img = gallery[index];
      lbImg.src = img.currentSrc || img.src;
      lbImg.alt = img.alt || '';
    }

    function open(i) {
      lastFocus = document.activeElement;
      show(i);
      overlay.classList.add('is-open');
      document.body.classList.add('lightbox-open');
      btnX.focus();
    }

    function close() {
      overlay.classList.remove('is-open');
      document.body.classList.remove('lightbox-open');
      lbImg.removeAttribute('src');
      if (lastFocus && typeof lastFocus.focus === 'function') lastFocus.focus();
    }

    gallery.forEach(function (img, i) {
      img.style.cursor = 'zoom-in';
      img.setAttribute('tabindex', '0');
      img.setAttribute('role', 'button');
      img.addEventListener('click', function () { open(i); });
      img.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(i); }
      });
    });

    btnX.addEventListener('click', close);
    btnPrev.addEventListener('click', function () { show(index - 1); });
    btnNext.addEventListener('click', function () { show(index + 1); });
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) close();
    });

    document.addEventListener('keydown', function (e) {
      if (!overlay.classList.contains('is-open')) return;
      if (e.key === 'Escape') close();
      else if (e.key === 'ArrowLeft') show(index - 1);
      else if (e.key === 'ArrowRight') show(index + 1);
    });
  }

  /* -------------------------------------------------------
     5. Contact form: disable button while sending
     ------------------------------------------------------- */
  const contactForm = document.querySelector('form[action="contact.php"]');
  if (contactForm) {
    contactForm.addEventListener('submit', function () {
      const btn = contactForm.querySelector('button[type="submit"]');
      if (!btn || btn.disabled) return;
      btn.dataset.originalText = btn.textContent.trim();
      btn.disabled = true;
      btn.textContent = 'Sending…';
    });

    // Restore the button if the browser restores the page from cache
    window.addEventListener('pageshow', function () {
      const btn = contactForm.querySelector('button[type="submit"]');
      if (!btn) return;
      btn.disabled = false;
      if (btn.dataset.originalText) btn.textContent = btn.dataset.originalText;
    });
  }

  /* -------------------------------------------------------
     6. Mobile hamburger menu
     ------------------------------------------------------- */
  const topbar = document.querySelector('.topbar');
  const nav = topbar && topbar.querySelector('.nav');
  if (topbar && nav) {
    if (!nav.id) nav.id = 'primary-nav';

    const toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'nav-toggle';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-controls', nav.id);
    toggle.setAttribute('aria-label', 'Toggle navigation menu');
    toggle.innerHTML =
      '<span class="nav-toggle__bar"></span>' +
      '<span class="nav-toggle__bar"></span>' +
      '<span class="nav-toggle__bar"></span>';

    topbar.insertBefore(toggle, nav);
    document.body.classList.add('has-nav-toggle');

    toggle.addEventListener('click', function () {
      const open = topbar.classList.toggle('nav-open');
      toggle.setAttribute('aria-expanded', String(open));
    });

    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) {
        topbar.classList.remove('nav-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
  /* -------------------------------------------------------
     7. Show / Hide Password Toggle
     ------------------------------------------------------- */
  document.querySelectorAll('.toggle-password').forEach(function(btn) {
    btn.addEventListener('click', function() {
      // Find the input field next to the button
      const input = this.parentElement.querySelector('input');
      
      // Toggle the type
      if (input.type === 'password') {
        input.type = 'text';
        this.textContent = 'Hide';
      } else {
        input.type = 'password';
        this.textContent = 'Show';
      }
    });
  });

})();