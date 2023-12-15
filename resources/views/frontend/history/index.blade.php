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
                    <h3><i class="fa fa-history"></i> Riwayat Pesanan</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Jumlah Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($carts as $item)
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    @if($item->status == 1)
                                        Sudah dipesan & Belum dibayar
                                    @else
                                        Sudah dibayar & Dikirim 
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($item->jumlah_harga-$item->kode) }}</td>
                                <td>
                                    <a href="{{ url('history') }}/{{ $item->id }}" class="btn btn-primary"><i class="fa fa-file-text-o"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection