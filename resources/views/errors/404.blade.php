@extends('frontend.include.app')

@section('content')

<!-- Breadcrumb Section -->
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center text-gray-600">
            
            <div>
                <h3 class="text-2xl font-semibold text-gray-700">Error Page</h3>
            </div>

            <nav class="mt-4 md:mt-0">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('front.index') }}" class="hover:text-gray-900 flex items-center">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                    </li>
                    <li>/</li>
                    <li>Pages</li>
                    <li>/</li>
                    <li class="text-gray-800 font-medium">404</li>
                </ol>
            </nav>

        </div>
    </div>
</div>

<!-- Error Section -->
<div class="py-24">
    <div class="max-w-3xl mx-auto px-4 text-center">

        <img 
            src="{{ $gs->error_banner_404 ? asset('assets/images/'.$gs->error_banner_404) : asset('assets/images/noimage.png') }}"
            alt="404 Image"
            class="mx-auto mb-8 max-w-full h-auto"
        >

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            {{ __('404 Page not found') }}
        </h2>

        <p class="text-gray-600 max-w-xl mx-auto">
            {{ __('The page you are looking for doesn’t exist or another error occurred. Go back to the home page or try another page.') }}
        </p>

        <a href="{{ route('front.index') }}"
           class="inline-block mt-10 px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-300">
            {{ __('Return to home') }}
        </a>

    </div>
</div>

@endsection