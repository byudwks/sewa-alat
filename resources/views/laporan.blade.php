<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
</head>
<body>
    <style>
        *{
            margin: 0;
            paddign:0;
        }
        .laporan {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}
            .kop-surat{
                display: flex;
                width: 100%;
                border-bottom: 2px solid #000;
                text-transform: uppercase;
            }
            .img-lap {
                margin-left : 2rem;
            }
            .text-kop {
                text-align: center;
                margin-left : 3rem;
                margin-bottom : 10px;
            }
            .text-kop p {
                font-size: 25px;
				line-height: 35px;
            }
            .text-kop h5 {
                font-style: italic;
                text-transform: lowercase;
            }

            .sub-lap {
                display :flex;
                margin-top : 3rem;
                justify-content: space-between;
            }

            .tabel-sup table{
                text-align: start;
                margin-left: 2rem;
            }

            .text-sub{
                margin-right: 3rem;
            }

            .lap-isi {
                margin-top: 5rem;
            }

            .lap-isi h6 {
                margin-bottom : 10px;
                font-size: 18px;
            }

            .card-lap{
                margin-top: 2rem;
            }

            .card-lap h5{
                font-size: 18px;
                text-align: center;
                margin-bottom : 2rem;
            }

            .card-lap .table-isi {
                border-collapse: collapse;
                margin-bottom: 2rem;
            }

            .card-lap .table-isi th{
                font-size: 12px;
                text-align: start;
                border: 1px solid #ddd;
                padding-left: 5px;

            }
            .card-lap .table-isi td{
                font-size: 12px;
                text-align: start;
                border: 1px solid #ddd;
                padding-left: 5px;

            }

            .tutup-lap {
                font-size : 20px;
                margin-top : 5rem;
                text-align: center;

            }

            .tutup-2 {
                margin-top : 4rem;
            }

            @media print{
				.button-laporan{
					display: none;

                }
                .img-lap {
                    margin-left : 0rem;
                }
                .text-kop {
                    margin-left : 2rem;
                }
                }

            

            

    </style>
                

    <div class="laporan">

        <div class="kop-surat">
            <div class="img-lap">
                <img src="/img/bumk.png" alt="" style="height: 6rem; width: 6rem;">
            </div>
            <div class="text-kop">
                <p>Badan usaha milik desa <br> karya manidiri <br> Kampung Sidomulyo Kec.Punggur</p>
                <h5>email : bumk.sidomulyo@gmail.com</h5>
            </div>
        </div>

        <div class="sub-lap">
            <div class="tabel-sub">
                <table class="table">
                    <tbody> 
                        <tr>
                            <th>Perihal</th>
                            <td>: Laporan penyewaan alat</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-sub">
                <h4>Punggur, </h4>
                <h4>Kepada Yth,</h4>
                <h4>Kepala desa Sidomulyo</h4>
                <h4>Di Tempat</h4>
            </div>
        </div>

        <div class="lap-isi">
            <h6>Dengan Hormat,</h6>
            <p>Sehubungan dengan datang nya surat ini, kami sebagai pengasuh badan usaha milik kampung (BUMK) karya mandiri ingin melaporakan hasil penyewaan alat sebagai berikut :</p>
        </div>
        
        <div class="card-lap">
            <h5>Penyewaan Alat</h5>
                @if($pesanans->count())
                <table class="table-isi">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah Barang</th>
                        <th>Nama Barang</th>
                        <th>Status Pesanan</th>
                        <th>Jumlah Harga</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Pengembalian </th>
                    </thead>
                    @foreach ($pesanans as $pesan)
                    <tbody>
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pesan->token }}</td>
                        <td>{{ $pesan->user->nama }}</td>
                        <td>{{ $pesan->jumlah_barang }}</td>
                        <td>{{ $pesan->post->name }}</td> 
                        <td>{{ $pesan->status_pesan}}</td>
                        <td>Rp {{number_format($pesan->jumlah_harga,0,',','.')}}</td>
                        <td>{{ \Carbon\Carbon::parse($pesan->tanggal_pinjam)->formatLocalized('%d %b %Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pesan->tanggal_kembali)->formatLocalized('%d %b %Y') }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @else
                <div class="text-not">
                    <div>
                        <h1> Data Not Found </h1>
                    </div>
                </div>
                @endif
            <p>Demikian surat permintaan ini, di sampaikan atas kerjasamanya kami ucapkan terima kasih.</p>
        </div>

        <div class="tutup-lap">
            <div class="tutup-1">
                <h6>Mengetahui </h6>
                <h6>Pengutus Badan Usaha Milik Kampung</h6>
                <h6>Karya Mandiri</h6>
            </div>

            <div class="tutup-2">
                <h6 class="sub-tutup-2">CANDRA GUPTHA, S.Pd.MM </h6>
                <h6>NIP. 196510261991031002</h6>
            </div>
        </div>

        


        <div class="button-laporan" style="margin-top: 10rem; display: flex; justify-content: center;" >
            <button action="/buat_laporan" class="btn-cetak btn btn-sm btn-danger mb-5"  onclick="window.print()" >Cetak Laporan</button>
        </div>
    </div>
</body>
</html>