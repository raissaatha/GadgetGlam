@extends('frontend.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $a)
            <div class="col-md-3 mt-4">
                <div class="card">
                    <img width="200px" height="200px" src="{{ Storage::url('gambar/').$a->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">{{ $a->name }}</h5>
                    <p class="card-text">
                        <strong>Harga : </strong> Rp. {{ number_format($a->price) }} <br>
                        <strong>Stok :</strong> {{ $a->stok }} <br>
                    </p>
                    <a href="/detail/{{ $a->id }}" class="btn" style="background-color:orange;"><i class="fas fa-shopping-cart"></i> Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br/>
</div>
@endsection