@extends('layouts.main')
@section('container')

<div class="row justify-content-center p-3 mt-5" style = "height: 800px">
    <div class="col-md-4">

        @include('sweetalert::alert')

        <main class="form-signin text-center">
          <form action = "/login" method ="post">
            @csrf
            <img class="mb-2" src="/img/bumk.png" alt="bumk" width="110" height="90">
            <h1 class="h3 mb-3 fw-bold">Silahkan Masuk</h1>
            <div class="form-floating mb-2">
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" autofocus value="{{old('username')}}">
              <label for="username">Username</label>
              @error('username')
                <div class = "invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " id="password" placeholder="Password">
              <label for="password">Password</label>
              @error('username')
                <div class = "invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="container-btn-login">
              <button class="btn-login w-50 mb-3 fw-bold" type="submit">Masuk</button>
            </div>
          </form>
          <small>Belum Mendaftar<a href="/registrasi" class = "text-decoration-none fw-bold text-success">    Daftar Sekarang </a></small>
        </main>
    </div>
</div>
  
@endsection