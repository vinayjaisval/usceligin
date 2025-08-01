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
                <div class="bb-profile-content">
                    <div class="bb-profile-header">
                        <h1 class="bb-profile-header-title h3 mb-0"> Address books </h1>
                    </div>
                    <div class="bb-profile-main">
                        <div class="dashboard-address">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                                <div>
                                    <h2 class="h5 mb-1">Your Addresses</h2>
                                    <p class="text-muted small mb-0">Manage your shipping and billing addresses</p>
                                </div>
                            </div>
                            <div class="bb-customer-card-list">
                                <div class="row row-cols-1 row-cols-lg-3 row-cols-lg-2 g-4">
                                    @if(isset($address) && count($address) > 0)
                                    @foreach($address as $addresss)
                                    <div class="col">
                                        <div class="bb-customer-card">
                                            <div class="bb-customer-card-header">
                                                <div class="bb-customer-card-title"><span class="value">{{ $user->name }}</span></div>
                                                <div class="bb-customer-card-status"><span class="badge bg-primary text-info-primary "> Default</span></div>
                                            </div>
                                            <div class="bb-customer-card-body">
                                                <div class="bb-customer-card-info text-start">
                                                    <div class="info-item align-items-start bb-customer-card-info-address"><span class="label"><svg class="icon svg-icon-ti-ti-book" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                                                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                                                <path d="M3 6l0 13"></path>
                                                                <path d="M12 6l0 13"></path>
                                                                <path d="M21 6l0 13"></path>
                                                            </svg></span><span class="value text-start">{{ $addresss->address }}</span></div>
                                                    <div class="info-item align-items-start"><span class="label"><svg class="icon svg-icon-ti-ti-phone" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                                            </svg></span><span class="value text-start">{{ $user->phone }}</span></div>
                                                </div>
                                            </div>
                                            <div class="bb-customer-card-footer">
                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('user-address-edit', $addresss->id) }}"><svg class="icon me-1 svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg> Edit </a> -->
                                                <form method="GET" action="{{ route('user-address-delete', $addresss->id) }}" accept-charset="UTF-8" onsubmit="return confirm('Are you sure you want to delete this address?')"><button type="submit" class=""><svg class="icon me-1 svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>  </button></form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="card border-0 bg-light mt-4">
                                <div class="card-body text-center py-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3"><svg class="icon text-primary svg-icon-ti-ti-map-pin-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            <path d="M12.794 21.322a2 2 0 0 1 -2.207 -.422l-4.244 -4.243a8 8 0 1 1 13.59 -4.616"></path>
                                            <path d="M16 19h6"></path>
                                            <path d="M19 16v6"></path>
                                        </svg></div>
                                    <h5 class="card-title h6 mb-2">Need another address?</h5>
                                    <p class="card-text text-muted small mb-3"> Add multiple addresses for different shipping locations or billing purposes. </p><a href="{{route('user-address-add')}}" class="btn btn-outline-primary btn-sm"><svg class="icon me-1 svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg> Add Another Address </a>
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