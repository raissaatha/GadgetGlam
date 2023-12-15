@extends('frontend.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3 mt-3">
            <img src="{{ asset('assets/images/logo.png') }}" class="rounded mx-auto d-block" width="150" alt="">
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Keranjang</h3>
                    @if(!empty($cart))
                    <p align="right">Tanggal Pesan : {{ $cart->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($transactions as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img width="100px" src="{{ Storage::url('gambar/').$item->product->image }}" alt="...">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td align="right">Rp. {{ number_format($item->product->price) }}</td>
                                <td align="right">Rp. {{ number_format($item->jumlah_harga) }}</td>
                                <td>
                                    <a href="/check-out/{{ $item->id }}/delete">
                                        <button class="btn btn-danger mt-2" type="button"><i class="fa-solid fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                            @if(session('pesan'))
                            <div class="alert alert-danger">
                                {{ session('pesan') }}
                            </div>
                            @endif
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($cart->jumlah_harga) }}</strong></td>
                                <td>
                                    <a href="{{ url('konfirmasi') }}" class="btn btn-success" onclick="return confirm('Anda yakin akan memesan barang yang dipilih ?');">
                                        <i class="fa fa-shopping-cart"></i> Checkout
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection