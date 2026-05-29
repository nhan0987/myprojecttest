

/* Extracted Inline Scripts */
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
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
  });

  /* --- Phone Validation --- */
  function isValidPhone(val) {
    const cleaned = val.replace(/[\s\.\-]/g, '');
    return /^(0|\+84)(3[2-9]|5[6-9]|7[0|6-9]|8[0-9]|9[0-9])[0-9]{7}$/.test(cleaned);
  }
  function isValidName(val) { return val.trim().length >= 2; }

  /* --- Form Handler --- */
  function setupForm(formId, nameId, phoneId, submitId, groupNameId, groupPhoneId, formLabel) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const nameEl   = document.getElementById(nameId);
      const phoneEl  = document.getElementById(phoneId);
      const submitEl = document.getElementById(submitId);
      const gnEl     = document.getElementById(groupNameId);
      const gpEl     = document.getElementById(groupPhoneId);
      let ok = true;

      gnEl.classList.remove('has-err');
      gpEl.classList.remove('has-err');
      nameEl.classList.remove('err');
      phoneEl.classList.remove('err');

      if (!isValidName(nameEl.value)) {
        gnEl.classList.add('has-err');
        nameEl.classList.add('err');
        ok = false;
      }
      if (!isValidPhone(phoneEl.value)) {
        gpEl.classList.add('has-err');
        phoneEl.classList.add('err');
        ok = false;
      }
      if (!ok) return;

      submitEl.disabled = true;
      submitEl.textContent = 'Đang gửi...';

      /* FB Pixel Lead event */
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Lead', {
          content_name: 'Jade Lake Residence',
          content_category: formLabel,
          content_type: 'real_estate'
        });
      }
      /* GTM dataLayer push */
      if (window.dataLayer) {
        window.dataLayer.push({
          event: 'form_submit',
          form_id: formId,
          project: 'jade-lake-residence'
        });
      }

      /* TODO: Replace with actual API endpoint */
      setTimeout(function() {
        form.reset();
        submitEl.disabled = false;
        submitEl.textContent = '✓ Đã gửi thành công';
        document.getElementById('successModal').classList.add('open');
        setTimeout(function() {
          submitEl.textContent = formId === 'heroForm'
            ? '🔑 Nhận Ngay Bảng Giá & Chiết Khấu F1'
            : formId === 'heroBForm'
            ? '📊 Nhận Phân Tích Đầu Tư Miễn Phí'
            : 'Đăng Ký Nhận Báo Giá Ngay';
        }, 3500);
      }, 1300);
    });
  }

  setupForm('heroForm',  'hName',  'hPhone',  'hSubmit',  'hg-name',  'hg-phone',  'hero_form_a');
  setupForm('heroBForm', 'hbName', 'hbPhone', 'hbSubmit', 'hbg-name', 'hbg-phone', 'hero_form_b');
  setupForm('regForm',   'rName',  'rPhone',  'rSubmit',  'rg-name',  'rg-phone',  'register_form');

  /* ============================================
     A/B TEST — Hero A (Lifestyle) vs Hero B (Investment)
     Assignment: localStorage persistent, 50/50 split
     GTM/Pixel events fire with variant label
  ============================================ */
  (function() {
    var STORAGE_KEY = 'jade_hero_variant';
    var variant = localStorage.getItem(STORAGE_KEY);

    if (!variant) {
      variant = Math.random() < 0.5 ? 'A' : 'B';
      localStorage.setItem(STORAGE_KEY, variant);
    }

    var heroA = document.getElementById('hero');
    var heroB = document.getElementById('hero-b');

    if (variant === 'B') {
      heroA.style.display = 'none';
      heroB.classList.add('active');
    } else {
      heroB.style.display = 'none';
    }

    /* Track variant in GTM + FB Pixel */
    if (window.dataLayer) {
      window.dataLayer.push({ event: 'ab_test', ab_variant: 'hero_' + variant });
    }
    if (typeof fbq !== 'undefined') {
      fbq('trackCustom', 'ABTestView', {
        test_name: 'hero_variant',
        variant: variant
      });
    }
  })();

  /* --- Modal close --- */
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('successModal').classList.remove('open');
  });
  document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });

  /* --- Scroll to register --- */
  function goRegister() {
    document.getElementById('register').scrollIntoView({ behavior: 'smooth', block: 'start' });
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

/* Extracted Inline Scripts */
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
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
  });

  /* --- Phone Validation --- */
  function isValidPhone(val) {
    const cleaned = val.replace(/[\s\.\-]/g, '');
    return /^(0|\+84)(3[2-9]|5[6-9]|7[0|6-9]|8[0-9]|9[0-9])[0-9]{7}$/.test(cleaned);
  }
  function isValidName(val) { return val.trim().length >= 2; }

  /* --- Form Handler --- */
  function setupForm(formId, nameId, phoneId, submitId, groupNameId, groupPhoneId, formLabel) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const nameEl   = document.getElementById(nameId);
      const phoneEl  = document.getElementById(phoneId);
      const submitEl = document.getElementById(submitId);
      const gnEl     = document.getElementById(groupNameId);
      const gpEl     = document.getElementById(groupPhoneId);
      let ok = true;

      gnEl.classList.remove('has-err');
      gpEl.classList.remove('has-err');
      nameEl.classList.remove('err');
      phoneEl.classList.remove('err');

      if (!isValidName(nameEl.value)) {
        gnEl.classList.add('has-err');
        nameEl.classList.add('err');
        ok = false;
      }
      if (!isValidPhone(phoneEl.value)) {
        gpEl.classList.add('has-err');
        phoneEl.classList.add('err');
        ok = false;
      }
      if (!ok) return;

      submitEl.disabled = true;
      submitEl.textContent = 'Đang gửi...';

      /* FB Pixel Lead event */
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Lead', {
          content_name: 'Jade Lake Residence',
          content_category: formLabel,
          content_type: 'real_estate'
        });
      }
      /* GTM dataLayer push */
      if (window.dataLayer) {
        window.dataLayer.push({
          event: 'form_submit',
          form_id: formId,
          project: 'jade-lake-residence'
        });
      }

      /* TODO: Replace with actual API endpoint */
      setTimeout(function() {
        form.reset();
        submitEl.disabled = false;
        submitEl.textContent = '✓ Đã gửi thành công';
        document.getElementById('successModal').classList.add('open');
        setTimeout(function() {
          submitEl.textContent = formId === 'heroForm'
            ? '🔑 Nhận Ngay Bảng Giá & Chiết Khấu F1'
            : formId === 'heroBForm'
            ? '📊 Nhận Phân Tích Đầu Tư Miễn Phí'
            : 'Đăng Ký Nhận Báo Giá Ngay';
        }, 3500);
      }, 1300);
    });
  }

  setupForm('heroForm',  'hName',  'hPhone',  'hSubmit',  'hg-name',  'hg-phone',  'hero_form_a');
  setupForm('heroBForm', 'hbName', 'hbPhone', 'hbSubmit', 'hbg-name', 'hbg-phone', 'hero_form_b');
  setupForm('regForm',   'rName',  'rPhone',  'rSubmit',  'rg-name',  'rg-phone',  'register_form');

  /* ============================================
     A/B TEST — Hero A (Lifestyle) vs Hero B (Investment)
     Assignment: localStorage persistent, 50/50 split
     GTM/Pixel events fire with variant label
  ============================================ */
  (function() {
    var STORAGE_KEY = 'jade_hero_variant';
    var variant = localStorage.getItem(STORAGE_KEY);

    if (!variant) {
      variant = Math.random() < 0.5 ? 'A' : 'B';
      localStorage.setItem(STORAGE_KEY, variant);
    }

    var heroA = document.getElementById('hero');
    var heroB = document.getElementById('hero-b');

    if (variant === 'B') {
      heroA.style.display = 'none';
      heroB.classList.add('active');
    } else {
      heroB.style.display = 'none';
    }

    /* Track variant in GTM + FB Pixel */
    if (window.dataLayer) {
      window.dataLayer.push({ event: 'ab_test', ab_variant: 'hero_' + variant });
    }
    if (typeof fbq !== 'undefined') {
      fbq('trackCustom', 'ABTestView', {
        test_name: 'hero_variant',
        variant: variant
      });
    }
  })();

  /* --- Modal close --- */
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('successModal').classList.remove('open');
  });
  document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });

  /* --- Scroll to register --- */
  function goRegister() {
    document.getElementById('register').scrollIntoView({ behavior: 'smooth', block: 'start' });
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