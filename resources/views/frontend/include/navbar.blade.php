
<nav class="navbar navbar-expand-lg" style="background-color: grey;">
  <div class="container">
    <a class="navbar-brand"><img src="{{ asset('assets/image/logo.png') }}" width="70" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-5 mb-lg-0">
        @guest
          <li class="nav-item">
            <button class="btn" style="background-color:orange;"><a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a></button>&nbsp &nbsp
          </li>
          <li class="nav-item">
            <button class="btn" style="background-color:orange;"><a class="nav-link active" aria-current="page" href="{{ url('/login') }}">Login</a></button>&nbsp &nbsp
          </li>
          <li class="nav-item">
            <button class="btn" style="background-color:orange;"><a class="nav-link active" aria-current="page" href="{{ url('/register') }}">Daftar</a></button>
          </li>
          <h3 style="color:orange;" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbspGADGET GLAM - Menjual Berbagai Peralatan Komputer</h3>
        @endguest
        @auth
          <li class="nav-item">
            <button class="btn" style="background-color:orange;"><a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a></button>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Selamat Datang,&nbsp {{ auth()->user()->name }}
            </a>
            @if (auth()->user()->level=="admin")
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('/transaksi') }}">Halaman Admin</a></li>
                <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                {{-- <li><hr class="dropdown-divider"></li> --}}
              </ul>
            @else
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('/profile') }}">Profil</a></li>
                <li><a class="dropdown-item" href="{{ url('/history') }}">Riwayat Pesanan</a></li>
                <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
              </ul>

              <li class="nav-item">
            <?php
              $cart_utama = \App\Models\Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
              if(!empty($cart_utama))
              {
                $notif = \App\Models\Transaction::where('cart_id', $cart_utama->id)->count(); 
              }
            ?>
            <a class="nav-link" href="{{ url('check-out') }}">
                <i class="fa fa-shopping-cart"></i>
                @if(!empty($notif))
                  <span class="badge badge-danger">{{ $notif }}</span>
                @endif
            </a>
          </li>
            @endif
          </li>
          <h3 style="color:orange;" >&nbsp&nbsp&nbsp&nbsp&nbsp GADGET GLAM - Menjual Berbagai Peralatan Komputer</h3>
        @endauth
      </ul>
    </div>
  </div>
</nav>
