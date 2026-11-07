<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="robots" content="noindex">
<title>Login Admin – ONG BLASTING 86</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Racing+Sans+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>try{document.documentElement.dataset.theme=localStorage.getItem('th')||'dark'}catch(e){}</script>
<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body><div class="login">
  <form class="card login-card" method="POST" action="{{ route('admin.login.post') }}" data-loading-form>
    @csrf
    <div class="bar"><h2 class="disp"><img class="logo-mark" src="{{ asset('images/logo.png') }}" alt="Logo ONG BLASTING 86"> Login Admin</h2><div class="sp"></div><button class="round" type="button" data-theme-toggle aria-label="Ganti tema">🌙</button></div>
    <p class="small">Khusus admin. Tidak ada pendaftaran publik; akun dibuat oleh pemilik.</p>
    @error('email')<div class="flash bad">{{ $message }}</div>@enderror
    <label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    <div class="form-spacer"></div>
    <label for="password">Password</label><input id="password" type="password" name="password" required>
    <div class="form-spacer"></div>
    <label class="chk"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
    <div class="login-submit"><button class="btn" type="submit">Masuk</button></div>
  </form>
</div></body></html>
