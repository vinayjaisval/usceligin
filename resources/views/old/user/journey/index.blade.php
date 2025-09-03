@extends('layouts.front')
@section('content')
@include('partials.global.common-header')
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
            <div class="col-lg-9 col-xl-9 mb-5 mt-3">
                <div class="container ">
                    <div class="row text-center">
                        @php
                        $user = Auth::user();
                        // Count completed orders
                        $completedOrdersCount = $user->orders()->where('payment_status', 'Completed')->count();
                        // Get all orders where this user is in affilate_users (you need to fix this condition — see note below)
                        $ordersWithAffiliate = App\Models\Order::where('status', 'completed')
                        ->where('affilate_user', $user->id) // assumes affilate_users is JSON string
                        ->get();
                        $affiliateOrdersCount = $ordersWithAffiliate->count();
                        // Sum of all affiliate order payments
                        $totalPrice = $ordersWithAffiliate->sum('pay_amount');
                        $convertedTotal = (float) App\Models\Product::vendorConvertPrice($totalPrice);
                        @endphp
                        <!-- User Card -->
                        <div class="col-md-6 col-lg-3 col-xs-3 col-sm-6 mb-4">
                            <div class="card card-color h-100">
                                <div class="card-body">
                                    <div class="card-icon bg-primary"><i class="fa fa-user"></i></div>
                                    <!-- <h5 class="card-title">User</h5> -->
                                    <!-- <div class="status-badge">New</div> -->
                                    <p class="card-text mt-3">
                                        @if ($completedOrdersCount <= 0)
                                            Welcome! Make your first purchase to get your referral link and start earning.
                                            @else
                                            You’ve completed {{ $affiliateOrdersCount }} Referral.
                                            Complete {{ 3 - $affiliateOrdersCount }} more to unlock your Affiliate status!
                                            @endif
                                            </p>
                                            <!-- <div class="arrow-icon">:arrow_right:</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- Affiliate User Card -->
                        <div class="col-md-6 col-lg-3 col-xs-3 col-sm-6 mb-4">
                            <div class="card card-color h-100">
                                <div class="card-body">
                                    <div class="card-icon bg-success"><i class="fa fa-link"></i></div>
                                    <!-- <h5 class="card-title">Affiliate</h5> -->
                                    <!-- <div class="status-badge">Eligible</div> -->
                                    <p class="card-text mt-3">
                                        @if ($completedOrdersCount <= 3)
                                            You’re eligible to become an affiliate. Start earning now!
                                            @else
                                            Complete {{ 3 - $affiliateOrdersCount }} more successful referrals to unlock affiliate status.
                                            @endif
                                            </p>
                                            <!-- <div class="arrow-icon">:arrow_right:</div> -->
                                </div>
                                <div class="icon-right-connect">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Business Manager Card -->
                        <div class="col-md-6 col-lg-3 col-xs-3 col-sm-6 mb-4">
                            <div class="card card-color h-100">
                                <div class="card-body">
                                    <div class="card-icon bg-warning"><i class="fa fa-briefcase"></i></div>
                                    <!-- <h5 class="card-title">Business Manager</h5> -->
                                    <!-- <div class="status-badge">Active</div> -->
                                    <p class="card-text mt-3">
                                        @if ($totalPrice < 50000)
                                            Use POS to increase sales & reach ₹{{ 50000 - $totalPrice }} target.
                                            @elseif ($totalPrice>= 50000 && $totalPrice < 100000)
                                                You are now a Business Manager. Access new tools and perks!
                                                @else
                                                Congratulations! You are a Celigin Partner.
                                                @endif
                                                </p>
                                                <!-- <div class="arrow-icon">:arrow_right:</div> -->
                                </div>
                                <div class="icon-right-connect">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Celigin Partner Card -->
                        <div class="col-md-6 col-lg-3 col-xs-3 col-sm-6 mb-4">
                            <div class="card card-color h-100">
                                <div class="card-body">
                                    <div class="card-icon bg-danger"><i class="fa fa-star"></i></div>
                                    <!-- <h5 class="card-title">Celigin Partner</h5> -->
                                    <!-- <div class="status-badge">Elite</div> -->
                                    <p class="card-text mt-3">
                                        Celigin Partners use POS, grow their network, and earn extra incentives by achieving the ₹5,00,000 quarterly target.
                                    </p>
                                    <!-- <div class="arrow-icon">:arrow_right:</div> -->
                                </div>
                                <div class="icon-right-connect">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@includeIf('partials.global.common-footer')
@endsection





