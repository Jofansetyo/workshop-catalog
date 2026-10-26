# ONG BLASTING 86 – Laravel overlay

Salin isi folder ini ke root project Laravel kamu (timpa file yang sama):
`routes/web.php` dan `database/seeders/DatabaseSeeder.php` akan tertimpa, cadangkan dulu bila sudah kamu ubah.

```bash
# 1. atur database di .env, lalu:
php artisan migrate --seed     # catat email & password admin yang dicetak
php artisan storage:link       # agar foto upload bisa tampil
php artisan serve
```

- Web publik: http://localhost:8000
- Admin: http://localhost:8000/admin/login
- Ingin password sendiri? Isi `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di `.env` sebelum `--seed`.
- Produksi: `APP_ENV=production`, `APP_DEBUG=false`, aktifkan HTTPS.
- Tanpa Tailwind/Vite: CSS dan JS ada di `public/css/app.css` dan `public/js/app.js`.
