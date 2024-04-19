@extends('admin.main')

@section('container')

<div class="col-md-8 mt-3">
  <h3>Edit Barang </h3>
</div>

<div class="col-md-8 mt-3">
  <form action="/admin/{{ $post->id }}" method ="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $post->name) }}" disabled>
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga Barang</label>
      <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value=" {{ old('harga', $post->harga) }}">
      @error('harga')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="jmlh_barang" class="form-label">Jumlah Barang</label>
      <input type="text" class="form-control @error('harga') is-invalid @enderror"  name="jmlh_barang" value="{{ old('jmlh_barang', $post->jmlh_barang) }}">
      @error('jmlh_barang')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <!-- <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $post->status) }}" disabled>
    </div> -->
    <div class="mb-3">
      <label for="image" class="form-label">Upload Gambar</label>
      <input type="hidden" name="oldImage" value="{{ $post->image }}">
        @if($post->image)
          <img src="{{ asset('storage/' . $post->image) }} " class="img-preview img-fluid mb-3 col-sm-5 d-block">
        @else
          <img class="img-preview img-fluid mb-3 col-sm-5">
        @endif
      <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name ="image" onchange ="previewImage()">
      @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update Data</button>
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