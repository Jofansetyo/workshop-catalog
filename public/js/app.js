(function () {
  var r = document.documentElement;
  function countUp() {
    document.querySelectorAll('[data-count-up]').forEach(function (el) {
      var target = Number(el.dataset.countUp || 0);
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

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape' || !r.classList.contains('admin-nav-open')) return;
    r.classList.remove('admin-nav-open');
    var toggle = document.querySelector('[data-admin-nav-toggle]');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
  });
  icons();
  countUp();
})();
