@extends('layouts.admin')
@section('title', 'Booking')
@section('content')
<div class="chips">
  <a class="chip {{ $status ? '' : 'on' }}" href="{{ route('admin.booking.index') }}">Semua</a>
  @foreach($all as $s)<a class="chip {{ $status === $s ? 'on' : '' }}" href="{{ route('admin.booking.index', ['status' => $s]) }}">{{ $s }}</a>@endforeach
</div>
<div class="card"><div class="scroll"><table>
<thead><tr><th>Kode</th><th>Pelanggan</th><th>Kendaraan</th><th>Layanan</th><th>Jadwal</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $b)
<tr>
  <td>{{ $b->code }}</td>
  <td>{{ $b->customer_name }}<small>{{ $b->phone }}</small></td>
  <td>{{ $b->vehicle }}@if($b->complaint)<small>{{ \Illuminate\Support\Str::limit($b->complaint, 50) }}</small>@endif</td>
  <td>{{ $b->service }}</td>
  <td>{{ $b->scheduled_at?->format('d M Y H:i') ?? '-' }}</td>
  <td><form method="POST" action="{{ route('admin.booking.status', $b->id) }}">@csrf @method('PATCH')
    <select name="status" aria-label="Status {{ $b->code }}" onchange="this.form.submit()">@foreach($all as $s)<option @selected($b->status === $s)>{{ $s }}</option>@endforeach</select></form></td>
  <td class="acts">
    <a class="act" href="https://wa.me/{{ preg_replace('/\D/', '', preg_replace('/^0/', '62', $b->phone)) }}" target="_blank" rel="noopener">Chat</a>
    <form method="POST" action="{{ route('admin.booking.destroy', $b->id) }}" onsubmit="return confirm('Hapus booking ini?')">@csrf @method('DELETE')<button class="act no" type="submit">Hapus</button></form>
  </td>
</tr>
@empty<tr><td colspan="7">Belum ada booking.</td></tr>@endforelse
</tbody></table></div>{{ $items->links('pagination::simple-default') }}</div>
@endsection
