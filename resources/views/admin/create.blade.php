@extends('admin.main')

@section('container')

<div class="col-md-8 mt-3">
  <h3>Tambah Barang </h3>
</div>

<div class="col-md-8 mt-3">
  <form action="/admin" method ="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama Barang</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga Barang</label>
      <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
      @error('harga')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="jmlh_barang" class="form-label">Jumlah Barang</label>
      <input type="text" class="form-control @error('harga') is-invalid @enderror"  name="jmlh_barang" value="{{ old('jmlh_barang') }}">
      @error('jmlh_barang')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <input type="hidden" class="form-control" id="status" name="status" value="Tersedia" disabled>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Upload Gambar</label>
      <img class="img-preview img-fluid mb-3 col-sm-5">
      <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name ="image" onchange ="previewImage()">
      @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-2 mb-3">Tambah Barang</button>
  </form>
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