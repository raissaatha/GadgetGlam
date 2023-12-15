@extends('frontend.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Sukses Checkout</h3>
                    <h5>Pesanan anda sukses dicheckout, selanjutnya untuk pembayaran silahkan transfer ke rekening <strong> Bank Mandiri</strong> dengan <strong>Nomer Rekening : 1570006097209</strong> dengan nominal : <strong>Rp. {{ number_format($cart->jumlah_harga-$cart->kode) }}</strong></h5>
                    <h5>Untuk informasi lebih lanjut hubungi Whatsapp <strong><a href="https://wa.me/6281288182872"> 081288182872</a></strong></h5>
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('upload.bukti', ['id'=>$cart -> id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="photo">Silahkan upload bukti pembayaran</label>
                    <div class="input-group">
                    <input type="file" class="form-control" id="photo"  name="photo">
                </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </div>
            </form>
            <div class="card mt-2">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Detail Pesanan</h3>
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
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($transaction as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ Storage::url('gambar/').$item->product->image }}" width="100" alt="...">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td align="right">Rp. {{ number_format($item->product->price) }}</td>
                                <td align="right">Rp. {{ number_format($item->jumlah_harga) }}</td>
                                
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($cart->jumlah_harga) }}</strong></td>
                                
                            </tr>
                             <tr>
                                <td colspan="5" align="right"><strong>Total yang harus ditransfer :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($cart->jumlah_harga-$cart->kode) }}</strong></td>
                                
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