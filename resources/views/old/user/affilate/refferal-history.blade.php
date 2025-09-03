@extends('layouts.front')

@section('content')
@include('partials.global.common-header')

 <!-- breadcrumb -->
 {{-- <div class="full-row bg-light overlay-dark py-5" style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-12">
                <h3 class="mb-2 text-white">{{ __('Referral  History ') }}

                </h3>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('user-dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Referral  History  ') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- breadcrumb -->



<!--==================== Blog Section Start ====================-->
<div class="full-row mt-5">
    <div class="container-fluid">
        <div class="mb-4 d-xl-none">
            <button class="dashboard-sidebar-btn btn bg-primary rounded">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-xl-3">
                @include('partials.user.dashboard-sidebar')
            </div>
            <div class="col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget border-0 p-40 widget_categories bg-light account-info">

                            <h4 class="widget-title down-line mb-30">{{ __('Affiliate History') }}
                                <a class="mybtn1" href="{{route('user-affilate-program')}}">
                                    <i class="fas fa-arrow-left"></i>
                                    {{ __('Back') }}
                                </a>
                            </h4>

                            <div class="mr-table allproduct mt-4">
                                <div class="table-responsive">
                                        <table id="example" class="table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                <th>{{ __('Id') }}</th>
                                                    <th>{{ __('Customer Name') }}</th>
                                                   
                                                    <th>{{ __('Affiliate Bonus') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($final_affilate_users as $fuser)


                                                <tr>
                                                    <td>
                                                        <div>
                                                            {{ $fuser->id }}
                                                        </div>
                                                    </td>
                                                    <td data-label="{{ __('Customer Name') }}">
                                                        <div>
                                                            {{ $fuser->customer_name }}
                                                        </div>
                                                    </td>
                                                    <!-- <td data-label="{{ __('Product') }}">
                                                        <div>
                                                           
                                                        </div>
                                                    </td> -->
                                                    <td data-label="{{ __('Affiliate Bonus') }}">
                                                        <div>
                                                        {{ App\Models\Product::vendorConvertPrice ( $fuser->affilate_charge) }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--==================== Blog Section End ====================-->

@includeIf('partials.global.common-footer')

@endsection
