/* ============================================
     MẶT BẰNG — Tab switcher
============================================ */
function switchTab(btn, tabId) {
  document.querySelectorAll('.mb-tab').forEach(function(t) { t.classList.remove('active'); });
  document.querySelectorAll('.mb-panel').forEach(function(p) { p.classList.remove('active'); });
  btn.classList.add('active');
  var panel = document.getElementById('tab-' + tabId);
  if (panel) panel.classList.add('active');
}

/* ============================================
     MẶT BẰNG — Lightbox
============================================ */
function openLightbox(src, alt) {
  var lb = document.getElementById('mb-lightbox');
  document.getElementById('mb-lb-img').src = src;
  document.getElementById('mb-lb-caption').textContent = alt || '';
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeLightbox() {
  document.getElementById('mb-lightbox').classList.remove('open');
  document.body.style.overflow = '';
}

/* ============================================
     THƯ VIỆN ẢNH — Slideshow Lightbox
============================================ */
var galSlides = [];
var currentGalIndex = 0;

function initGallery() {
  var items = document.querySelectorAll('.gallery-grid .gal-item img');
  galSlides = [];
  items.forEach(function(img) {
    galSlides.push({
      src: img.src,
      alt: img.alt || ''
    });
  });
}

function openGalLightbox(index) {
  if (galSlides.length === 0) {
    initGallery();
  }
  currentGalIndex = index;
  updateGalLightbox();
  document.getElementById('gal-lightbox').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function updateGalLightbox() {
  if (galSlides.length === 0) return;
  var slide = galSlides[currentGalIndex];
  document.getElementById('gal-lb-img').src = slide.src;
  document.getElementById('gal-lb-caption').textContent = slide.alt;
  document.getElementById('gal-lb-index').textContent = (currentGalIndex + 1) + ' / ' + galSlides.length;
}

function closeGalLightbox() {
  document.getElementById('gal-lightbox').classList.remove('open');
  document.body.style.overflow = '';
}

function nextGalSlide() {
  if (galSlides.length === 0) return;
  currentGalIndex = (currentGalIndex + 1) % galSlides.length;
  updateGalLightbox();
}

function prevGalSlide() {
  if (galSlides.length === 0) return;
  currentGalIndex = (currentGalIndex - 1 + galSlides.length) % galSlides.length;
  updateGalLightbox();
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeLightbox();
    closeGalLightbox();
  }
  var galLb = document.getElementById('gal-lightbox');
  if (galLb && galLb.classList.contains('open')) {
    if (e.key === 'ArrowRight' || e.key === 'Right') nextGalSlide();
    if (e.key === 'ArrowLeft' || e.key === 'Left') prevGalSlide();
  }
});

/* ============================================
     CONTACT FORM 7 EVENT LISTENERS
============================================ */
document.addEventListener('wpcf7mailsent', function(event) {
  /* FB Pixel Lead event */
  if (typeof fbq !== 'undefined') {
    fbq('track', 'Lead', {
      content_name: 'Jade Lake Residence',
      content_category: 'Contact Form ' + event.detail.contactFormId,
      content_type: 'real_estate'
    });
  }
  /* GTM dataLayer push */
  if (window.dataLayer) {
    window.dataLayer.push({
      event: 'form_submit',
      form_id: 'cf7_' + event.detail.contactFormId,
      project: 'jade-lake-residence'
    });
  }

  // Show premium success modal
  var successModal = document.getElementById('successModal');
  if (successModal) {
    successModal.classList.add('open');
  }
}, false);

/* --- Modal close --- */
document.getElementById('closeModal').addEventListener('click', function() {
  document.getElementById('successModal').classList.remove('open');
});
document.getElementById('successModal').addEventListener('click', function(e) {
  if (e.target === this) this.classList.remove('open');
});

