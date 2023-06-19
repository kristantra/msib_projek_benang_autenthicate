@extends('layouts.navigation')
<style>
  .content-text {
        text-align: center; 
        margin-bottom: 40px; 
        font-family: 'Amarante', cursive; 
        margin-left: 30px; 
        margin-right: 30px;
        font-size: 1.1em; /* Meningkatkan ukuran font */
    }

    .small-text {
        margin-left: 30px;
    }

    .content-container {
        margin-top: 50px;
    }
</style>
@section('content')
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="4000">
      <div class="text-center">
        <img src="{{url('images/benang10.jpg') }}" class="d-block mx-auto img-fluid" alt="..." style="max-width: 565px; height: auto;">
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="{{url('images/benang11.jpeg') }}" class="d-block mx-auto img-fluid" alt="..." style="max-width: 565px; height: auto;">
    </div>
    <div class="carousel-item">
      <img src="{{url('images/benang12.jpg') }}" class="d-block mx-auto img-fluid" alt="..." style="max-width: 565px; height: auto;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="content-container">
  <div class="content-text">
    <h5>Delight - Membawa Kreativitas Anda Menjadi Nyata!</h5>
    <p>
      Selamat datang di Delight, destinasi terbaik untuk kebutuhan benang Anda. Dengan koleksi benang berkualitas tinggi, kami memastikan setiap proyek kreatif Anda menjadi sukses. Temukan beragam pilihan benang yang indah dan tahan lama, dan biarkan imajinasi Anda berputar dengan bebas. Bergabunglah dengan kami dan jadilah bagian dari komunitas kreatif yang tak terbatas.
    </p>
    <p class="lead"><small>Delight - Wujudkan karya luar biasa Anda!</small></p>
  </div>
</div>

@endsection
