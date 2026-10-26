<?php

namespace App\Http\Controllers\Admin;

class TestimonialController extends CrudController
{
    protected string $model = \App\Models\Testimonial::class;
    protected string $route = 'testimoni';
    protected string $title = 'Testimoni';

    protected array $fields = [
        'name'       => ['label' => 'Nama pelanggan', 'type' => 'text', 'rules' => 'required|string|max:100'],
        'rating'     => ['label' => 'Rating', 'type' => 'select', 'options' => [5, 4, 3, 2, 1], 'rules' => 'required|integer|between:1,5'],
        'source'     => ['label' => 'Sumber', 'type' => 'select', 'options' => ['WhatsApp', 'Google Maps', 'Langsung di bengkel'], 'rules' => 'required|string|max:60'],
        'body'       => ['label' => 'Isi ulasan', 'type' => 'textarea', 'rules' => 'required|string|max:600'],
        'is_visible' => ['label' => 'Tampil di web', 'type' => 'bool', 'default' => true, 'rules' => 'nullable'],
    ];

    protected array $columns = [
        'name' => ['Pelanggan', 'text'], 'rating' => ['Rating', 'text'], 'body' => ['Ulasan', 'text'],
        'source' => ['Sumber', 'text'], 'is_visible' => ['Status', 'bool'],
    ];
}
