<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $s['shop_name'] ?? 'ONG BLASTING 86' }} – Servis &amp; Performa</title>
<meta name="description" content="{{ $s['tagline'] ?? 'Servis, tune up, dan sparepart.' }}">
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
  <nav class="links" aria-label="Menu utama"><a href="#layanan">Layanan</a><a href="#alur">Alur</a><a href="{{ route('katalog') }}">Katalog Sparepart</a>@if($faqs->count())<a href="#faq">FAQ</a>@endif<a href="#booking">Booking</a></nav>
  <button class="round" type="button" data-theme-toggle>🌙</button>
</div></header>

<main>
<section><div class="wrap hero">
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
</div></section>

<div class="wrap"><div class="flag"></div></div>

<section id="layanan"><div class="wrap">
  <div class="center"><h2>Layanan Kami</h2></div><p class="sub">Dikerjakan mekanik berpengalaman, estimasi harga jelas di awal.</p>
  <div class="grid g3">
    @forelse($services as $sv)
    <div class="card"><h3>{{ $sv->name }}</h3><div class="small">{{ $sv->category }}@if($sv->estimate) · {{ $sv->estimate }}@endif</div>
      <div class="price">Rp {{ number_format($sv->price, 0, ',', '.') }}</div><p>{{ $sv->description }}</p></div>
    @empty <p class="sub">Daftar layanan segera hadir.</p> @endforelse
  </div>
</div></section>

<section id="alur"><div class="wrap">
  <div class="center"><h2>Alur Servis</h2></div><p class="sub">Empat langkah dari booking sampai selesai.</p>
  <div class="grid g4 center">
    <div class="card"><div class="num">1</div><h3>Pilih Layanan</h3><p>Telusuri daftar layanan.</p></div>
    <div class="card"><div class="num">2</div><h3>Booking</h3><p>Isi form atau chat WhatsApp.</p></div>
    <div class="card"><div class="num">3</div><h3>Datang</h3><p>Bawa kendaraan sesuai jadwal.</p></div>
    <div class="card"><div class="num">4</div><h3>Selesai</h3><p>Cek hasil, bayar, dapat garansi.</p></div>
  </div>
</div></section>

<section id="katalog"><div class="wrap">
  <div class="center"><h2>Sparepart Unggulan</h2></div><p class="sub">Beberapa pilihan sparepart terbaik kami. Lihat semua barang di menu Katalog Sparepart.</p>
  <div class="grid g4">
    @forelse($products as $p)
    <div class="card">
      <div class="thumb">@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" loading="lazy">@else <span aria-hidden="true">⚙️</span> @endif</div>
      <b>{{ $p->name }}</b><div class="small">{{ $p->brand }}</div>
      <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
      <span class="badge s-{{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Menipis' : 'Tersedia') }}">{{ $p->stock == 0 ? 'Habis' : ($p->stock < 5 ? 'Stok menipis' : 'Tersedia') }}</span>
      @if($wa)<p style="margin:12px 0 0"><a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, apakah '.$p->name.' masih ada?') }}" target="_blank" rel="noopener">Tanya stok</a></p>@endif
    </div>
    @empty <p class="sub">Belum ada produk.</p> @endforelse
  </div>
  <div class="center" style="margin-top:24px">
    <a class="btn" href="{{ route('katalog') }}">Lihat Semua Katalog Sparepart &rarr;</a>
  </div>
</div></section>

@if($gallery->count())
<section id="galeri"><div class="wrap">
  <div class="center"><h2>Hasil Pengerjaan</h2></div><p class="sub">Foto asli dari bengkel kami.</p>
  <div class="grid g3">@foreach($gallery as $g)
    <div class="card"><div class="thumb" style="height:170px"><img src="{{ asset('storage/'.$g->image) }}" alt="{{ $g->caption }}" loading="lazy"></div><b>{{ $g->caption }}</b> <span class="badge s-{{ $g->kind }}">{{ $g->kind }}</span></div>
  @endforeach</div>
</div></section>
@endif

@if($reviews->count())
<section id="testimoni"><div class="wrap">
  <div class="center"><h2>Kata Pelanggan</h2></div><p class="sub">Ulasan dari pelanggan bengkel kami.</p>
  <div class="grid g3">@foreach($reviews as $t)
    <div class="card"><div class="stars" role="img" aria-label="Rating {{ $t->rating }} dari 5">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div><p>{{ $t->body }}</p><b>{{ $t->name }}</b></div>
  @endforeach</div>
</div></section>
@endif

@if($faqs->count())
<section id="faq"><div class="wrap" style="max-width:720px">
  <div class="center"><h2>Pertanyaan Umum</h2></div><p class="sub">Hal yang sering ditanyakan.</p>
  @foreach($faqs as $f)<details><summary>{{ $f->question }}</summary><p>{{ $f->answer }}</p></details>@endforeach
</div></section>
@endif

<section id="booking"><div class="wrap" style="max-width:720px">
  <div class="center"><h2>Booking Servis</h2></div><p class="sub">Tanpa daftar akun. Cukup isi data berikut.</p>
  @if(session('booked'))
    <div class="flash">Booking diterima! Kode: <b>{{ session('booked') }}</b>. Kami akan menghubungi lewat WhatsApp untuk konfirmasi.</div>
  @endif
  @if($errors->any())<div class="flash bad">Periksa kembali isian form: {{ $errors->first() }}</div>@endif
  <form class="card fg" method="POST" action="{{ route('booking.store') }}">
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
</body>
</html>