/* --- Scroll to register --- */
function goRegister() {
  var registerSec = document.getElementById('register');
  if (registerSec) {
    registerSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

/* ====================================================
   SCROLL REVEAL ENGINE v2
   - Auto-tags elements with data-anim via selector map
   - Staggers grid children with CSS --rv-delay
   - Single IntersectionObserver, fires once per element
   - Respects prefers-reduced-motion
   - Mobile: caps stagger at 160ms, reduces thresholds
==================================================== */
(function() {
  'use strict';

  var REDUCED  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var IS_MOBILE = window.innerWidth < 768;

  /* If user prefers reduced motion — reveal everything & exit */
  if (REDUCED) {
    document.querySelectorAll('[data-anim], .reveal').forEach(function(el) {
      el.classList.add('is-visible', 'visible');
    });
    return;
  }

  /* ── Auto-tagger map ──────────────────────────────
     Each rule: { sel, anim, delay?, stagger? }
     stagger: delay between siblings in same parent
     Elements already having data-anim are skipped.
  ─────────────────────────────────────────────── */
  var MAP = [
    /* Section titles */
    { sel: '.sec-tag',          anim: 'up',    delay: 0   },
    { sel: '.sec-title',        anim: 'up',    delay: 70  },
    { sel: '.gold-rule',        anim: 'fade',  delay: 130 },
    { sel: '.sec-desc',         anim: 'up',    delay: 110 },

    /* Trust bar — stagger left→right */
    { sel: '.trust-cell',       anim: 'up',    stagger: 80  },

    /* USP cards — stagger */
    { sel: '.usp-card',         anim: 'up',    stagger: 100 },

    /* Products */
    { sel: '.product-card',     anim: 'zoom',  stagger: 130 },

    /* Tổng quan */
    { sel: '.tq-img-stack',     anim: 'left',  delay: 0   },
    { sel: '.tq-table-wrap',    anim: 'right', delay: 80  },
    { sel: '.tq-cta-row',       anim: 'up',    delay: 180 },

    /* Mặt bằng */
    { sel: '.mb-tabs',          anim: 'up',    delay: 0   },
    { sel: '.mb-panels',        anim: 'up',    delay: 120 },

    /* Location */
    { sel: '.loc-img-wrap',     anim: 'left',  delay: 0   },
    { sel: '.loc-points',       anim: 'right', delay: 80  },
    { sel: '.dist-card',        anim: 'up',    stagger: 60 },

    /* Amenities */
    { sel: '.amen-card',        anim: 'zoom',  stagger: 55 },

    /* Payment */
    { sel: '.pay-step',         anim: 'up',    stagger: 80 },
    { sel: '.pay-note',         anim: 'up',    delay: 0   },

    /* Gallery */
    { sel: '.gal-item',         anim: 'zoom',  stagger: 70 },

    /* Register */
    { sel: '.reg-text',         anim: 'left',  delay: 0   },
    { sel: '.reg-form-card',    anim: 'right', delay: 0   },
    { sel: '.reg-perks li',     anim: 'up',    stagger: 65 },

    /* Footer */
    { sel: '.foot-logo',        anim: 'up',    delay: 0   },
    { sel: '.foot-col',         anim: 'up',    stagger: 90 },
    { sel: '.foot-disclaimer',  anim: 'fade',  delay: 200 },

    /* USP highlight tags */
    { sel: '.usp-tag',          anim: 'fade',  delay: 200 },

    /* Product spec lists */
    { sel: '.prod-specs li',    anim: 'up',    stagger: 45 },

    /* Location points */
    { sel: '.loc-point',        anim: 'up',    stagger: 80 },
  ];

  /* ── Apply data-anim + --rv-delay to each element ── */
  var seenStagger = new Map(); /* track sibling index per parent */

  MAP.forEach(function(rule) {
    var elements = document.querySelectorAll(rule.sel);
    elements.forEach(function(el) {
      if (el.hasAttribute('data-anim')) return; /* respect manual override */
      if (el.closest('#hero') || el.closest('#hero-b')) return; /* hero uses CSS keyframes */

      el.setAttribute('data-anim', rule.anim);

      var delay = 0;
      if (rule.stagger !== undefined) {
        /* Use parent as stagger context */
        var parent = el.parentElement;
        if (!seenStagger.has(parent)) seenStagger.set(parent, 0);
        var idx = seenStagger.get(parent);
        seenStagger.set(parent, idx + 1);
        delay = idx * rule.stagger + (rule.delay || 0);
        /* Cap stagger on mobile */
        if (IS_MOBILE) delay = Math.min(delay, 160);
      } else {
        delay = rule.delay || 0;
      }

      if (delay > 0) {
        el.style.setProperty('--rv-delay', delay + 'ms');
      }
    });
  });

  /* ── Also observe existing .reveal elements ── */
  /* (section-level wrappers already in HTML) */

  /* ── IntersectionObserver ── */
  var obsConfig = {
    threshold: IS_MOBILE ? 0.05 : 0.1,
    rootMargin: IS_MOBILE ? '0px 0px -20px 0px' : '0px 0px -48px 0px'
  };

  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (!entry.isIntersecting) return;
      var el = entry.target;

      /* For staggered children inside a container: fire the parent
         and let CSS delays handle each child automatically */
      el.classList.add('is-visible', 'visible');
      observer.unobserve(el);
    });
  }, obsConfig);

  /* Observe everything tagged */
  document.querySelectorAll('[data-anim], .reveal').forEach(function(el) {
    /* Skip elements inside hero — they use CSS load animations */
    if (el.closest('#hero') || el.closest('#hero-b')) return;
    observer.observe(el);
  });

})(); /* end reveal engine */

/* --- Compact header on scroll --- */
var lastScrollY = 0;
window.addEventListener('scroll', function() {
  var y = window.scrollY;
  var hdr = document.getElementById('site-header');
  if (y > 120) {
    hdr.style.boxShadow = '0 4px 24px rgba(0,0,0,0.35)';
  } else {
    hdr.style.boxShadow = 'none';
  }
  lastScrollY = y;
}, { passive: true });