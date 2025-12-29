@extends('frontend.include.app')

@section('content')
<!-- section-start -->
<section class=" py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 dark:text-gray-100" aria-current="page">Affiliated</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="container mx-auto px-6 text-center" data-aos="fade-up">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-5">
            Our Beauty Influencers
        </h2>
    </div>

    <div class="container mx-auto px-6 grid sm:grid-cols-2 md:grid-cols-4 gap-12">

        <!-- Influencer Card -->
        <div class="group bg-white/60 backdrop-blur-md p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1"
            data-aos="zoom-in" data-aos-delay="100">
            <div class="relative w-40 h-40 mx-auto overflow-hidden rounded-full border-4 border-red-600 shadow-xl group-hover:scale-110 transition">
                <img src="{{ asset('assets/images/influncer4.png') }}" class="object-cover w-full h-full">
            </div>

            <h3 class="text-gray-900 font-bold text-lg mt-4">Akshra</h3>
            <p class="text-gray-600 text-sm">Lifestyle Influencer</p>

            <div class="flex justify-center mt-4 space-x-3">
                <i class="fab fa-instagram text-pink-600"></i>
                <i class="fab fa-facebook text-blue-600"></i>
                <i class="fab fa-youtube text-red-600"></i>
            </div>
        </div>

        <div class="group bg-white/60 backdrop-blur-md p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1"
            data-aos="zoom-in" data-aos-delay="200">
            <div class="relative w-40 h-40 mx-auto overflow-hidden rounded-full border-4 border-red-600 shadow-xl group-hover:scale-110 transition">
                <img src="{{ asset('assets/images/influncer2.png') }}" class="object-cover w-full h-full">
            </div>

            <h3 class="text-gray-900 font-bold text-lg mt-4">Nitesha</h3>
            <p class="text-gray-600 text-sm">Beauty Creator</p>

            <div class="flex justify-center mt-4 space-x-3">
                <i class="fab fa-instagram text-pink-600"></i>
                <i class="fab fa-facebook text-blue-600"></i>
                <i class="fab fa-youtube text-red-600"></i>
            </div>
        </div>

        <div class="group bg-white/60 backdrop-blur-md p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1"
            data-aos="zoom-in" data-aos-delay="300">
            <div class="relative w-40 h-40 mx-auto overflow-hidden rounded-full border-4 border-red-600 shadow-xl group-hover:scale-110 transition">
                <img src="{{ asset('assets/images/influncer1.png') }}" class="object-cover w-full h-full">
            </div>

            <h3 class="text-gray-900 font-bold text-lg mt-4">Sandeep</h3>
            <p class="text-gray-600 text-sm">Skin Expert</p>

            <div class="flex justify-center mt-4 space-x-3">
                <i class="fab fa-instagram text-pink-600"></i>
                <i class="fab fa-facebook text-blue-600"></i>
                <i class="fab fa-youtube text-red-600"></i>
            </div>
        </div>

        <div class="group bg-white/60 backdrop-blur-md p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1"
            data-aos="zoom-in" data-aos-delay="400">
            <div class="relative w-40 h-40 mx-auto overflow-hidden rounded-full border-4 border-red-600 shadow-xl group-hover:scale-110 transition">
                <img src="{{ asset('assets/images/infliuncer3.png') }}" class="object-cover w-full h-full">
            </div>

            <h3 class="text-gray-900 font-bold text-lg mt-4">Kavita</h3>
            <p class="text-gray-600 text-sm">Makeup Artist</p>

            <div class="flex justify-center mt-4 space-x-3">
                <i class="fab fa-instagram text-pink-600"></i>
                <i class="fab fa-facebook text-blue-600"></i>
                <i class="fab fa-youtube text-red-600"></i>
            </div>
        </div>
    </div>

</section>

<section class="py-6 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-5">
            Exclusive Ambassador Benefits
        </h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="p-6 rounded-xl  shadow-md  transition duration-300 hover:-translate-y-1">
                <h5 class="text-gray-800 italic">
                    Download The CELIGIN App
                </h5>
                <p class="mt-4  text-gray-500 italic text-base">Start here. Download the app to manage your business from anywhere.</p>
            </div>

            <div class="p-6 rounded-xl bg-purple-50 shadow-md  transition duration-300 hover:-translate-y-1">
                <h5 class="text-gray-800 italic">
                    Register And Verify
                </h5>
                <p class="mt-4 text-gray-600 italic">Verify Your Email And Enroll As A Brand Ambassador.</p>
            </div>

            <div class="p-6 rounded-xl  shadow-md  transition duration-300 hover:-translate-y-1">
                <h5 class="text-gray-800 italic">
                    Refer And Earn
                </h5>
                <p class="mt-4 text-gray-600 italic text-base">Refer 5* Potantial Customer And Become Celigin Club Member.</p>
            </div>
        </div>
        <div class=" grid grid-cols-1  md:grid-cols-3 gap-10 mt-16 justify-items-center">
            <div class="p-6 rounded-xl  shadow-md  transition duration-300 hover:-translate-y-1">
                <h5 class="text-gray-800 italic">
                    Agree Terms And Conditions
                </h5>
                <p class="mt-4 text-gray-600 italic text-base">Review The Privacy Policy And Brand Ambassador Agreement.</p>
            </div>
            <div class="p-6 rounded-xl bg-purple-50 shadow-md  transition duration-300 hover:-translate-y-1">
                <h5 class="text-gray-800 italic">
                    Make More Money By...
                </h5>
                <p class="mt-4 text-gray-600 italic text-base">Buy Your Beauty Box In-App And Kick-Start Your Journey.</p>
            </div>
        </div>
    </div>

</section>





@endSection