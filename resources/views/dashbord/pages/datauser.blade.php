@extends('dashbord.layout.main')

@section('content')
<main class="container-fluid px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data User</h1>
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
                    <th>Email</th>
                    <th>Level</th>
                    <th>Alamat</th>
                    <th>Nomor HP</th>
                    <th>Terdaftar Pada</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($datauser as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email}}</td>
                    <td>{{ $item->level}}</td>
                    <td>{{ $item->alamat}}</td>
                    <td>{{ $item->nohp}}</td>
                    <td>{{ $item->created_at}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
  </main>
@endsection