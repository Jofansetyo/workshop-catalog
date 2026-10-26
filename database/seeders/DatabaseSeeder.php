<?php

namespace Database\Seeders;

use App\Models\{Faq, Product, Service, Setting, Testimonial, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin: tidak ada password bawaan. Atur lewat .env atau catat password acak yang dicetak.
        $email = env('ADMIN_EMAIL', 'admin@ongblasting86.test');
        $pass  = env('ADMIN_PASSWORD') ?: Str::random(14);
        User::updateOrCreate(['email' => $email], ['name' => 'Admin', 'password' => Hash::make($pass)]);
        $this->command?->warn("Login admin -> email: {$email} | password: {$pass}");

        foreach ([
            'shop_name' => 'ONG BLASTING 86', 'tagline' => 'Racik tenaga. Tarik gas. Menang.',
            'whatsapp' => '6281234567890', 'email' => 'halo@ongblasting86.test',
            'address' => 'Jl. Contoh No. 12, Madiun', 'hours' => "Senin - Sabtu: 08.00 - 17.00\nMinggu: tutup",
        ] as $k => $v) {
            Setting::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        if (Service::count() === 0) {
            foreach ([
                ['Ganti Oli', 'Perawatan', 35000, '30 menit', 'Oli mesin dan filter, termasuk cek cairan lain.'],
                ['Tune Up', 'Performa', 150000, '1-2 jam', 'Busi, injektor/karburator, dan setelan mesin.'],
                ['Tune Up Racing', 'Performa', 450000, '3 jam', 'Setelan performa untuk tarikan maksimal.'],
                ['Servis Rem', 'Keselamatan', 80000, '1 jam', 'Kampas, minyak rem, dan cakram.'],
                ['Kelistrikan', 'Perawatan', 100000, '1-2 jam', 'Aki, lampu, dan sistem pengisian.'],
                ['Ganti Ban', 'Kaki-kaki', 50000, '45 menit', 'Ganti ban, balancing, cek suspensi.'],
            ] as [$n, $c, $p, $e, $d]) {
                Service::create(['name' => $n, 'category' => $c, 'price' => $p, 'estimate' => $e, 'description' => $d]);
            }
            foreach ([
                ['Oli Mesin 0,8L', 'Yamalube', 'Oli', 65000, 12], ['Kampas Rem Depan', 'Aspira', 'Rem', 48000, 3],
                ['Busi Iridium', 'NGK', 'Kelistrikan', 78000, 20], ['Aki 5Ah', 'GS Astra', 'Kelistrikan', 185000, 2],
                ['Ban Tubeless 80/90', 'IRC', 'Ban', 210000, 5], ['Ban Dalam', 'FDR', 'Ban', 38000, 0],
            ] as [$n, $b, $c, $p, $s]) {
                Product::create(['name' => $n, 'brand' => $b, 'category' => $c, 'price' => $p, 'stock' => $s]);
            }
            foreach ([
                ['Rudi', 5, 'Estimasi harga jelas di awal, motor selesai tepat waktu.', 'WhatsApp'],
                ['Sinta', 5, 'Booking lewat web, datang langsung dikerjakan.', 'Google Maps'],
            ] as [$n, $r, $b, $s]) {
                Testimonial::create(['name' => $n, 'rating' => $r, 'body' => $b, 'source' => $s]);
            }
            foreach ([
                ['Apakah harus daftar akun untuk booking?', 'Tidak. Cukup isi nama dan nomor HP, atau chat WhatsApp.'],
                ['Berapa lama pengerjaan servis?', 'Ganti oli sekitar 30 menit, tune up 1 sampai 2 jam.'],
                ['Apakah ada garansi?', 'Ya, 30 sampai 60 hari sesuai paket pengerjaan.'],
            ] as $i => [$q, $a]) {
                Faq::create(['question' => $q, 'answer' => $a, 'sort_order' => $i]);
            }
        }
    }
}
