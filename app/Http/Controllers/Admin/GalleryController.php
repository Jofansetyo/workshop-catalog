<?php

namespace App\Http\Controllers\Admin;

class GalleryController extends CrudController
{
    protected string $model = \App\Models\GalleryItem::class;
    protected string $route = 'galeri';
    protected string $title = 'Galeri';

    protected array $fields = [
        'caption' => ['label' => 'Keterangan', 'type' => 'text', 'rules' => 'required|string|max:150'],
        'kind'    => ['label' => 'Jenis', 'type' => 'select', 'options' => ['Sesudah', 'Sebelum'], 'rules' => 'required|in:Sebelum,Sesudah'],
        'image'   => ['label' => 'Foto (maks 2 MB)', 'type' => 'image', 'rules' => 'nullable|image|max:2048'],
    ];

    protected array $columns = [
        'image' => ['Foto', 'img'], 'caption' => ['Keterangan', 'text'], 'kind' => ['Jenis', 'text'],
    ];
}
