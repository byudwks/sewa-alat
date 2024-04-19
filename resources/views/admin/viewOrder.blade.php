@extends('admin.main')

@section('container')
@include('sweetalert::alert')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class ="text-center my-3">Pesanan Detail</h3>

                <div class="card my-2 shadow-lg">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-8">

                                <div class="row">
                                <div class="col-md-12 ">
                                    <div class="fw-bold fs-3 text">
                                        BUMK Karya Mandiri
                                        <small  class="fw-normal fs-6 text float-end">{{ $pesan->tanggal_pinjam }} / {{ $pesan->tanggal_pulang }}</small>
                                    </div>
                                </div>
                                </div>
                                <br>

                                <br>
                                <div class="row mx-5">
                                    <div class="col-sm-6">
                                        <h5 class = "fw-bold fs-5 text">{{ $pesan->user->nama}}</h5>  
                                        <small class = "fw-normal" >Nomer Telepon : {{ $pesan->no_hp}} </small>
                                        <small class = "fw-normal d-block" >{{ $pesan->alamat_acara}} </small>
                                        <small> Tanggal Pengembalian : {{ $pesan->tanggal_kembali }}</small>
                                    </div>
                                
                                    <div class="col-sm-6">
                                        <small class= "fw-bold float-end">{{ $pesan->token}}</small>
                                        <small class= "float-end">No. Pesanan  :  </small>
                                    </div>
                                </div>
                                <br>

                                <div class="row ms-3">
                                    <div class="col-md-4 mt-5">
                                        @if($pesan->post->image)
                                            <div style="max-height:200px; max-width:400px; overflow:hidden;">
                                                <img src="{{ asset('storage/'. $pesan->post->image) }}" class="card-img-top" alt="...">
                                            </div>
                                        @else
                                            <img src="{{ 'img/img-nt.jpg' }}" class="card-img-top " widht="100px" alt="...">
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%" class ="fs-4 text">{{ $pesan->post->name }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Harga Sewa</th>
                                                    <td>Rp {{number_format($pesan->post->harga,0,',','.')}}</td>
                                                </tr>
                                                <tr>
                                                <th>Jumlah Barang</th>
                                                    <td>{{ $pesan->jumlah_barang }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Lama Sewa</th>
                                                    <td>{{ $pesan->jumlah_hari }} Hari</td>
                                                </tr>
                                                <tr>
                                                    <th>Down Payment</th>
                                                    <td>Rp {{number_format($pesan->dp,0,',','.')}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Hilang/Rusak</th>
                                                    @if($pesan->hilang_rusak == null)
                                                    <td><h6>-</h6></td>
                                                    @else
                                                    <td>{{ $pesan->hilang_rusak }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    @if($pesan->keterangan == null)
                                                    <td><h6>-</h6></td>
                                                    @else
                                                    <td class="text-capitalize">{{ $pesan->keterangan }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Denda</th>
                                                    @if($pesan->denda == null)
                                                    <td><h6>-</h6></td>
                                                    @else
                                                    <td>Rp {{number_format($pesan->denda,0,',','.')}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Belum Dibayar</th>
                                                    <td>Rp {{number_format($pesan->belum_bayar,0,',','.')}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Bayar</th>
                                                    <td class="fw-bold fst-italic">Rp {{number_format($pesan->jumlah_harga,0,',','.')}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                                
                            <div class="col-md-4">
                                <h5 class="text-center">Bukti Struk</h5>
                                @if($pesan->image)
                                    <img src="{{ asset('storage/' . $pesan->image) }} " class="img-preview img-fluid mb-1 me-4 float-end" style="height: 22rem; width: 15rem;">
                                @else
                                    <img src="{{ 'img/img-nt.jpg' }}" class="img-preview img-fluid mb-1 me-4 float-end" style="height: 22rem; width: 15rem;">
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 mb-1">
                                @if($pesan->status_pesan == 'Belum Terkonfirmasi')
                                    <span class="float-start ms-4 fs-5 fw-bold text-danger"> {{ $pesan->status_pesan }} </span>
                                @else
                                    <span class="float-start ms-4 fs-5 fw-bold text-success"> {{ $pesan->status_pesan }} </span>
                                @endif
                                <div class="mt-2 float-end me-4">
                                    <form action="/orders/{{ $pesan->id }}" method="post" class = "d-inline">
                                        @method('put')
                                        @csrf
                                        <button class = "bg bg-info border-0 rounded-2" onclick = "return confirm('Mengonfirmasi Pesanan ?')"><i class="bi bi-check-square-fill"></i> Konfirmasi Pesanan</button>
                                    </form>
                                    
                                    <form action="/orders/{{ $pesan->id }}" method="post" class = "d-inline">
                                        @csrf
                                        <button class = "bg bg-success border-0 rounded-2 " onclick = "return confirm('Yakin Mengembalikan barang ?')"><i class="bi bi-info-circle-fill"></i> Barang Kembali</button>
                                    </form>   
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-end me-4">
                                    <form action="/invoice/{{ $pesan->id }}" method="" class = "d-inline">
                                        <button class = "bg bg-danger border-0 rounded-2 "><i class="bi bi-printer-fill"></i> Cetak Nota</button>
                                    </form>

                                    <form action="/orders-pesanselesai/{{ $pesan->id }}" method="post" class = "d-inline">
                                        @csrf
                                        <button class = "bg bg-warning border-0 rounded-2 " onclick = "return confirm('Yakin Menyelesaikan Pesanan ?')"><i class="bi bi-cart-check-fill"></i> Pesanan Selesai</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>    
                </div>

        </div>
    </div>
</div>

@endsection