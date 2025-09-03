@extends('layouts.front')
@section('content')
@include('partials.global.common-header')
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css
" rel="stylesheet">

<style>
   * {
      margin: 0;
      padding: 0;
   }

   body {
      overflow-x: hidden;
   }

   /* banner */
   .banner-img img {
      height: 100%;
      margin-bottom: -80px;
      width: 100%;
      border-bottom-left-radius: 100px;
   }

   .banner {
      position: relative;
   }

   .banner-title {
      position: absolute;
      right: 72%;
      top: 55%;
   }

   .banner-title h1 {
      font-size: 50px;
      color: #fff;
      text-transform: uppercase;
      text-shadow: 2px 2px 4px #000000;
   }

   .classic-titles-img  {
      width: 100%;
    
   }
/* 
   .classic-title-imgd{
      padding: 50px;
   } */

   .classic-title-imgd img {
      border-radius: 20px;
   }

   .classic-titles-imges {
      width: 480px;
      margin: auto;
   }
</style>

<section class="header">
   <div class="banner">
      <div class="banner-img">
         <img src="{{ asset('assets/brand/image1.png') }}" alt="" />
      </div>
      <div class="banner-title">
         <h1>How to Use</h1>
      </div>
   </div>
</section>


<div class="promises-data" style="margin-top: 100px;">
   @foreach ($celiginCombo as $data)
   @php
   // Fetch category and products only once to avoid redundant queries
   $category = App\Models\Category::find($data->category_id);
   $product_ids = explode(',', $data->product_id);
   $products = App\Models\Product::whereIn('id', $product_ids)->get();
   @endphp

   <section class="how-to-use">
      <div class="container-fluid use-imGW">
         <h2 class="mb-4 container">{{ ucfirst($category->name) }}</h2>
         @if($products->count() == 1)
         <!-- Single Product Design -->
         <div class="classic-titles-imgt d-flex justify-content-center" style="background-image:url('{{ asset('assets/images/categories/' . $category->image) }}')">
            @foreach ($products as $product)
            <div class="classic-title-imgd  pt-5 px-2" ">

            <div class="pr-text">
                  <ins>₹{{$product->price ?? ''}}</ins>
                  @if($product->previous_price != 0)
                  <del>₹{{$product->previous_price ?: '0.0'}}</del>
                  @endif
               </div>
               <a href="">
               <img src="{{ asset('assets/images/products/' . $product->photo) }}" width="200" alt="" /></a>
               <div class="heading-classic">{{ \Illuminate\Support\Str::words($product->name, 5, '...') }}</div>
               <i class="fa fa-angle-right"></i>
            </div>
            @endforeach
         </div>
         @elseif($products->count() == 2)
         <!-- Two Products Design -->
         <div class="classic-t" style="background-image:url('{{ asset('assets/images/categories/' . $category->image) }}')">
            <div class="classic-titles-imges d-flex gap-3 mt-5">
               @foreach ($products as $product)
               <div class="classic-title-imgd pt-5 px-2">
                  <div class="pr-text">
                     <ins>₹{{$product->price ?? ''}}</ins>
                     @if($product->previous_price != 0)
                     <del>₹{{$product->previous_price ?: '0.0'}}</del>
                     @endif
                  </div>
                  <a href="{{ route('front.product', $product->slug) }}">
                     <img src="{{ asset('assets/images/products/' . $product->photo) }}" alt="" width="200">
                  </a>
                  <div class="heading-classic">{{ \Illuminate\Support\Str::words($product->name, 5, '...') }}</div>
                  <i class="fa fa-angle-right"></i>
               </div>
               @endforeach
            </div>
         </div>
         @elseif($products->count() == 3)
         <div class="classic-t" style="background-image:url('{{ asset('assets/images/categories/' . $category->image) }}')">
            <div class="classic-titles-imges d-flex gap-5 mt-5">
               @foreach ($products as $product)
               <div class="classic-title-imgd ">
                  <div class="pr-text">
                        <ins>₹{{$product->price ?? ''}}</ins>
                        @if($product->previous_price != 0)
                        <del>₹{{$product->previous_price ?: '0.0'}}</del>
                        @endif
                  </div>
                  <a href="{{ route('front.product', $product->slug) }}">
                     <img src="{{ asset('assets/images/products/' . $product->photo) }}" alt="" width="200">
                  </a>
                  <div class="heading-classic">{{ \Illuminate\Support\Str::words($product->name, 5, '...') }}</div>
                  <i class="fa fa-angle-right"></i>
               </div>
               @endforeach
            </div>
         </div>
         @else
         <!-- Multiple Products Design -->
         <div class="classic-titles-img row row-cols-xl-6 row-cols-md-3 row-cols-sm-2 row-cols-1" style="background-image:url('{{ asset('assets/images/categories/' . $category->image) }}')">
            @foreach ($products as $product)
            <div class="classic-title-img pt-5 @if($products->count() < 3)  @endif">
               <div class="pr-text">
                  <ins>₹{{$product->price ?? ''}}</ins>
                  @if($product->previous_price != 0)
                  <del>₹{{$product->previous_price ?: '0.0'}}</del>
                  @endif
               </div>
               <!-- <div class="pr-text">₹7,500
                     </div> -->
               <a href="{{ route('front.product', $product->slug) }}">
                  <img src="{{ asset('assets/images/products/' . $product->photo) }}" alt="" width="200px" class="inner-img">
               </a>

               <div class="heading-classic">{{ \Illuminate\Support\Str::words($product->name, 5, '...') }}</div>
               <i class="fa fa-angle-right"></i>
            </div>
            @endforeach
         </div>
         @endif

         <!-- Combo Price and Add to Cart -->
         <div class="combo-price mb-4 mt-4 d-flex gap-3 align-items-center container">
            <div class="cart-button">
               <button class="add-product-to-cart button btn-product"
                  data-product-ids="{{ implode(',', $product_ids) }}"
                  data-url="{{ route('product.cart.add.multiple') }}">
                  {{ __('All To Cart') }}
               </button>
            </div>
            <span>Price - {{ App\Models\Product::convertPrice($products->sum('price')) }} / </span>
         </div>
      </div>
   </section>
   @endforeach
</div>

@includeIf('partials.global.common-footer')
@endsection
@section('script')

<script>
   $(document).ready(function() {
      $('.add-product-to-cart').on('click', function() {
         const productIds = $(this).data('product-ids');
         const url = $(this).data('url');
         $.post(url, {
               ids: productIds.split(','),
               _token: $('meta[name="csrf-token"]').attr('content')
            })
            .done(function(data) {
               if (data.success) {
                  Swal.fire({
                     icon: 'success',
                     title: 'Success',
                     text: 'Products added to the cart successfully.',
                     showConfirmButton: false,
                     timer: 1500 // Close after 1.5 seconds
                  }).then(() => {
                     setTimeout(function() {
                        location.reload();
                     }, 2000);

                     // Wait for the SweetAlert to close and then redirect to the cart page
                     //   location.href = "{{ route('front.cart') }}"; // Ensure this is the correct route to the cart
                  });
               } else {
                  // Show an error if the cart update was not successful
                  Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Failed to add products to the cart. Please try again.',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            })
            .fail(function(error) {
               // Handle AJAX failure
               console.error('Error:', error);
               Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'An error occurred while processing your request.',
                  showConfirmButton: false,
                  timer: 1500
               });
            });
      });
   });
</script>


@endsection