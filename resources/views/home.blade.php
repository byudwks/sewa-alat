@extends('layouts.main')

@section('container')


<!-- image hero -->
<section class="img-hero">
    <div class="overlay container-fluid">
        <div class="hero container">
         <div class="row">
             <div class="text-hero col-md-12">
                <h1>Badan Usaha Milik Kampung</h1>
                <h2>Karya Mandiri</h2>
                <h3>Kampung Sidomulyo Kec. Punggur</h3>
             </div>
         </div>
        </div>
    </div>
</section>
<!-- end image haro -->

<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-port col-md-4">
                <img src="img/bumk.png" alt="" class="img-port">
            </div>

            <div class="text-port col-md-8">
                <h1>Bumk Karya Mandiri</h1>
                <p>badan yang dibentuk atas inisiasi masyarakat dan/atau pemerintah desa untuk mendayagunakan segala potensi ekonomi, kelembagaan perekonomian, serta potensi sumber daya alam dan sumber daya manusia dalam rangka meningkatkan kesejahteraan masyarakat desa. </p>
                <p>
                BUM Desa secara spesifik tidak dapat disamakan dengan badan hukum seperti perseroan terbatas, CV, atau koperasi.
                Oleh karena itu, BUM Desa merupakan suatu badan usaha bercirikan desa yang dalam pelaksanaan kegiatannya di samping untuk membantu penyelenggaraan pemerintahan desa, juga untuk memenuhi kebutuhan masyarakat desa.
                </p>
                <p>
                Kemudian, dalam kegiatannya, BUM Desa tidak hanya berorientasi pada keuntungan keuangan, tetapi juga berorientasi untuk mendukung peningkatan kesejahteraan masyarakat desa serta diharapkan dapat mengembangkan unit usaha dalam mendayagunakan potensi ekonomi desa.</p>
            </div>
        </div>
    </div>
</section>


<section class="layanan">
    <div class="container ">
        <div class="row ">
            <div class="layanan-1 col-md-12 d-flex justify-content-center">
                <h1>Layanan Kami</h1>
                <img src="img/layanan.jpg" alt="" class="img-layanan img-fluid ">
            </div>
        </div>
    </div>
</section>


@endsection

