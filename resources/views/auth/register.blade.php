@extends('auth.layout.app')

@section('content')

        <div class="card" style="background-color: orange;">
            <div class="card-body">
                <form action="{{ url('register') }}" method="POST">
                        @csrf
                        <h2>Daftar</h2>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="nameHelp">
                            @error('name')
                                <div id="nameHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp">
                            @error('email')
                                <div id="emailHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                                <div id="passwordHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                                <div id="passwordConfirmationHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <p>
                            Sudah punya akun?
                            <br><a href="/login">Login Sekarang</a></br>
                        </p>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>

@endsection

