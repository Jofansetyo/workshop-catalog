<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Product};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $bars = collect(range(6, 0))->map(fn ($d) => [
            'label' => now()->subDays($d)->format('d/m'),
            'n'     => Booking::whereDate('created_at', now()->subDays($d)->toDateString())->count(),
        ]);

        return view('admin.dashboard', [
            'today'   => Booking::whereDate('created_at', today())->count(),
            'pending' => Booking::where('status', 'Menunggu')->count(),
            'low'     => Product::where('stock', '<', 5)->count(),
            'month'   => Booking::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'bars'    => $bars,
            'max'     => max(1, $bars->max('n')),
            'top'     => Booking::select('service', DB::raw('count(*) as n'))->groupBy('service')->orderByDesc('n')->limit(5)->get(),
            'recent'  => Booking::latest()->limit(6)->get(),
        ]);
    }
}
