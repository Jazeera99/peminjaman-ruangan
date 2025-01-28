@extends('layouts.main')

@section('title', 'User Dashboard')

@section('content')
<div class="container">
  <div class="">
    @include('table.notifikasi')
  </div>
</div>
<div class="container">
  <div class="">
    @include('table.histori-peminjaman', ['peminjamanRuangans' => $peminjamanRuangans])
  </div>
</div>
@endsection
