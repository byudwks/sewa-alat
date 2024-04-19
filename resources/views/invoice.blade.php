<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 25px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

			.dwonload {
				text-decoration: none;
				color: #000;
			}


			@media print{
				.dwonload{
					display: none;
				}

				/* .print{
					display: none;
				} */
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<h5>BUMK Karya Mandiri</h5>
								</td>

								<td>
									<strong>No pesanan : {{ $pesan->token }}</strong><br />
									<small>Tanggal Sewa : {{ $pesan->tanggal_pinjam}} / {{ $pesan->tanggal_pulang}} </small><br />
									<small>{{$pesan->status_pesan}} </small>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<strong>{{$pesan->user->nama}}</strong><br />
									<small>{{$pesan->alamat_acara}}</small><br />
									<small>{{$pesan->no_hp}}</small><br />
									<small>Tanggal Pengembalian : {{$pesan->tanggal_kembali}}</small><br />
									Status Pengembalian :
									@if($pesan->tanggal_kembali == null)
									<strong ></strong><br/>
									@elseif ($pesan->tanggal_pulang < $pesan->tanggal_kembali)
									<strong > Di Denda</strong><br/>
									@else
									<strong > Tepat Waktu</strong><br/>
									@endif
								</td>

								<td>
									<strong>{{$pesan->nama_acara}}</strong><br />
									<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Detail Pesanan</td>

					<td></td>
				</tr>

				<tr class="item">
					<td>{{$pesan->post->name}}</td>

					<td>Rp {{number_format($pesan->post->harga,0,',','.')}}</td>
				</tr>

				<tr class="item">
					<td>Lama Sewa</td>

					<td>{{$pesan->jumlah_hari}} Hari</td>
				</tr>

				<tr class="item">
					<td>Jumlah Barang</td>

					<td>{{$pesan->jumlah_barang}}</td>
				</tr>

				<tr class="item">
					<td>Hilang / Rusak</td>

					@if($pesan->hilang_rusak == null)
					<td><h6>-</h6></td>
					@else
					<td>{{ $pesan->hilang_rusak }}</td>
					@endif
				</tr>

				<tr class="item">
					<td>Keterangan</td>

					@if($pesan->keterangan == null)
					<td><h6>-</h6></td>
					@else
					<td class="text-capitalize">{{ $pesan->keterangan }}</td>
					@endif
				</tr>

				<tr class="item">
					<td>Denda</td>

					@if($pesan->denda == null)
					<td><h6>-</h6></td>
					@else
					<td>Rp {{number_format($pesan->denda,0,',','.')}}</td>
					@endif
				</tr>

				<tr class="item">
					<td>Belum Dibayar</td>

					<td>Rp {{number_format($pesan->belum_bayar,0,',','.')}}</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total : Rp {{number_format($pesan->jumlah_harga,0,',','.')}}</td>
				</tr>
			</table>
            <button><a href="/invoice/dwonloadPdf/{{$pesan->id}}" id="dwonload" class = "dwonload">Cetak</a></button>
            <!-- <button onclick="window.print()" class="print">Print</button> -->
		</div>
	</body>
</html>