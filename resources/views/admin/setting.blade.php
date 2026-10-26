@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('content')
<form class="card fg" method="POST" action="{{ route('admin.setting.update') }}">
  @csrf @method('PUT')
  @foreach($keys as $k => $label)
  <div class="{{ in_array($k, ['address', 'hours']) ? 'full' : '' }}">
    <label for="{{ $k }}">{{ $label }}</label>
    @if(in_array($k, ['address', 'hours']))<textarea id="{{ $k }}" name="{{ $k }}" rows="3">{{ old($k, $values[$k] ?? '') }}</textarea>
    @else<input id="{{ $k }}" name="{{ $k }}" value="{{ old($k, $values[$k] ?? '') }}">@endif
    @error($k)<small class="err">{{ $message }}</small>@enderror
  </div>
  @endforeach
  <div class="full"><button class="btn" type="submit">Simpan</button></div>
</form>
@endsection
