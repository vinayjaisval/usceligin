@extends('frontend.include.app')

@section('content')

<!-- Breadcrumb -->
<div class="bg-gray-100 py-5">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center text-gray-600">
            <h3 class="text-xl font-semibold mb-2 sm:mb-0">
                {{ __('Error Page') }}
            </h3>

            <nav aria-label="breadcrumb">
                <ol class="flex space-x-2 text-sm">
                    <li>
                        <a href="{{ route('front.index') }}" class="flex items-center hover:text-gray-900">
                            <i class="fas fa-home mr-1"></i>
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>/</li>
                    <li>
                        <a href="#" class="hover:text-gray-900">
                            {{ __('Pages') }}
                        </a>
                    </li>
                    <li>/</li>
                    <li class="text-gray-900 font-medium">
                        {{ __('500') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Error Section -->
<div class="py-24">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2 lg:w-5/12 text-center">

                <img 
                    src="{{ $gs->error_banner_500 ? asset('assets/images/'.$gs->error_banner_500) : asset('assets/images/noimage.png') }}" 
                    alt="Error Image"
                    class="mx-auto"
                >

                <h2 class="text-2xl font-semibold my-6">
                    {{ __('500 Page not found') }}
                </h2>

                <p class="text-gray-600">
                    {{ __('The page you are looking for dosen’t exist or another error occourd go back to home or another source') }}
                </p>

                <a 
                    href="{{ route('front.index') }}" 
                    class="inline-block mt-8 px-6 py-3 bg-gray-800 text-white rounded hover:bg-gray-900 transition"
                >
                    {{ __('Return to home') }}
                </a>

            </div>
        </div>
    </div>
</div>

@endsection