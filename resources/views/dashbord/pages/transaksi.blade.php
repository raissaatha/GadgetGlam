@extends('dashbord.layout.main')

@section('content')
<main class="container-fluid px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Transaksi</h1>
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
                    <th>Produk</th>
                    <th>Status Pembayaran</th>
                    <th>Bukti Transfer</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($transaction as $item)
                  <tr>
                    <td>{{ $item->cart->user->name }}</td>
                    <td>{{ $item->product->name}}</td>
                    <td>
                      @if( $item->cart->status  == 1)
                      <form action="/verify" method="get" class="d-inline">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->cart->id }}">
                          <button type="submit" class="btn btn-warning" >Belum Diterima</button>
                      </form>
      
                  @else
                      <form action="/block" method="get" class="d-inline">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->cart->id }}">
                          <button type="submit" class="btn btn-success" >Diterima</button>
                      </form>
                  @endif
                    </td>
                    <td>
                    @foreach ($buktitransfer as $items)
                    <img src="{{ Storage::url('buktitransfer/').$items->buktitransfer }}" width="100px"   alt="">
                    @endforeach  
                    </td>
                    <td>{{ $item->jumlah}}</td>
                    <td align="right">Rp. {{ number_format($item->jumlah_harga-$item->cart->kode) }}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div>
  </main>
@endsection