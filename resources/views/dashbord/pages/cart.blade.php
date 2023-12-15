@extends('dashbord.layout.main')

@section('content')
<main class="container-fluid px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Detail Pesanan</h1>
    </div>
  
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
  
    <div class="card mb-4">
      <div class="card-body">
          <table id="datatablesSimple">
              <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Tanggal Pesan</th>
                    <th>Total Belanja</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($cart as $item)
                  <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->tanggal}}</td>
                    <td align="right">Rp. {{ number_format($item->jumlah_harga+$item->kode) }}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div>
  </main>
@endsection