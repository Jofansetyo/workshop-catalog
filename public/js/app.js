(function () {
  var r = document.documentElement;
  function icons() {
    document.querySelectorAll('[data-theme-toggle]').forEach(function (b) {
      var d = r.dataset.theme === 'dark';
      b.textContent = d ? '🌙' : '☀️';
      b.setAttribute('aria-label', d ? 'Mode malam aktif, klik untuk mode siang' : 'Mode siang aktif, klik untuk mode malam');
    });
  }
  document.addEventListener('click', function (e) {
    if (!e.target.closest('[data-theme-toggle]')) return;
    r.dataset.theme = r.dataset.theme === 'dark' ? 'light' : 'dark';
    try { localStorage.setItem('th', r.dataset.theme); } catch (x) {}
    icons();
  });
  icons();
})();
