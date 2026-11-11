<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="robots" content="noindex">
<title>@yield('title', 'Dashboard') – ONG BLASTING 86 Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Racing+Sans+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>try{document.documentElement.dataset.theme=localStorage.getItem('th')||'dark'}catch(e){}</script>
<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
@php($menu = [
  ['admin.dashboard', 'Ringkasan', 'admin.dashboard'],
  ['admin.booking.index', 'Booking', 'admin.booking.*'],
  ['admin.layanan.index', 'Layanan', 'admin.layanan.*'],
  ['admin.sparepart.index', 'Sparepart & Stok', 'admin.sparepart.*'],
  ['admin.galeri.index', 'Galeri', 'admin.galeri.*'],
  ['admin.testimoni.index', 'Testimoni', 'admin.testimoni.*'],
  ['admin.faq.index', 'FAQ', 'admin.faq.*'],
  ['admin.setting.edit', 'Pengaturan', 'admin.setting.*'],
])
<div class="app">
<button class="mobile-nav-toggle" type="button" aria-controls="admin-sidebar" aria-expanded="false" data-admin-nav-toggle><span></span><span></span><span></span><span class="sr-only">Buka navigasi admin</span></button>
<aside id="admin-sidebar">
  <div class="rail-head">
    <a class="logo disp" href="{{ route('admin.dashboard') }}"><img class="logo-mark" src="{{ asset('images/logo.png') }}" alt="Logo ONG BLASTING 86"> <span>ONG BLASTING 86</span></a>
    <span class="rail-status"><i></i> SISTEM ONLINE</span>
  </div>
  <nav class="rail-nav" aria-label="Navigasi admin">
    <span class="nav-label">OPERASIONAL</span>
    @foreach($menu as [$r, $label, $pat])
      <a class="nv {{ request()->routeIs($pat) ? 'on' : '' }}" href="{{ route($r) }}" @if(request()->routeIs($pat)) aria-current="page" @endif><span>{{ $label }}</span></a>
    @endforeach
  </nav>
  <div class="sp"></div>
  <div class="rail-footnote"><span class="pulse-mark"></span><span>NODE 86.01<br><small>READY FOR SERVICE</small></span></div>
  <a class="nv" href="{{ route('home') }}" target="_blank" rel="noopener"><span>Lihat web</span></a>
  <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="nv" type="submit"><span>Keluar</span></button></form>
</aside>
<div class="admin-scrim" data-admin-nav-close></div>
<div class="confirm-modal" data-confirm-modal hidden role="dialog" aria-modal="true" aria-labelledby="confirm-title"><div class="confirm-box"><h2 id="confirm-title">Konfirmasi tindakan</h2><p data-confirm-message></p><div class="confirm-actions"><button class="btn g" type="button" data-confirm-cancel>Batal</button><button class="btn" type="button" data-confirm-accept>Lanjutkan</button></div></div></div>
<main class="adm">
  <div class="top"><div class="top-title"><span class="eyebrow">CONTROL CENTER / 86</span><h1>@yield('title', 'Dashboard')</h1></div><div class="top-user"><button class="round" type="button" data-theme-toggle aria-label="Ganti tema">🌙</button><b>{{ auth()->user()->name }}</b><span class="user-dot" aria-hidden="true"></span></div></div>
  @if(session('ok'))<div class="flash" role="status">{{ session('ok') }}</div>@endif
  @if($errors->any() && !request()->isMethod('get'))<div class="flash bad">{{ $errors->first() }}</div>@endif
  @yield('content')
</main>
</div>
</body></html>
