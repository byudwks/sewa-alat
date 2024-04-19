@extends('layouts.main')
@section('container')

@include('sweetalert::alert')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="mt-1">
                <a href="/cekout" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>

            <div class="card mt-2 shadow-lg" style=" height:35rem;">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 mb-3 text-center">
                            <form action="/cekout/update/{{ $pesan->id }}" method ="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf 
                                    <input type="hidden" class="form-control" id="nama_acara" name="nama_acara" value="{{ $pesan->nama_acara }}" >
                                    <input type="hidden" class="form-control" id="alamat_acara" name="alamat_acara" value="{{ $pesan->alamat_acara }}" >
                                    <input type="hidden" class="form-control" id="no_hp" name="no_hp" value="{{ $pesan->no_hp }}" >
                                    <input type="hidden" class="form-control" id="jumlah_hari" name="jumlah_hari" value="{{ $pesan->jumlah_hari }}" >
                                    <input type="hidden" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ $pesan->tanggal_pinjam }}" >
                                    <input type="hidden" class="form-control" id="tanggal_pulang" name="tanggal_pulang" value="{{ $pesan->tanggal_pulang}}" >
                                    <input type="hidden" class="form-control" id="jumlah_harga" name="jumlah_harga" value="{{ $pesan->jumlah_harga }}" >
                                
                                    <div class="mb-1 text-center">
                                        <label for="image" class="form-label">Upload Struk</label>
                                        <input type="hidden" name="oldImage" value="{{ $pesan->image }}">
                                            @if($pesan->image)
                                            <img src="{{ asset('storage/' . $pesan->image) }} " class="img-preview img-fluid mb-3 col-sm-5 d-block" style="height: 25rem; width: 20rem;">
                                            @else
                                            <img src="{{ 'img/img-nt.jpg' }}" class="img-preview img-fluid mb-3 col-sm-5" style="height: 25rem; width: 20rem;">
                                            @endif
                                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name ="image" onchange ="previewImage()" required>
                                    </div>
                                    <button type="submit" class="btn-sm btn-primary border-0 mt-1">Upload Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// preview image
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;

        }   
    }
</script>


@endsection