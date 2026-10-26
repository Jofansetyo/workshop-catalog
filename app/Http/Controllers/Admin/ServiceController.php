<?php

namespace App\Http\Controllers\Admin;

class ServiceController extends CrudController
{
    protected string $model = \App\Models\Service::class;
    protected string $route = 'layanan';
    protected string $title = 'Layanan';

    protected array $fields = [
        'name'        => ['label' => 'Nama layanan', 'type' => 'text', 'rules' => 'required|string|max:120'],
        'category'    => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Perawatan', 'Performa', 'Keselamatan', 'Kaki-kaki'], 'rules' => 'required|string|max:60'],
        'price'       => ['label' => 'Harga (Rp)', 'type' => 'number', 'rules' => 'required|integer|min:0'],
        'estimate'    => ['label' => 'Estimasi waktu', 'type' => 'text', 'rules' => 'nullable|string|max:60'],
        'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
        'is_active'   => ['label' => 'Tampil di web', 'type' => 'bool', 'default' => true, 'rules' => 'nullable'],
    ];

    protected array $columns = [
        'name' => ['Layanan', 'text'], 'category' => ['Kategori', 'text'], 'price' => ['Harga', 'rp'],
        'estimate' => ['Estimasi', 'text'], 'is_active' => ['Status', 'bool'],
    ];
}
