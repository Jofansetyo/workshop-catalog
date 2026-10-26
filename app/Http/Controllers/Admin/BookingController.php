<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public const STATUS = ['Menunggu', 'Dikonfirmasi', 'Dikerjakan', 'Selesai', 'Ditolak'];

    public function index(Request $r)
    {
        $status = $r->query('status');
        $items = Booking::when(in_array($status, self::STATUS, true), fn ($q) => $q->where('status', $status))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.booking', ['items' => $items, 'status' => $status, 'all' => self::STATUS]);
    }

    public function status(Request $r, $id)
    {
        $d = $r->validate(['status' => 'required|in:' . implode(',', self::STATUS)]);
        Booking::findOrFail($id)->update($d);
        return back()->with('ok', 'Status booking diperbarui.');
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return back()->with('ok', 'Booking dihapus.');
    }
}
