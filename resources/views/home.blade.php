<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $s['shop_name'] ?? 'ONG BLASTING 86' }} – Servis &amp; Performa</title>
<meta name="description" content="{{ $s['tagline'] ?? 'Servis, tune up, dan sparepart.' }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Racing+Sans+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">
<script>try{document.documentElement.dataset.theme=localStorage.getItem('th')||'dark'}catch(e){}</script>
<script src="{{ asset('js/app.js') }}?v={{ file_exists(public_path('js/app.js')) ? filemtime(public_path('js/app.js')) : time() }}" defer></script>
</head>
<body>
@php($wa = $s['whatsapp'] ?? '')
<header class="site"><div class="wrap nav">
  <a class="logo disp" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:36px;height:36px;object-fit:contain;border-radius:50%"> {{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</a>
  <nav class="links" aria-label="Menu utama"><a href="#layanan">Layanan</a><a href="#alur">Alur</a><a href="{{ route('katalog') }}">Katalog Sparepart</a>@if($faqs->count())<a href="#faq">FAQ</a>@endif<a href="#booking">Booking</a></nav>
  <button class="round" type="button" data-theme-toggle>🌙</button>
  <button class="pub-menu-toggle" type="button" data-pub-menu-toggle aria-expanded="false" aria-label="Buka menu"><span></span><span></span><span></span></button>
</div></header>
<div class="pub-scrim" data-pub-menu-close></div>

