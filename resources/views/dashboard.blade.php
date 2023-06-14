{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard xsas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.navigation')
@section('title', 'Homepage')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/7adbf01c7f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .icon:hover {
    color: rgba(40, 40, 242, 0.744); /* Ganti dengan warna yang diinginkan */
  }
</style>
</head>
<body>
    <div class="card mb-5" style="border: 0; background-color: #F1F1F7;">
        <div class="row g-0">
          <div class="col-md-5">
            <img src="{{ url('/images/benang1.png') }}" class="img-fluid" alt="..." style="width: 100%; max-width: 565px; height: auto;">
          </div>
          <div class="col-md-7">
            <div class="card-body" style="display: flex; align-items: center; justify-content: center; height: 100%;">
              <h1 class="card-title" style="text-transform: uppercase; font-family: Amarante; text-align: center;">
                Benang berkualitas terbaik dengan warna-warni menawan
              </h1>
            </div>
          </div>
        </div>
    </div>

    <div class="reason">
        <div class="text" style="margin-left:10px; margin-right:10px; margin-bottom:50px;">
            <h2 style="text-align: center; margin-bottom:40px;">Kenapa Memilih Kami ?</h2>
            <h5 style="text-align: justify;">Kami adalah mitra bisnis yang terpercaya dalam industri benang di dalam negeri. Dengan pengalaman dan jaringan yang luas, kami menyediakan berbagai jenis benang berkualitas tinggi dengan harga kompetitif. Keandalan pasokan benang, kepuasan pelanggan, dan layanan yang unggul adalah prinsip utama yang kami pegang. Kami berkomitmen untuk memenuhi kebutuhan dan ekspektasi klien kami, serta menjalin hubungan bisnis yang saling menguntungkan dengan pemasok dan pelanggan di seluruh industri benang.</h5>
        </div>

        <div class="ikon" style="margin-bottom: 50px;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col d-flex flex-column align-items-center">
                  <i class="icon fas fa-thumbs-up fa-5x"></i>
                  <div class="card-body text-center">
                    <h5 class="card-title">Quality</h5>
                    <p class="card-text">Kami hanya mengirimkan produk-produk berkualitas sesuai dengan pesanan klien kami.</p>
                  </div>
                </div>

                <div class="col d-flex flex-column align-items-center">
                  <i class="icon far fa-clock fa-5x"></i>
                  <div class="card-body text-center">
                    <h5 class="card-title">Timely Shipment</h5>
                    <p class="card-text">Kami mengerti betapa pentingnya memenuhi kebutuhan pelanggan berharga kami dan kami menjamin pengiriman tepat waktu.</p>
                  </div>
                </div>

                <div class="col d-flex flex-column align-items-center">
                  <i class="icon fas fa-check fa-5x"></i>
                  <div class="card-body text-center">
                    <h5 class="card-title">Quality not Quantity</h5>
                    <p class="card-text" style="margin-left:5px; margin-right:5px;">Kami berfokus pada kualitas produk dengan harga terjangkau</p>
                  </div>
                </div>
            </div>  
        </div>
    </div>

    <div class="produk" style="margin-bottom: 50px;">
        <div class="text" style="margin-left:10px; margin-right:10px; margin-bottom:50px;">
            <h2 style="text-align: center; margin-bottom:40px;">Produk Kami</h2>
        </div>

        <div class="grid-produk" style="background-color: #F1F1F7">
            <div class="container-product">
                <div id="carouselExampleInterval1" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="4000">
                      <div class="row justify-content-center" style="margin-left:40px; margin-right:40px; margin-bottom:10px;">
                        <div class="col-6 col-md-3">
                          <img src="{{ url('images/benang2.png') }}" class="d-block w-100 " alt="Gambar 1">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-35)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-35</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang3.png') }}" class="d-block w-100 " alt="Gambar 2">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-35)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-35</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang4.png') }}" class="d-block w-100 " alt="Gambar 3">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-35)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-35</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang5.png') }}" class="d-block w-100 " alt="Gambar 4">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-35)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-35</h7>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                      <div class="row justify-content-center" style="margin-left:40px; margin-right:40px; margin-bottom:10px;">
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang6.jpg') }}" class="d-block w-100 " alt="Gambar 5">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-64)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-64</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang7.jpg') }}" class="d-block w-100 " alt="Gambar 5">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-53)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-53</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang8.jpg') }}" class="d-block w-100 " alt="Gambar 5">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-63)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-63</h7>
                        </div>
                        <div class="col-6 col-md-3">
                          <img src="{{ asset('images/benang9.jpeg') }}" class="d-block w-100 " alt="Gambar 5">
                          <h7 class="d-none d-md-block">Delight - Catton Big Ply (KB-6)</h7>
                          <h7 class="d-md-none" style="margin-bottom:10px;">Delight - KB-6</h7>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval1" data-bs-slide="prev" style="color:black; width:50px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval1" data-bs-slide="next" style="color:black; width:50px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
            
              <!-- Memuat library Bootstrap JavaScript -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleInterval1'), {
                    interval: 4000
                  });
            
                  var nextButton = document.querySelector('.carousel-control-next');
                  nextButton.addEventListener('click', function() {
                    var activeItem = document.querySelector('.carousel-item.active');
                    if (activeItem.nextElementSibling && !activeItem.nextElementSibling.classList.contains('carousel-item')) {
                      carousel.next();
                    }
                  });
                });
              </script>
          </div> 
    </div>
      
</body>
</html>
@endsection