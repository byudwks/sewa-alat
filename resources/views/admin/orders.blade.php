    @extends('admin.main')

    @section('container')

    @include('sweetalert::alert')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1> Welcome {{ auth()->user()->nama }}</h1>
        </div>
        
        <div class = "row">

            <div class="col">
            
                <div class="col-md-11 d-flex">
                    <div class="search">
                    <form action="/buat_laporan" class="d-flex align-items-center" style = "width: 30rem;" >
                            <input class="form-control me-2 my-3" type="date" name="searchOrder" value="{{ request('searchOrder') }}" placeholder="Search..">
                            <h6>s/d</h6>
                            <input class="form-control me-2 ms-2 my-3" type="date" name="searchOrder2" value="{{ request('searchOrder2') }}" placeholder="Search..">
                            <button class="btn btn-sm btn-danger my-3 me-4" style = "width: 10rem;" type="submit">Laporan</button>
                    </form>
                    </div>
                </div>
          

                <div class="table-responsive mt-2 col-lg-11">
                    @if($pesanans->count())
                    <table class="table table-ms ">
                    <thead class= 'table-dark'>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Status Pesanan</th>
                        <th scope="col">Jumlah Harga</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $pesan)
                        <tr class="{{ $pesan->tanggal_kembali == null ? '' : ($pesan->tanggal_pulang < $pesan->tanggal_kembali ? 'text-bg-danger' : 'text-bg-success')}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pesan->token }}</td>
                        <td>{{ $pesan->user->nama }}</td>
                        <td>{{ $pesan->no_hp }}</td>
                        <td>{{ $pesan->post->name }}</td> 
                        <td>{{ $pesan->status_pesan}}</td>
                        <td>Rp {{number_format($pesan->jumlah_harga,0,',','.')}}</td>
                        <td>{{ $pesan->tanggal_kembali }}</td>
                        <td>
                        <a href="/orders/{{ $pesan->id }}" class = "btn btn-info btn-sm text-white"><i class="bi bi-clipboard-check"></i></a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    @else
                    <div class="row text-center">
                        <div class="col-md-12 fs-6">
                            <h1> Data Not Found </h1>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    @endsection