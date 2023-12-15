@extends('dashbord.layout.main')

@section('content')
<main class="container-fluid px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Produk</h1>
    <a href="/product/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk</a>
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
                  <th>Deskripsi</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Gambar</th>
                  <th width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $item)
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->stok }}</td>
                  <td>{{ $item->price }}</td>
                  <td><img width="60px" height="60px" src="{{ Storage::url('gambar/').$item->image }}" ></td>
                  <td>
                    <form action="/product/{{ $item->id }}" method="POST" class="d-inline">
                      @method('DELETE')
                      @csrf
                      {{-- Update  --}}
                      <a href="product/{{ $item->id }}/edit" class="badge bg-info"><i class="fa-solid fa-pen-to-square"></i></a>  
                      {{-- Delete  --}}
                      <button class="badge bg-danger border-0" onclick="return confirm('apakah anda yakin ?')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</main>
@endsection