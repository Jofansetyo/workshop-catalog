(function () {
  var r = document.documentElement;
  function countUp() {
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    document.querySelectorAll('[data-count-up]').forEach(function (el) {
      var target = Number(el.dataset.countUp || 0);
      if (reducedMotion) {
        el.textContent = target.toLocaleString('id-ID');
        return;
      }
      var start = performance.now();
      var duration = 750;
      function tick(now) {
        var progress = Math.min((now - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.round(target * eased).toLocaleString('id-ID');
        if (progress < 1) window.requestAnimationFrame(tick);
      }
      window.requestAnimationFrame(tick);
    });
  }

  function icons() {
    document.querySelectorAll('[data-theme-toggle]').forEach(function (b) {
      var d = r.dataset.theme === 'dark';
      b.textContent = d ? '🌙' : '☀️';
      b.setAttribute('aria-label', d ? 'Mode malam aktif, klik untuk mode siang' : 'Mode siang aktif, klik untuk mode malam');
    });
  }
  document.addEventListener('click', function (e) {
    var themeButton = e.target.closest('[data-theme-toggle]');
    if (themeButton) {
      r.dataset.theme = r.dataset.theme === 'dark' ? 'light' : 'dark';
      try { localStorage.setItem('th', r.dataset.theme); } catch (x) {}
      icons();
      return;
    }

    var navToggle = e.target.closest('[data-admin-nav-toggle]');
    var navClose = e.target.closest('[data-admin-nav-close]');
    if (!navToggle && !navClose) return;
    var open = navToggle ? r.classList.toggle('admin-nav-open') : false;
    if (navToggle) navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (navClose) {
      r.classList.remove('admin-nav-open');
      var toggle = document.querySelector('[data-admin-nav-toggle]');
      if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
  });

  var pendingForm = null;
  document.addEventListener('click', function (e) {
    var confirmButton = e.target.closest('[data-confirm]');
    if (!confirmButton) return;
    e.preventDefault();
    pendingForm = confirmButton.form || confirmButton;
    var modal = document.querySelector('[data-confirm-modal]');
    modal.querySelector('[data-confirm-message]').textContent = confirmButton.dataset.confirm;
    modal.hidden = false;
    modal.querySelector('[data-confirm-accept]').focus();
  });
  document.addEventListener('click', function (e) {
    var modal = document.querySelector('[data-confirm-modal]');
    if (e.target.closest('[data-confirm-cancel]')) {
      modal.hidden = true;
      pendingForm = null;
    }
    if (e.target.closest('[data-confirm-accept]') && pendingForm) {
      modal.hidden = true;
      pendingForm.classList.add('loading');
      HTMLFormElement.prototype.submit.call(pendingForm);
      pendingForm = null;
    }
  });

  document.addEventListener('submit', function (e) {
    var form = e.target;
    if (!form.matches('[data-loading-form]')) return;
    form.classList.add('loading');
    form.querySelectorAll('button[type="submit"]').forEach(function (button) {
      button.disabled = true;
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape' || !r.classList.contains('admin-nav-open')) return;
    r.classList.remove('admin-nav-open');
    var toggle = document.querySelector('[data-admin-nav-toggle]');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
  });
  icons();
  countUp();

  window.adminAnimations = { countUp: countUp };
})();
