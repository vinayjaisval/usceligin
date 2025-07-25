@extends('layouts.front')
@section('content')
@include('partials.global.common-header')


        <!--====================Join Celigin Club ====================-->
        <div class="full-row mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="woocommerce">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-12 mx-auto">
                                    <div class="registration-form border">
                                        @include('includes.admin.form-login')
                                        <h3 class="text-center m-3">{{ __('Join Celigin Club') }}</h3>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form  action="{{route('front.join-now-club-store')}}" method="POST">
                                            @csrf
                                                <p>
                                                    <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"  >
                                                </p>
                                                <p>
                                                    <input type="email" name="email" class="form-control" required=""  placeholder="{{ __('Email Address') }}" >
                                                </p>
                                                <p>
                                                    <input type="number" name="phone" class="form-control" required=""  placeholder="{{ __('Phone Number') }}" >
                                                </p>
                                                <!-- <p>
                                                    <input type="text" name="address" class="form-control" required=""  placeholder="{{ __('Address') }}" >
                                                </p> -->
                                                <p>
                                                    <input type="url" name="instagram_profile_link" class="form-control"   placeholder="{{ __('Instagram Profile Link') }}" >
                                                </p>
                                                <p>
                                                    <input type="url" name="youtube_profile_link" class="form-control"   placeholder="{{ __('Youtube Profile link') }}" >
                                                </p>
                                            </p>
                                            <button type="submit" class="btn btn-primary float-none w-100 rounded-0 submit-btn" >{{ __('Register') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--==================== Registration Form Start ====================-->

@include('partials.global.common-footer')
@endsection