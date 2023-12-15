@extends('dashbord.layout.main')

@section('content')
<main class="container-fluid px-5 mt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Menu</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif

    <form method="post" action="/product/{{ $product->id }}" id="myForm" enctype="multipart/form-data" class="row g-3">
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="desk" class="from-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
            aria-describedby="emailHelp" name="name" value="{{ $product->name }}" > 
            @error('name')
                <div class="invalid-feedback">
                    Nama tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control @error('stok') is-invalid @enderror"
                id="exampleInputPassword1" name="stok" value="{{ $product->stok }}">
            @error('stok')
                <div class="invalid-feedback">
                    Stok tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Harga</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror"
                id="exampleInputPassword1" name="price" value="{{ $product->price }}">
            @error('price')
                <div class="invalid-feedback">
                    Harga tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="desk" class="from-label">Deskripsi</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror"
            id="exampleInputPassword1" name="description" value="{{ $product->description }}" > 
            @error('description')
                <div class="invalid-feedback">
                    Deskripsi tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="img" class="form-label">Gambar</label>
            <img class="img-preview img-fluid mb-3 col-sm-3">
            <input class="form-control" type="file" id="image" name="image" onchange="previewimage()" value="{{ $product->image }}">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
</main>
@endsection