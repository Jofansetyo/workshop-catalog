<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller CRUD generik. Tiap resource cukup mendefinisikan
 * $model, $route, $title, $fields, dan $columns.
 */
abstract class CrudController extends Controller
{
    protected string $model;
    protected string $route;
    protected string $title;
    protected array $fields = [];
    protected array $columns = [];

    protected function meta(): array
    {
        return ['title' => $this->title, 'route' => $this->route, 'fields' => $this->fields, 'columns' => $this->columns];
    }

    protected function back(string $msg)
    {
        return redirect()->route("admin.{$this->route}.index")->with('ok', $msg);
    }

    protected function payload(Request $r, $item = null): array
    {
        $data = $r->validate(collect($this->fields)->map(fn ($f) => $f['rules'])->all());
        foreach ($this->fields as $n => $f) {
            if ($f['type'] === 'bool') {
                $data[$n] = $r->boolean($n);
            }
            if ($f['type'] === 'image') {
                unset($data[$n]);
                if ($r->hasFile($n)) {
                    if ($item && $item->{$n}) {
                        Storage::disk('public')->delete($item->{$n});
                    }
                    $data[$n] = $r->file($n)->store($this->route, 'public');
                }
            }
        }
        return $data;
    }

    public function index()
    {
        $m = $this->model;
        return view('admin.crud.index', $this->meta() + ['items' => $m::latest('id')->paginate(15)]);
    }

    public function create()
    {
        $m = $this->model;
        return view('admin.crud.form', $this->meta() + ['item' => new $m]);
    }

    public function store(Request $r)
    {
        $m = $this->model;
        $m::create($this->payload($r));
        return $this->back($this->title . ' berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $m = $this->model;
        return view('admin.crud.form', $this->meta() + ['item' => $m::findOrFail($id)]);
    }

    public function update(Request $r, $id)
    {
        $m = $this->model;
        $item = $m::findOrFail($id);
        $item->update($this->payload($r, $item));
        return $this->back($this->title . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = $this->model;
        $item = $m::findOrFail($id);
        foreach ($this->fields as $n => $f) {
            if ($f['type'] === 'image' && $item->{$n}) {
                Storage::disk('public')->delete($item->{$n});
            }
        }
        $item->delete();
        return $this->back('Data dihapus.');
    }
}
