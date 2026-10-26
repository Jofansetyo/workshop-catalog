@extends('layouts.admin')
@section('title', ($item->exists ? 'Ubah ' : 'Tambah ').$title)
@section('content')
<form class="card fg" method="POST" enctype="multipart/form-data"
  action="{{ $item->exists ? route('admin.'.$route.'.update', $item->id) : route('admin.'.$route.'.store') }}">
  @csrf
  @if($item->exists) @method('PUT') @endif
  @foreach($fields as $n => $f)
  @php($val = old($n, $item->exists ? $item->{$n} : ($f['default'] ?? null)))
  <div class="{{ in_array($f['type'], ['textarea', 'image']) ? 'full' : '' }}">
    @if($f['type'] === 'bool')
      <label class="chk"><input type="checkbox" name="{{ $n }}" value="1" @checked($val)> {{ $f['label'] }}</label>
    @else
      <label for="{{ $n }}">{{ $f['label'] }}</label>
      @switch($f['type'])
        @case('textarea')
          <textarea id="{{ $n }}" name="{{ $n }}" rows="4">{{ $val }}</textarea>
          @break
        @case('select')
          <select id="{{ $n }}" name="{{ $n }}">@foreach($f['options'] as $o)<option value="{{ $o }}" @selected((string) $val === (string) $o)>{{ $o }}</option>@endforeach</select>
          @break
        @case('image')
          @if($item->exists && $item->{$n})<img class="thumbs" src="{{ asset('storage/'.$item->{$n}) }}" alt=""><br>@endif
          <input id="{{ $n }}" type="file" name="{{ $n }}" accept="image/*">
          @break
        @default
          <input id="{{ $n }}" type="{{ $f['type'] }}" name="{{ $n }}" value="{{ $val }}">
      @endswitch
    @endif
    @error($n)<small class="err">{{ $message }}</small>@enderror
  </div>
  @endforeach
  <div class="full"><button class="btn" type="submit">Simpan</button> <a class="btn g" href="{{ route('admin.'.$route.'.index') }}">Batal</a></div>
</form>
@endsection
