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
  ['admin.dashboard', 'Ringkasan', '📊', 'admin.dashboard'],
  ['admin.booking.index', 'Booking', '📅', 'admin.booking.*'],
  ['admin.layanan.index', 'Layanan', '🔧', 'admin.layanan.*'],
  ['admin.sparepart.index', 'Sparepart & Stok', '📦', 'admin.sparepart.*'],
  ['admin.galeri.index', 'Galeri', '🖼️', 'admin.galeri.*'],
  ['admin.testimoni.index', 'Testimoni', '⭐', 'admin.testimoni.*'],
  ['admin.faq.index', 'FAQ', '❓', 'admin.faq.*'],
  ['admin.setting.edit', 'Pengaturan', '⚙️', 'admin.setting.*'],
])
<div class="app">
<aside>
  <a class="logo disp" href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:36px;height:36px;object-fit:contain;border-radius:50%"> ONG BLASTING 86</a>
  @foreach($menu as [$r, $label, $ic, $pat])
    <a class="nv {{ request()->routeIs($pat) ? 'on' : '' }}" href="{{ route($r) }}">{{ $ic }} {{ $label }}</a>
  @endforeach
  <div class="sp"></div>
  <a class="nv" href="{{ route('home') }}" target="_blank" rel="noopener">🌐 Lihat web</a>
  <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="nv" type="submit">🚪 Keluar</button></form>
</aside>
<main class="adm">
  <div class="top"><h1>@yield('title', 'Dashboard')</h1><button class="round" type="button" data-theme-toggle>🌙</button><b>{{ auth()->user()->name }}</b></div>
  @if(session('ok'))<div class="flash" role="status">{{ session('ok') }}</div>@endif
  @if($errors->any() && !request()->isMethod('get'))<div class="flash bad">{{ $errors->first() }}</div>@endif
  @yield('content')
</main>
</div>
</body></html>
