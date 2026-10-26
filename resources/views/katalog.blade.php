<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Katalog Sparepart – {{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</title>
<meta name="description" content="Katalog sparepart dan suku cadang motor terlengkap.">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Racing+Sans+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>try{document.documentElement.dataset.theme=localStorage.getItem('th')||'dark'}catch(e){}</script>
<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
@php($wa = $s['whatsapp'] ?? '')
<header class="site"><div class="wrap nav">
  <a class="logo disp" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:36px;height:36px;object-fit:contain;border-radius:50%"> {{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</a>
  <nav class="links" aria-label="Menu utama">
    <a href="{{ route('home') }}#layanan">Layanan</a>
    <a href="{{ route('home') }}#alur">Alur</a>
    <a href="{{ route('katalog') }}" class="active">Katalog Sparepart</a>
    <a href="{{ route('home') }}#faq">FAQ</a>
    <a href="{{ route('home') }}#booking">Booking</a>
  </nav>
  <button class="round" type="button" data-theme-toggle>🌙</button>
</div></header>

<main>
<section id="katalog" style="padding-top:40px"><div class="wrap">
  <div class="center">
    <h2>Katalog Sparepart &amp; Aksesoris</h2>
    <p class="sub">Tanyakan stok &amp; ketersediaan barang via WhatsApp sebelum datang ke bengkel.</p>
  </div>

  <form method="GET" action="{{ route('katalog') }}" style="max-width:500px;margin:20px auto;display:flex;gap:10px">
    @if($kategori)<input type="hidden" name="kategori" value="{{ $kategori }}">@endif
    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama barang atau merek..." style="flex:1">
    <button class="btn" type="submit">Cari</button>
  </form>

  <div class="chips c">
    <a class="chip {{ $kategori ? '' : 'on' }}" href="{{ route('katalog', array_filter(['search' => $search])) }}">Semua</a>
    @foreach($categories as $c)
      <a class="chip {{ $kategori === $c ? 'on' : '' }}" href="{{ route('katalog', array_filter(['kategori' => $c, 'search' => $search])) }}">{{ $c }}</a>
    @endforeach
  </div>

  <div class="grid g4" style="margin-top:24px">
    @forelse($products as $p)
    <div class="card">
      <div class="thumb">
        @if($p->image)
          <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" loading="lazy">
        @else 
          <span aria-hidden="true">⚙️</span> 
        @endif
      </div>
      <b>{{ $p->name }}</b>
      <div class="small">{{ $p->brand }}</div>
      <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
      <span class="badge s-{{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Menipis' : 'Tersedia') }}">
        {{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Stok menipis' : 'Tersedia') }}
      </span>
      @if($wa)
        <p style="margin:12px 0 0">
          <a class="btn g" style="display:block;text-align:center;padding:6px 12px;font-size:0.9rem" href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, apakah '.$p->name.' masih ada?') }}" target="_blank" rel="noopener">Tanya Stok WA</a>
        </p>
      @endif
    </div>
    @empty 
    <div class="full" style="grid-column: 1 / -1; text-align: center;">
      <p class="sub">Belum ada barang di kategori ini atau hasil pencarian tidak ditemukan.</p>
    </div>
    @endforelse
  </div>

  <div style="margin-top:32px">
    {{ $products->links('pagination::simple-default') }}
  </div>
</div></section>
</main>

<footer class="site"><div class="wrap">
  <b class="disp">{{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</b><br>
  {{ $s['address'] ?? '' }}<br>{!! nl2br(e($s['hours'] ?? '')) !!}
  @if(!empty($s['email']))<br>{{ $s['email'] }}@endif
  <br><small>© {{ date('Y') }} {{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</small>
</div></footer>
</body>
</html>
