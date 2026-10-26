@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="bar"><div class="sp"></div><a class="btn" href="{{ route('admin.'.$route.'.create') }}">+ Tambah {{ $title }}</a></div>
<div class="card"><div class="scroll"><table>
<thead><tr>@foreach($columns as $c)<th>{{ $c[0] }}</th>@endforeach<th>Aksi</th></tr></thead><tbody>
@forelse($items as $row)
<tr>
  @foreach($columns as $k => $c)
  @php($v = $row->{$k})
  <td>
  @switch($c[1])
    @case('rp')
      Rp {{ number_format($v, 0, ',', '.') }}
      @break
    @case('bool')
      <span class="badge s-{{ $v ? 'Tampil' : 'Habis' }}">{{ $v ? 'Aktif' : 'Nonaktif' }}</span>
      @break
    @case('stock')
      <span class="badge s-{{ $v == 0 ? 'Habis' : ($v < 5 ? 'Menipis' : 'Tersedia') }}">{{ $v }}</span>
      @break
    @case('img')
      @if($v)<img class="thumbs" src="{{ asset('storage/'.$v) }}" alt="">@endif
      @break
    @default
      {{ \Illuminate\Support\Str::limit((string) $v, 60) }}
  @endswitch
  </td>
  @endforeach
  <td class="acts">
    <a class="act" href="{{ route('admin.'.$route.'.edit', $row->id) }}">Ubah</a>
    <form method="POST" action="{{ route('admin.'.$route.'.destroy', $row->id) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="act no" type="submit">Hapus</button></form>
  </td>
</tr>
@empty<tr><td colspan="{{ count($columns) + 1 }}">Belum ada data.</td></tr>@endforelse
</tbody></table></div>{{ $items->links('pagination::simple-default') }}</div>
@endsection
