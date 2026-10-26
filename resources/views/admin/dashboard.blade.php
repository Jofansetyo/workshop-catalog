@extends('layouts.admin')
@section('title', 'Ringkasan')
@section('content')
<div class="grid k">
  <div class="card kpi"><span>Booking hari ini</span><b>{{ $today }}</b></div>
  <div class="card kpi y"><span>Menunggu konfirmasi</span><b>{{ $pending }}</b></div>
  <div class="card kpi"><span>Stok menipis</span><b>{{ $low }}</b></div>
  <div class="card kpi y"><span>Booking bulan ini</span><b>{{ $month }}</b></div>
</div>
<div class="grid two">
  <div class="card"><h2>Booking 7 Hari Terakhir</h2>
    <div class="bars">@foreach($bars as $b)<div><b>{{ $b['n'] }}</b><i style="height:{{ max(4, round($b['n'] / $max * 90)) }}%"></i>{{ $b['label'] }}</div>@endforeach</div></div>
  <div class="card y"><h2>Layanan Terlaris</h2>
    @forelse($top as $t)<p style="display:flex;justify-content:space-between"><span>{{ $t->service }}</span><b>{{ $t->n }}</b></p>@empty<p class="small">Belum ada data.</p>@endforelse</div>
</div>
<div class="card"><div class="bar"><h2>Booking Terbaru</h2><div class="sp"></div><a class="btn g" href="{{ route('admin.booking.index') }}">Lihat semua</a></div>
  <div class="scroll"><table><thead><tr><th>Kode</th><th>Pelanggan</th><th>Layanan</th><th>Status</th></tr></thead><tbody>
  @forelse($recent as $b)<tr><td>{{ $b->code }}</td><td>{{ $b->customer_name }}<small>{{ $b->vehicle }}</small></td><td>{{ $b->service }}</td><td><span class="badge s-{{ $b->status }}">{{ $b->status }}</span></td></tr>
  @empty<tr><td colspan="4">Belum ada booking.</td></tr>@endforelse</tbody></table></div></div>
@endsection
