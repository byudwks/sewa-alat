@extends('layouts.main')

@section('container')


@if($posts->count())
<div class="container-fluid">
    <div class="container">
        <div class="row mt-3" style ="height : auto">

            @include('sweetalert::alert')

            @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card shadow-lg p-2 mb-3 bg-body-tertiary rounded" style=" height:26rem;">
                    @if($post->image)
                        <div style="max-height:350px; max-width:800px; overflow:hidden;">
                            <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top p-2  " alt="post">
                        </div>
                    @else
                        <img src="{{ 'img/img-nt.jpg' }}" class="card-img-top p-2" alt="post">
                    @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $post->name }}</h2>
                    <h5>Rp {{number_format($post->harga,0,',','.')}} / Hari</h5>

                    @if($post->jmlh_barang != 0)
                    <strong class=" text-dark"> Stok Barang : {{ $post->jmlh_barang }} Biji</strong>
                    @else
                    <strong class=" text-danger"> Stok Tidak Tersedia</strong>
                    @endif
                    <div class="container-btn-all ">
                        <form action="/post/{{ $post->id }}" method="">
                            <button type = "submit" class="btn-all fw-bold">Sewa</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="mt-5">
    <p class = "text-center fs-4 ">No Post Found</p>

</div>
@endif

@endsection

@section('layouts.footer')
@endsection