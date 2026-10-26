<?php

namespace App\Http\Controllers\Admin;

class ProductController extends CrudController
{
    protected string $model = \App\Models\Product::class;
    protected string $route = 'sparepart';
    protected string $title = 'Sparepart';

    protected array $fields = [
        'name'      => ['label' => 'Nama produk', 'type' => 'text', 'rules' => 'required|string|max:120'],
        'brand'     => ['label' => 'Merek', 'type' => 'text', 'rules' => 'nullable|string|max:60'],
        'category'  => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Oli', 'Rem', 'Kelistrikan', 'Ban', 'Lainnya'], 'rules' => 'required|string|max:60'],
        'price'     => ['label' => 'Harga (Rp)', 'type' => 'number', 'rules' => 'required|integer|min:0'],
        'stock'     => ['label' => 'Stok', 'type' => 'number', 'rules' => 'required|integer|min:0'],
        'image'     => ['label' => 'Foto produk (maks 2 MB)', 'type' => 'image', 'rules' => 'nullable|image|max:2048'],
        'is_active' => ['label' => 'Tampil di web', 'type' => 'bool', 'default' => true, 'rules' => 'nullable'],
    ];

    protected array $columns = [
        'image' => ['Foto', 'img'], 'name' => ['Produk', 'text'], 'brand' => ['Merek', 'text'],
        'category' => ['Kategori', 'text'], 'price' => ['Harga', 'rp'], 'stock' => ['Stok', 'stock'], 'is_active' => ['Status', 'bool'],
    ];
}
