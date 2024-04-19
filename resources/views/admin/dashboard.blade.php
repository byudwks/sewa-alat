@extends('admin.main')

@section('container')

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1> Welcome {{ auth()->user()->nama }}</h1>
      </div>
      <div class = "row">

        @include('sweetalert::alert')

        <div class="col">
          <a href="/admin/create" class = 'btn btn-primary'>Tambah Barang</a>
          <div class="table-responsive mt-2 col-lg-10">
            <table class="table table-striped table-sm">
              <thead class= 'table-dark'>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama </th>
                  <th scope="col">Harga</th>
                  <th scope="col">Jumlah Barang</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $post->name }}</td>
                  <td>Rp {{number_format($post->harga,0,',','.')}}</td>
                  <td>{{ $post->jmlh_barang }}</td>
                  <td>{{ $post->status }}</td>
                  <td>
                    <a href="/admin/{{ $post->id }}/edit" class = "btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                    <form action="/admin/{{ $post->id }}" method="post" class = "d-inline">
                      @method('delete')
                      @csrf
                      <button class = "btn btn-danger btn-sm" onclick = "return confirm('Yakin Menghapus Data ?')"><i class="bi bi-trash-fill"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

@endsection