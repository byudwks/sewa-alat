@extends('layouts.main')
@section('container')

@include('sweetalert::alert')

<div class="container">
    <div class="row" style="height : auto">
        <div class="col-md-12">
            <div class="mt-2">
                <a href="/post" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>

            <h3 class ="text-center mb-2">Pesanan Anda</h3>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-info-circle-fill"></i> Note !</h4>
                        <p>Untuk pembayaran dapat di lakukan secara langsung kepada admin, Atau transfer ke nomor rekening di bawah. Upload bukti/struk pembayaran agar pesanan segara di konfirmasi oleh admin. <p>Jika terjadi keterlambatan pengembalian barang maka akan di kenakan denda RP 50.000 per hari</p>
                        <hr>
                        <p class="mb-0 fw-bold">No. REK : 109471924121</p>
                        <p class="mb-0 fw-bold">A/N : Aku Ganteng</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                </div>

            @if($pesanans->count())
            @foreach ($pesanans as $pesan)
            <div class="card my-2 shadow-lg">
                <div class="card-body p-5">
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
                        <h5 class = "fw-bold fs-5 text">{{ auth()->user()->nama}}</h5>  
                        <small class = "fw-normal" >Nomer Telepon : {{ $pesan->no_hp}} </small>
                        <small class = "fw-normal d-block" >{{ $pesan->alamat_acara}} </small>
                        <small>Tanggal Pengembalian : {{ $pesan->tanggal_kembali }}</small>
                    </div>
                    
                    <div class="col-sm-6">
                        <small class= "fw-bold float-end">{{ $pesan->token}}</small>
                        <small class= "float-end">No. Pesanan  :  </small>
                    </div>
                </div>
                <br>

                <div class="row ms-3">
                    <div class="col-sm-4">
                        @if($pesan->post->image)
                            <div style="max-height:250px; max-width:400px; overflow:hidden;">
                                <img src="{{ asset('storage/'. $pesan->post->image) }}" class="card-img-top" alt="...">
                            </div>
                        @else
                            <img src="{{ 'img/img-nt.jpg' }}" class="card-img-top " widht="100px" alt="...">
                        @endif
                    </div>
                    <div class="col-8">
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


            @if($pesan->status_pesan == 'Belum Terkonfirmasi')
                <span class="float-start ms-5 mt-5 fs-5 fw-bold text-danger"> {{ $pesan->status_pesan }} </span>
            @else
                <span class="float-start ms-5 mt-5 fw-bold fs-5 text-success"> {{ $pesan->status_pesan }} </span>
            @endif
            <div class="mt-5 float-end">
                <a href="#" class ="btn-sm btn-info text-decoration-none "  data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $pesan->id }}"><i class="bi bi-bag-x"></i> Hilang / Rusak</a>

                        <div class="modal fade" id="exampleModal-{{ $pesan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hilang / Rusak</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="cekout/kondisi/{{ $pesan->id }}" method="post">
                                            @csrf
                                            <div class="mb-3" >
                                                <label for="hilang_rusak" class="form-label" >Hilang / Rusak</label>
                                                <input type="number" class="form-control" name="hilang_rusak">
                                            </div>
                                            <div class="mb-3 " >
                                                <label for="keterangan" class="form-label" >Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan">
                                            </div>
                                            
                                            <div class="modal-footer d-flex justify-content-center border-none">
                                                <button type="submit" class="btn bg-danger text-white">Ajukan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                <a href="cekout/batalkan/{{$pesan->id}}" class = "btn-sm btn-warning text-decoration-none" onclick = "return confirm('Yakin Membatalkan pesanan ?')"><i class="bi bi-trash"></i> Batalkan Pesanan</a>
                <a href="cekout/edit/{{$pesan->id}}" class ="btn-sm btn-primary text-decoration-none text-dark"><i class="bi bi-file-earmark-arrow-up-fill"></i> Upload Struk</a>
                <a href="invoice/{{$pesan->id}}" class = "btn-sm btn-danger text-decoration-none text-dark"><i class="bi bi-printer-fill"></i>  Cetak</a>
            </div>
        </div>
    </div> 
    @endforeach
</div>

@else
<div class="mt-5">
    <p class = "text-center fs-4 ">Anda Belum Membuat Pesanan</p>
</div>
@endif

@endsection