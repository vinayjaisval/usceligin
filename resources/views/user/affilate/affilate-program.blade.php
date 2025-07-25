@extends('layouts.front')

@section('content')
@include('partials.global.common-header')

<!-- breadcrumb -->
{{-- <div class="full-row bg-light overlay-dark py-5" style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
<div class="container">
    <div class="row text-center text-white">
        <div class="col-12">
            <h3 class="mb-2 text-white">{{ __('Reward') }}
            </h3>
        </div>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('user-dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Reward ') }}</li>
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
                        <div class="widget border-0 p-40 widget_categories  account-info">

                            <h3 class="widget-title down-line ">{{ __('Affiliate Dashboard') }}
                                <a class="mybtn1" href="{{route('user-affilate-history')}}">
                                    <i class="fas fa-history"></i> {{ __('Affiliate History') }}</a>
                            </h3>
                            <hr>
                            <div class="dashboard">
                                Affiliate Dashboard
                            </div>
                            <div class="dashboard-body">
                                <p>Welcome to your affiliate dashboard. Here you can track your performance and manage your affiliate account.</p>
                            </div>
                            <div class="stats-card-list">
                                <div class="stats-card stats-commission">
                                    <div class="stats-card-title">Balance</div>
                                    <div class="stats-card-value">{{ App\Models\Product::vendorConvertPrice(Auth::user()->current_balance) }}</div>
                                    <div class="stats-card-subtitle">Available for withdrawal</div>
                                </div>
                                <div class="stats-card stats-withdrawal">
                                    <div class="stats-card-title">Total Commission</div>
                                    <div class="stats-card-value">
                                        {{ App\Models\Product::vendorConvertPrice($user->affilate_income + $user->referral_income) }}

                                    </div>
                                    <div class="stats-card-subtitle">Total earned</div>
                                </div>
                                <div class="stats-card stats-clicks">
                                    <div class="stats-card-title">Total Withdrawn</div>
                                    <div class="stats-card-value">
                                      
                                    ₹ {{ App\Models\Withdraw::where('user_id', Auth::user()->id)->where('type', 'user')->sum('amount') }}

                                    </div>

                                    <div class="stats-card-subtitle">Successfully paid out</div>
                                </div>
                                <div class="stats-card stats-conversion">
                                    <div class="stats-card-title">Commission - {{ \Carbon\Carbon::now()->format('F Y') }}</div>
                                    <div class="stats-card-value">
                                        {{ App\Models\Product::vendorConvertPrice(($user->affilate_income + $user->referral_income)) }}
                                    </div>
                                    <div class="stats-card-subtitle">Earned this month</div>
                                </div>
                            </div>

                            <div class="withdrawal-action-card mt-4 mb-4">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="withdrawal-info">
                                            <h6 class="mb-1">Ready to withdraw your earnings?</h6>
                                            <p class=" colors-d small mb-0"> Request a withdrawal to get your earned commissions paid out to your preferred payment method. </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <a href="{{route('user-wwt-index')}}" class="btn btn-success"><svg class="icon me-1 svg-icon-ti-ti-wallet" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                                                <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                                            </svg> Manage Withdrawals </a>
                                    </div>
                                </div>
                            </div>

                            <div class="edit-info-area">

                                <div class="body">
                                    <div class="edit-info-area-form">
                                        <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                        <form>
                                            @include('alerts.admin.form-both')

                                            <div class="row mb-4 d-flex align-items-center">
                                                <div class="ds-center d-flex">
                                                    <div class="col-lg-8 text-right pt-2 f-14">
                                                        <label>
                                                            {{ __('Your Affiliate Link *') }}
                                                            <a id="affilate_click" data-toggle="tooltip" data-placement="top" title="Copy" href="javascript:;" class="mybtn1 copy border">
                                                                <i class="fas fa-copy"></i>
                                                            </a>
                                                        </label>
                                                        <br>
                                                        <small>{{ __('This is your affiliate link. Just copy the link and paste it anywhere you want.') }}</small>
                                                    </div>
                                                    <div class="col-lg-4 pt-2">
                                                        @php
                                                        $user_affiliated_times = App\Models\User::where('id', Auth::user()->id)->value('reffered_times');
                                                        $affiliateUrl = url('/'). '/?reff=' . $user->affilate_code;
                                                        @endphp

                                                        @if($user_affiliated_times >= 5)
                                                        <textarea id="affilate_address" class="input-field affilate form-control border h--150" name="address" readonly rows="5">{{ $affiliateUrl }}</textarea>

                                                        <!-- Social Media Share Buttons -->

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 d-flex bg-white p-3 shad rounded">
                                                <label><strong>Share your affiliate link:</strong></label>
                                                <a href="https://wa.me/?text={{ urlencode($affiliateUrl) }}" target="_blank" class="btn p-3 px-3 btn-success desk btn-sm mx-2 mr-1 d-flex gap-3 align-items-center">
                                                    <i class="fab fa-whatsapp"></i> 
                                                </a>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($affiliateUrl) }}" target="_blank" class="btn p-3 px-3 btn-primary desk btn-sm mr-1 d-flex mx-2 gap-3 align-items-center">
                                                    <i class="fab fa-facebook-f"></i> 
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode($affiliateUrl) }}" target="_blank" class="btn btn-info p-3 px-3 desk btn-sm d-flex gap-3 align-items-center mx-2">
                                                    <i class="fab fa-twitter"></i>                                                 </a>
                                                <a href="https://instagram.com/intent/tweet?url={{ urlencode($affiliateUrl) }}" target="_blank" class="btn btn-danger  p-3 px-3 desk btn-sm d-flex gap-3 align-items-center mx-2">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </div>
                                        </form>

                                    </div>


                                    <div class="row pb-3  bg-white shad  rounded mt-3">
                                        <div class="col-lg-8 text-right pt-2 f-14">
                                            <label>{{ __('Affiliate QR Code *') }}</label>
                                            <br>
                                            <small>{{ __('Scan or share this QR code to access your affiliate link.') }}</small>
                                        </div>
                                        <div class="col-lg-4 pt-2 pl-5 text-large">
                                            @php
                                            $affiliateUrl = url('/') . '/?reff=' . $user->affilate_code;
                                            @endphp
                                            {!! QrCode::size(200)->generate($affiliateUrl) !!}
                                            <!-- <p class="mt-2"><small>{{ $affiliateUrl }}</small></p> -->
                                        </div>
                                    </div>


                                    <!-- <div class="row pb-5">
                                                        <div class="col-lg-4 text-right pt-2 f-14">
                                                            <label>{{ __('Affiliate Banner *') }}</label>
                                                            <br>
                                                            <small>{{ __('This is your affilate banner Preview.') }}</small>
                                                        </div>
                                                        <div class="col-lg-8 pt-2 pl-5">
                                                             <a href="{{ url('/').'/?reff='.$user->affilate_code}}" target="_blank"><img src="{{asset('assets/images/'.$gs->affilate_banner)}}"></a>
                                                        </div>
                                                    </div> -->

                                    <!-- <div class="row">
                                                        <div class="col-lg-4 text-right pt-2 f-14">
                                                            <label>{{ __('Affiliate Banner HTML Code *') }} <a id="affilate_html_click" data-toggle="tooltip" data-placement="top" title="Copy"  href="javascript:;" class="mybtn1 copy border px-3"><i class="fas fa-copy"></i></a></label>
                                                            <br>
                                                            <small>{{ __('This is your affilate banner html code just copy the code and paste anywhere you want.') }}</small>
                                                        </div>
                                                        <div class="col-lg-8 pt-2">
                                                            @if($user_affiliated_times >=5)
                                                             <textarea id="affilate_html" class="input-field affilate from-control border w-100 p-4 h--150" name="address" readonly=""><a href="{{ url('/').'/?reff='.$user->affilate_code}}" target="_blank"><img src="{{asset('assets/images/'.$gs->affilate_banner)}}"></a></textarea>
                                                            @endif
                                                        </div>
                                                    </div> -->
                                    </form>
                                </div>
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

@section('script')

<script type="text/javascript">
    (function($) {
        "use strict";

        $('#affilate_click').on('click', function() {
            var copyText = document.getElementById("affilate_address");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

        });

        $('#affilate_html_click').on('click', function() {
            var copyText = document.getElementById("affilate_html");
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

        });

    })(jQuery);
</script>

@endsection