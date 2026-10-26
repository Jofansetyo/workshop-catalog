<?php

namespace App\Http\Controllers;

use App\Models\{Booking, Faq, GalleryItem, Product, Service, Setting, Testimonial};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home(Request $r)
    {
        return view('home', [
            's'          => Setting::map(),
            'services'   => Service::where('is_active', true)->orderBy('name')->get(),
            'products'   => Product::where('is_active', true)->orderBy('name')->limit(8)->get(),
            'reviews'    => Testimonial::where('is_visible', true)->latest()->limit(6)->get(),
            'faqs'       => Faq::orderBy('sort_order')->orderBy('id')->get(),
            'gallery'    => GalleryItem::whereNotNull('image')->latest()->limit(6)->get(),
        ]);
    }

    public function katalog(Request $r)
    {
        $kategori = $r->query('kategori');
        $search   = $r->query('search');

        $products = Product::where('is_active', true)
            ->when($kategori, fn ($q) => $q->where('category', $kategori))
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('brand', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('katalog', [
            's'          => Setting::map(),
            'products'   => $products,
            'categories' => Product::where('is_active', true)->whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'kategori'   => $kategori,
            'search'     => $search,
        ]);
    }

    public function booking(Request $r)
    {
        // Honeypot: kolom "website" tersembunyi, bot biasanya mengisinya.
        if ($r->filled('website')) {
            return redirect()->route('home');
        }
        $d = $r->validate([
            'customer_name' => 'required|string|max:120',
            'phone'         => ['required', 'regex:/^[0-9+\s-]{8,20}$/'],
            'vehicle'       => 'required|string|max:120',
            'service'       => 'required|string|max:120',
            'scheduled_at'  => 'nullable|date|after:now',
            'complaint'     => 'nullable|string|max:500',
        ]);
        $d['code'] = 'BK-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));
        $b = Booking::create($d);

        return redirect()->to(route('home') . '#booking')->with('booked', $b->code);
    }
}
