@extends('layouts.main')
@section('container')

<div class="row justify-content-center p-3 mt-4" style="height: 900px;" >
    <div class="col-md-4">
        <main class="form-registrasi text-center">
          <form action = "/registrasi" method ="post">
            @csrf
            <img class="mb-2" src="/img/bumk.png" alt="bumk" style=" width:120px; height:100px;">
            <h1 class="h3 mb-3 fw-bold text-center">Silahkan Mendaftar</h1>
            <div class="form-floating mb-2">
              <input type="text" name= "nama"  class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" required value="{{ old('nama') }}">
              <label for="nama">Nama</label>
              @error('nama')
                <div class="invalid-feedback">
                {{ $message }}
              @enderror
            </div>
            <div class="form-floating mb-2">
              <input type="text" name= "username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
              <label for="username">Username</label>
              @error('username')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-floating mb-2">
              <input type="email" name= "email" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="name@example.com" required value="{{ old('email') }}">
              <label for="email">Alamat Email</label>
              @error('email')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input type="password" name= "password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
              @enderror
            </div>
            <div class="container-btn-login">
              <button class="btn-login w-50 fw-bold mb-3" type="submit">Mendaftar</button>
            </div>
          </form>
          <small>Sudah Mendaftar<a href="/login" class = "text-decoration-none fw-bold text-success">   Masuk</a></small>
        </main>
    </div>
</div>


@endsection