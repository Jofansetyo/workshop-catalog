<?php

namespace App\Http\Controllers\Admin;

class FaqController extends CrudController
{
    protected string $model = \App\Models\Faq::class;
    protected string $route = 'faq';
    protected string $title = 'FAQ';

    protected array $fields = [
        'question'   => ['label' => 'Pertanyaan', 'type' => 'text', 'rules' => 'required|string|max:200'],
        'answer'     => ['label' => 'Jawaban', 'type' => 'textarea', 'rules' => 'required|string|max:800'],
        'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'default' => 0, 'rules' => 'nullable|integer|min:0'],
    ];

    protected array $columns = [
        'question' => ['Pertanyaan', 'text'], 'answer' => ['Jawaban', 'text'], 'sort_order' => ['Urutan', 'text'],
    ];
}