<main>
<section class="home-section">
<img class="home-bg-img" src="{{ asset('images/bg-home.png') }}" alt="Bengkel" fetchpriority="high">
<div class="wrap hero">
  <div>
    <span class="tag">{{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</span>
    <h1>{{ $s['tagline'] ?? 'Racik tenaga. Tarik gas. Menang.' }}</h1>
    <p>Spesialis tune up, upgrade performa, dan servis harian. Booking dari rumah, harga transparan.</p>
    <div class="tree" aria-hidden="true"><i></i><i></i><i></i><b></b></div>
    <div class="cta">
      <a class="btn" href="#booking">Booking Servis</a>
      @if($wa)<a class="btn g" href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, saya ingin bertanya') }}" target="_blank" rel="noopener">Chat WhatsApp</a>@endif
    </div>
  </div>
  <div class="orb" aria-hidden="true"><div style="display:grid;place-items:center;width:100%;height:100%"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:75%;height:75%;object-fit:contain;border-radius:50%"></div></div>
</div>
<div class="wrap"><div class="flag"></div></div>
</section>

<section id="layanan"><div class="wrap">
  <div class="center reveal"><h2>Layanan Kami</h2></div><p class="sub reveal">Dikerjakan mekanik berpengalaman, estimasi harga jelas di awal.</p>
  <div class="grid g3">
    @forelse($services as $sv)
    <div class="card reveal"><h3>{{ $sv->name }}</h3><div class="small">{{ $sv->category }}@if($sv->estimate) · {{ $sv->estimate }}@endif</div>
      <div class="price">Rp {{ number_format($sv->price, 0, ',', '.') }}</div><p>{{ $sv->description }}</p></div>
    @empty <p class="sub">Daftar layanan segera hadir.</p> @endforelse
  </div>
</div></section>

<section id="alur"><div class="wrap">
  <div class="center reveal"><h2>Alur Servis</h2></div><p class="sub reveal">Empat langkah dari booking sampai selesai.</p>
  <div class="grid g4 center">
    <div class="card reveal"><div class="num">1</div><h3>Pilih Layanan</h3><p>Telusuri daftar layanan.</p></div>
    <div class="card reveal"><div class="num">2</div><h3>Booking</h3><p>Isi form atau chat WhatsApp.</p></div>
    <div class="card reveal"><div class="num">3</div><h3>Datang</h3><p>Bawa kendaraan sesuai jadwal.</p></div>
    <div class="card reveal"><div class="num">4</div><h3>Selesai</h3><p>Cek hasil, bayar, dapat garansi.</p></div>
  </div>
</div></section>

<section id="katalog"><div class="wrap">
  <div class="center reveal"><h2>Sparepart Unggulan</h2></div><p class="sub reveal">Beberapa pilihan sparepart terbaik kami. Lihat semua barang di menu Katalog Sparepart.</p>
  <div class="grid g4">
    @forelse($products as $p)
    <div class="card reveal">
      <div class="thumb">@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" loading="lazy">@else <span aria-hidden="true">⚙️</span> @endif</div>
      <b>{{ $p->name }}</b><div class="small">{{ $p->brand }}</div>
      <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
      <span class="badge s-{{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Menipis' : 'Tersedia') }}">{{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Stok menipis' : 'Tersedia') }}</span>
      @if($wa)<p style="margin:12px 0 0"><a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, apakah '.$p->name.' masih ada?') }}" target="_blank" rel="noopener">Tanya stok</a></p>@endif
    </div>
    @empty <p class="sub">Belum ada produk.</p> @endforelse
  </div>
  <div class="center reveal" style="margin-top:24px">
    <a class="btn" href="{{ route('katalog') }}">Lihat Semua Katalog Sparepart &rarr;</a>
  </div>
</div></section>

@if($gallery->count())
<section id="galeri"><div class="wrap">
  <div class="center reveal"><h2>Hasil Pengerjaan</h2></div><p class="sub reveal">Foto asli dari bengkel kami.</p>
  <div class="grid g3">@foreach($gallery as $g)
    <div class="card reveal"><div class="thumb" style="height:170px"><img src="{{ asset('storage/'.$g->image) }}" alt="{{ $g->caption }}" loading="lazy"></div><b>{{ $g->caption }}</b> <span class="badge s-{{ $g->kind }}">{{ $g->kind }}</span></div>
  @endforeach</div>
</div></section>
@endif

@if($reviews->count())
<section id="testimoni"><div class="wrap">
  <div class="center reveal"><h2>Kata Pelanggan</h2></div><p class="sub reveal">Ulasan dari pelanggan bengkel kami.</p>
  <div class="grid g3">@foreach($reviews as $t)
    <div class="card reveal"><div class="stars" role="img" aria-label="Rating {{ $t->rating }} dari 5">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div><p>{{ $t->body }}</p><b>{{ $t->name }}</b></div>
  @endforeach</div>
</div></section>
@endif

@if($faqs->count())
<section id="faq"><div class="wrap" style="max-width:720px">
  <div class="center reveal"><h2>Pertanyaan Umum</h2></div><p class="sub reveal">Hal yang sering ditanyakan.</p>
  @foreach($faqs as $f)<details class="reveal"><summary>{{ $f->question }}</summary><p>{{ $f->answer }}</p></details>@endforeach
</div></section>
@endif

<section id="booking"><div class="wrap" style="max-width:720px">
  <div class="center reveal"><h2>Booking Servis</h2></div><p class="sub reveal">Tanpa daftar akun. Cukup isi data berikut.</p>
  @if(session('booked'))
    <div class="flash">Booking diterima! Kode: <b>{{ session('booked') }}</b>. Kami akan menghubungi lewat WhatsApp untuk konfirmasi.</div>
  @endif
  @if($errors->any())<div class="flash bad">Periksa kembali isian form: {{ $errors->first() }}</div>@endif
  <form class="card fg reveal" method="POST" action="{{ route('booking.store') }}">
    @csrf
    <input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
    <div><label for="customer_name">Nama</label><input id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required></div>
    <div><label for="phone">Nomor HP</label><input id="phone" name="phone" inputmode="tel" value="{{ old('phone') }}" required></div>
    <div><label for="vehicle">Kendaraan</label><input id="vehicle" name="vehicle" placeholder="Contoh: Honda Beat 2020" value="{{ old('vehicle') }}" required></div>
    <div><label for="service">Layanan</label><select id="service" name="service">@foreach($services as $sv)<option @selected(old('service') === $sv->name)>{{ $sv->name }}</option>@endforeach</select></div>
    <div class="full"><label for="scheduled_at">Jadwal</label><input id="scheduled_at" type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}"></div>
    <div class="full"><label for="complaint">Keluhan</label><textarea id="complaint" name="complaint" rows="3">{{ old('complaint') }}</textarea></div>
    <div class="full"><button class="btn" type="submit">Kirim Booking</button></div>
  </form>
</div></section>
</main>

<footer class="site"><div class="wrap">
  <b class="disp">{{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</b><br>
  {{ $s['address'] ?? '' }}<br>{!! nl2br(e($s['hours'] ?? '')) !!}
  @if(!empty($s['email']))<br>{{ $s['email'] }}@endif
  <br><small>© {{ date('Y') }} {{ $s['shop_name'] ?? 'ONG BLASTING 86' }}</small>
</div></footer>

<button class="btt" type="button" aria-label="Kembali ke atas">↑</button>
@if($wa)
<a class="fab-wa" href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, saya ingin bertanya seputar servis/sparepart') }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
  <svg viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.03-1.25-.75-.67-1.26-1.5-1.41-1.75-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.34-.76-1.84-.2-.49-.4-.42-.56-.43h-.47c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.43 1.03 2.6c.13.17 1.77 2.7 4.29 3.78.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.12-.22-.19-.47-.31z"/></svg>
</a>
@endif
</body>
</html>
