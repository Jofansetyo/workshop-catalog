<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public const KEYS = [
        'shop_name' => 'Nama bengkel',
        'tagline'   => 'Tagline',
        'whatsapp'  => 'WhatsApp (format 62812...)',
        'email'     => 'Email',
        'address'   => 'Alamat',
        'hours'     => 'Jam operasional',
    ];

    public function edit()
    {
        return view('admin.setting', ['keys' => self::KEYS, 'values' => Setting::map()]);
    }

    public function update(Request $r)
    {
        $d = $r->validate([
            'shop_name' => 'required|string|max:100',
            'tagline'   => 'nullable|string|max:200',
            'whatsapp'  => ['nullable', 'regex:/^[0-9]{8,15}$/'],
            'email'     => 'nullable|email|max:120',
            'address'   => 'nullable|string|max:300',
            'hours'     => 'nullable|string|max:300',
        ]);
        foreach ($d as $k => $v) {
            Setting::updateOrCreate(['key' => $k], ['value' => $v]);
        }
        return back()->with('ok', 'Pengaturan tersimpan.');
    }
}
