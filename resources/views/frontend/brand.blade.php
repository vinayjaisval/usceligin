@extends('layouts.front')
@section('content')
@include('partials.global.common-header')

<style>
   * {
      margin: 0;
      padding: 0;
   }

   body {
      overflow-x: hidden;
      font-family: 'Open Sans';
   }

   /* banner */
   .banner-img img {
      height: 530px;
      margin-bottom: -80px;
      width: 100%;
      /* border-bottom-left-radius: 100px; */
   }

   .banner {
      position: relative;
   }

   .banner-title {
      position: absolute;
      right: 60%;
      top: 80%;
   }

   .banner-title h1 {
      font-size: 50px;
      background: #BB8A8A;
      color: #fff;
      text-transform: uppercase;
   }

   .container {
      width: 100%;
      margin: 0 auto;
   }

   .how-to-use {
      margin-top: 150px;
   }

   .banner-img img {

      margin-bottom: 0px;

   }

   .banner-img {
      position: relative;
   }

   .banner-science-title {
      position: absolute;
      top: 50%;
      left: 50%;
      color: #fff;
      font-size: 40px;
      transform: translate(-50%, -50%);
   }

   .banner-science-title h1 {
      color: #fff;
      text-align: center;
      font-size: 80px;
      font-weight: 500 !important;
   }
   .banner-science-title p{
      font-size: 50px;
   }

   .brand-brand-title .number-01 {
      background: #3f4040;
      width: 50px;
      margin: auto;
      border-radius: 100%;
      height: 50px;
      color: #fff;
      line-height: 1.9;
   }

   .brand-brand-title h4 {
      font-weight: 600;
      margin-top: 15px;
      color: #6d6262;
      font-size: 22px;
   }

   .number-01 {
      background: #3f4040;
      width: 50px;
      margin: auto;
      border-radius: 100%;
      height: 50px;
      color: #fff;
      line-height: 1.9;
      margin-bottom: 20px;
   }

   .gredient-image img {
      width: 300px;
   }

   .gredient-image {
      margin-top: 120px;
   }

   .line-graph-gradient h4 {
      color: #6d6262;
      font-weight: 600;
      font-size: 25px;
   }
   .sony-texts-celigin p{
      font-size: 35px;
   }
   .sony-texts-celigin  h4{
      font-size: 40px;
   }

   .brand-brand-title p {
      font-size: 15px;
      color: #6d6262;
      font-weight: 400;
   }

   .line-graph-gradient {
      background: #F6F3EE;
      padding-top: 60px;
      overflow-x: hidden;
   }

   .onlt-text {
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
      padding-top: 100px;
      border-radius: 15px;
      height: 250px;
      margin: auto;
      /* width: 330px; */
   }

   .circle-title {
      width: 100px;
      height: 100px;
      background: #8f8f8f;
      border-radius: 100%;
      left: 36%;
      top: -60px;
   }

   .circle-titles {
      width: 100px;
      height: 100px;
      background: #8f8f8f;
      border-radius: 100%;
      left: 32%;
      top: -60px;
   }

   .circle-titles {
      width: 150px;
      height: 150px;
   }

   .rose-heading {
      margin-top: 120px;
   }

   .heading-origin h3 {
      font-size: 60px;
      color: #6d6262;
      font-weight: 700;
   }

   .onlt-text h4 {
      font-size: 22px;
      color: #6d6262;
      font-weight: 700;
   }

   .onlt-text p {
      color: #6d6262;
      font-weight: 400;
      font-size: 14px;
   }

   .coscor-title span {
      color: #6d6262;
      font-weight: 400;
      font-size: 20px;
   }

   .coscor-title h3 {
      color: #6d6262;
      font-size: 60px;
   }

   .coscor-title p {
      color: #6d6262;
      font-size: 16px;
      font-weight: 400;
   }

   .heading-origin p {
      color: #6d6262;
      font-size: 25px;
      font-weight: 600;
   }

   .orogin-formula-title {
      padding-top: 60px;
   }

   .sky-link {
      background: #eff0f1;
      border-radius: 30px 30px 0px 0px;
      text-align: center;
   }

   .sky-link img {
      width: 250px;
      height: 200px;
      background: #eff0f1;
      border-radius: 30px 30px 0px 0px;
      object-fit: cover;
   }

   .sony-ink,
   .brand-brand-title,
   .sony-text {
      margin-top: 60px;
   }

   .sony-texts {
      padding-top: 60px;
      padding-bottom: 30px;
   }

   .sky-link p {
      margin-top: 10px;
   }

   .sony-texts {
      background-color: #fde9e9;
   }

   .sony-texts-celigin {
      padding: 60px 0px;
   }

   .sky-links {
      box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
      border-radius: 30px;
   }

   .border-right-tx {
      background: #d9d9d9 !important;
      height: 5px;
      transform: rotate(90deg);
      width: 110px;
      margin: auto;
      margin-top: 90px;
   }

   .img-right img {
      width: 250px;
      height: auto;
   }

   .text-collapse {
      margin-top: 75px;
   }

   .text-collapse h4 {
      font-size: 40px;
   }

   .cell-progress {
      margin-top: -80px;
      margin-bottom: 30px;
   }

   .cell-cell {
      position: absolute;
      top: 36%;
      left: 50%;
      font-size: 40px;
   }

   .cell-cells {
      position: absolute;
      top: 36%;
      left: 15%;
      font-size: 40px;
   }

   .img-right {
      position: relative;
   }

   .circle-title {
      left: 50%;
      transform: translate(-50%, -8%);
      width: 150px;
      height: 150px;
   }

   @media(max-width:1341px) and (min-width:1300px) {
   .banner-science-title p {
    font-size: 37px;
}
   }

   @media(max-width:1299px) and (min-width:991px) {
   .banner-science-title p {
    font-size: 37px;
}
   }

   @media(max-width:991px) and (min-width:768px) {
      .banner-science-title p {
         font-size: 20px;
      }

      .cd-mp {
         margin-top: 100px;
      }

      .cd-mps {
         margin-top: 50px;
      }

   }

   @media(max-width:767px) and (min-width:426px) {
      .banner-science-title p {
         font-size: 20px;
      }

      .cd-mp {
         margin-top: 100px;
      }

      .cd-mps {
         margin-top: 50px;
      }

      .cell-progress {
         margin-top: 10px;
         margin-bottom: 30px;
      }



   }





   @media(max-width:425px) {
      .banner-science-title p {
         font-size: 20px;
         text-align: center;
      }

      .cell-progress {
         margin-top: 80px;
         margin-bottom: 30px;
      }

      .origin-text {
         flex-direction: column;
      }

      .cd-mp {
         margin-top: 100px;
      }

      .cd-mps {
         margin-top: 50px;
      }

      .cell-cell {
         left: 40%;

      }
      .banner-img img {
         height: 300px;

   }
}

   @media(max-width:375px) {

      .cell-cell,
      .cell-cells {
         left: 26%;
      }
   }

   @media(max-width:320px) {

      .cell-cell,
      .cell-cells {
         top: 27%;
         font-size: 25px;
      }
   }
   .shadow-inside:hover {
    transform: translateY(-5px) scale(1.02);
    background: linear-gradient(135deg, #A69EAF 0%, #c68888f7 100%);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}
.shadow-inside {
    transition: all 0.4s ease-in-out;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}
</style>
<!-- <body> -->
<section class="header">
   <!-- banner -->
   <div class="banner">
      <div class="banner-img">
         <img src="{{asset('assets/brand/beautiful-scenery-rocky-seashore-sea-sunset 1.png')}}" alt="" />
         <div class="banner-science-title">
            <p>BIO SCIENCE AND COSMETIC</p>
            <h1>CELIGIN</h1>


         </div>
      </div>
   </div>

   <div class="brand-brand-title  text-center container">
      <h3 class="number-01">01</h3>
      <h4>BRAND</h4>
      <p>CELIGIN, a total anti-agnig brand <br>
         that finds skin’s natural radiance</p>
   </div>
   <div class="circle-add-title">
      <div class="border-right-tx"></div>
      <div class="d-flex justify-content-between">
         <div class="img-right">
            <img src="{{asset('assets/brand/Ellipse 2.png')}}" alt="" />
            <div class="cell-cell">Cell</div>
         </div>
         <div class="text-collapse text-center">
            <h4>Celigin</h4>
            <p>Look Forward To tomorrow</p>
            <div class="border-right-tx"></div>
         </div>
         <div class="img-right">
            <img src="{{asset('assets/brand/Ellipse 3.png')}}" alt="" />
            <div class="cell-cells">Origin</div>
         </div>
      </div>
      <div class="cell-progress text-center">
         <p class="mt-celigin">Cell + Origin</p>
         <span>A natural glow and radiance to your skin <br> Premium facial Care Brands focus on Anti - Aging Effect</span>
      </div>

   </div>

   <div class="line-graph-gradient">
      <h3 class="number-01 text-center">02</h3>
      <h4 class="text-center">Key Gredient</h4>
      <div class="row">
         <div class="d-flex justify-content-around ">
            <div class="gredient-image">
               <img src="{{asset('assets/brand/cel 1.png')}}" alt="" />
            </div>
            <div class="gredient-images">
               <img src="{{asset('assets/brand/cel 2.png')}}" alt="" />
            </div>
            <div class="gredient-image">
               <img src="{{asset('assets/brand/cel 3.png')}}" alt="" />
            </div>
         </div>
         <div class="coscor-title text-center">
            <span>CELIGIN’S INDEPENDENDT INGEREDIENT</span>
            <h3>Coscor</h3>
            <p>Bio Cosmetic Material Based on Serum-Free Medium <br>
               Independent Bio Cosmetic Ingredient</p>
         </div>
      </div>
   </div>


   <div class="orogin-formula-title container">
      <div class="origin-text d-flex gap-5 align-items-center">
         <div class="heading-origin">
            <h3>White</h3>
            <p>Origin Fomula</p>
         </div>
         <div class="celigin-consor">
            <p>The Korean Word for tha white color also mean ‘fair’ denoting the clear and bright rays of the sun. All products include 5 different estracts of flowers in white color for ever-clear and fair skin.</p>
         </div>

      </div>

   </div>

   <div class="rose-heading container">
      <div class="row">
         <div class="col-lg-2"></div>
         <div class="col-lg-4">
            <div class="position-relative shadow-inside">
               <div class="circle-title position-absolute">
                  <img src="{{asset('assets/brand/Group 5 (1).png')}}" alt="" />
               </div>
               <div class="onlt-text text-center  pb-4">
                  <h4>White rose extract</h4>
                  <p>Activates antioxidant effect. <br>Skin whitening and wrinkle <br> improvements</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="position-relative cd-mp shadow-inside">
               <div class="circle-titles position-absolute">
                  <img src="{{asset('assets/brand/Group 6.png')}}" alt="" />
               </div>
               <div class="onlt-text text-center pb-4">
                  <h4>Commeon Jasmine Extract</h4>
                  <p> Moisturizes skin <br>
                     improves skin elasticity and <br>
                     soothes sensitive skin.</p>
               </div>
            </div>
         </div>
         <div class="col-lg-2"></div>
      </div>
   </div>

   <div class="rose-heading  container">
      <div class="row">
         <div class="col-lg-4">
            <div class="position-relative shadow-inside">
               <div class="circle-title position-absolute">
                  <img src="{{asset('assets/brand/Group 7.png')}}" alt="" />
               </div>
               <div class="onlt-text text-center pb-4">
                  <h4>Elder flower Extract</h4>
                  <p>Boosts antioxidant immune <br> and
                     soothes skin troubles</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="position-relative cd-mp shadow-inside">
               <div class="circle-title position-absolute">
                  <img src="{{asset('assets/brand/Group 8.png')}}" alt="" />
               </div>
               <div class="onlt-text text-center pb-4">
                  <h4>Edelweiss Extract</h4>
                  <p>Soothes and Protects skin</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="position-relative cd-mp shadow-inside">
               <div class="circle-titles position-absolute">
                  <img src="{{asset('assets/brand/Group 9.png')}}" alt="" />
               </div>
               <div class="onlt-text text-center pb-4">
                  <h4>Matricaria flower extract</h4>
                  <p>Soothes and moisturizes skin <br>
                     it aids in pore control and <br>
                     improves skin elasticity</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="brand-brand-title mt-5 text-center container">
      <h3 class="number-01">03</h3>
      <h4>CLEAN BEAUTY</h4>
      <p>Starting With Right Consumption <br>
         The Beauty of Coexistence.</p>
   </div>

   <div class="sony-ink">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 cs bg-white">
               <div class="sky-links">
                  <div class="sky-link">
                     <img src="{{asset('assets/brand/fsc.png')}}" alt="" />

                  </div>
                  <p class="mt-3 mx-3 py-3 text-center">CELIGIN is against
                     on animal test.</p>
               </div>
            </div>
            <div class="col-lg-4 cs bg-white">
               <div class="sky-links cd-mps">
                  <div class="sky-link">
                     <img src="{{asset('assets/brand/fsc2.png')}}" alt="" />

                  </div>
                  <p class="mt-3 mx-3 py-3 text-center">Printed package
                     with Soy Ink.</p>
               </div>
            </div>
            <div class="col-lg-4 cs bg-white">
               <div class="sky-links cd-mps">
                  <div class="sky-link">
                     <img src="{{asset('assets/brand/fsc3.png')}}" alt="" />

                  </div>
                  <p class="mt-3 mx-3 py-3 text-center">Used FSC-certified
                     paper on the
                     package.</p>
               </div>
            </div>
         </div>
         <div class="sony-text text-center">
            <p>To practice a sustainable enviornment <br>
               From the production of product to the meeting with the consumer <br>
               We have created this all products with entire process in mind..</p>
            <p class="mt-5">We wil continue to start with small practices for nature and enviornment. <br>
               We hope that these small practices will be shared <br>
               with our customers and together we will create a better future..</p>

            <p class="mt-5">CELLIGN's challange to create good cosmetics to coexits with the earth continues..</p>

         </div>

      </div>
   </div>
   <div class="sony-texts text-center">
      <h4>Next generation bio-science cosmetic barnd <br> Offering specialized skin solutions</h4>
      <p class="mt-5">We have sparingly included only carefully selected <br> and necessary raw materials..</p>

      <p class="mt-5">As a total anti-aging brand that takes helps people find their skin's natural radiance <br>
         We will continue to make unceasing efforts on a daily basis.</p>

   </div>

   <div class="sony-texts-celigin text-center">
      <p>BIO SCIENCE AND COSMETIC</p>
      <h4>Celigin</h4>

   </div>




</section>

@includeIf('partials.global.common-footer')
@endsection