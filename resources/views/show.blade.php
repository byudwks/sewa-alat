@extends('layouts.main')
@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-1">
                <a href="/post" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <h2 class ='text-center fw-bold mb-2'>Buat Pesanan</h2>
            <div class="card shadow-lg mt-1" style=" height:37rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($post->image)
                            <div style="max-height:350px; max-width:100%; overflow:hidden;">
                                <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top p-2" alt="...">
                            </div>
                            @else
                                <img src="{{ '/img/img-nt.jpg' }}" class="card-img-top" alt="...">
                            @endif
                            <h2 class="ms-2">{{ $post->name }}</h2>
                            <h4 class="ms-2">Rp {{number_format($post->harga,0,',','.')}} / Hari</h4>
                            <small class="ms-2 ">
                            @if($post->jmlh_barang != 0)
                            <strong class=" text-dark"> Stok Barang : {{ $post->jmlh_barang }} Biji</strong>
                            @else
                            <strong class=" text-danger"> Stok Tidak Tersedia</strong>
                            @endif
                            </small>
                        </div>
                            <div class="col-md-6 mt-2">

                                <form action="/post/{{ $post->id }}" method="post" class = "text-center">
                                    @csrf
                                    <div class="form-floating my-3">
                                        <input type="text" name="nama_acara" class="form-control" id="nama_acara" placeholder="Nama Acara" required >
                                        <label for="nama_acara">Nama Acara</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="address" name="alamat_acara" class="form-control" id="alamat_acara" placeholder="Alamat Acara" required >
                                        <label for="alamat_acara">Alamat Acara</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomer HP" required >
                                        <label for="no_hp">Nomer HP</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="number" name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Jumlah Hari" required >
                                        <label for="jumlah_hari">Jumlah Hari</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="number" name="jumlah_barang" class="form-control" id="jumlah_barang" placeholder="Jumlah Barang" required >
                                        <label for="jumlah_barang">Jumlah Barang</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" name="dp" class="form-control" id="dp" placeholder="Down Payment"  >
                                        <label for="dp">Down Payment</label>
                                    </div>
                                    <div class="row ">
                                        <div class="col">
                                            <div class="container-btn-all">
                                                <button class=" btn-all fw-bold" type="submit">Pesan Sekarang</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection