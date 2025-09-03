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
            <div class="col-xl-9">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget border-0 p-40 widget_categories bg-light account-info">

                <h4 class="widget-title down-line mb-30">
                    {{ __('Referral link') }}
                     <a class="mybtn1" href="{{route('user-affilate-history')}}"> <i class="fas fa-history"></i> {{ __('Referral History') }}</a> 
                </h4>

                <div class="edit-info-area">
                    <div class="body">
                        <div class="edit-info-area-form">
                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                            <form>
                                @include('alerts.admin.form-both')

                                <div class="row mb-4">
                                    <div class="col-lg-4 text-right pt-2 f-14">
                                        <label>
                                            {{ __('Your Referral Link *') }}
                                            <a id="affilate_click" data-toggle="tooltip" data-placement="top" title="Copy" href="javascript:;" class="mybtn1 copy border">
                                                <i class="fas fa-copy"></i>
                                            </a>
                                        </label>
                                        <br>
                                        <small>{{ __('This is your referral link just copy the link and paste anywhere you want.') }}</small>
                                    </div>

                                    <div class="col-lg-8 pt-2">
                                        @php
                                            $referralUrl = url('/').'/'.'?refferel_code='.$user->refferel_code;
                                        @endphp
                                        <textarea id="refferel_address" class="input-field affilate form-control border h--150" name="address" readonly rows="5">{{ $referralUrl }}</textarea>
                                    </div>
                                </div>

                                <!-- Social Share Links -->
                                <div class="row mt-3">
                                    <div class="col-lg-12 text-center">
                                        <h6 class="mb-3">{{ __('Share Your Referral Link') }}</h6>
                                        
                                        <a href="https://wa.me/?text={{ urlencode($referralUrl) }}" target="_blank" class="btn btn-success m-1">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </a>

                                        <a href="https://t.me/share/url?url={{ urlencode($referralUrl) }}" target="_blank" class="btn btn-primary m-1">
                                            <i class="fab fa-telegram-plane"></i> Telegram
                                        </a>

                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($referralUrl) }}" target="_blank" class="btn btn-info m-1">
                                            <i class="fab fa-linkedin"></i> LinkedIn
                                        </a>

                                        <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger m-1" title="Instagram does not allow direct URL sharing.">
                                            <i class="fab fa-instagram"></i> Instagram
                                        </a>
                                        <br>
                                        <small class="text-muted">Instagram sharing must be done manually due to platform restrictions.</small>
                                    </div>
                                </div>

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
            var copyText = document.getElementById("refferel_address");

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