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
                     <h4 class="widget-title down-line mb-30">{{ __('Edit Profile') }}
                     </h4>
                     <div class="edit-info-area">
                        <div class="body">
                           <div class="edit-info-area-form">
                              <div class="gocover"
                                 style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                              </div>
                              <form id="userform" action="{{route('user-profile-update')}}" method="POST"
                                 enctype="multipart/form-data">
                                 @csrf
                                 <div class="upload-img">
                                    @if($user->is_provider == 1)
                                    <div class="img">
                                       <img src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                    </div>
                                    @else
                                    <div class="img">
                                       <img
                                          src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}">
                                    
                                       </div>
                                    @endif
                                    @if($user->is_provider != 1)
                                    <div class="file-upload-area">
                                       <div class="upload-file">
                                          <label>{{ __('Upload') }}
                                             <input type="file" size="60" name="photo" class="upload form-control">
                                          </label>
                                       </div>
                                    </div>
                                    @endif
                                 </div>
                                 <div class="row mb-4">
                                    <div class="col-lg-6">
                                       <input name="name" type="text" class="input-field form-control border"
                                          placeholder="{{ __('User Name') }}" required="" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-lg-6">
                                       <input name="email" type="email" class="input-field form-control border"
                                          placeholder="{{ __('Email Address') }}" required="" value="{{ $user->email }}"
                                          >
                                    </div>
                                 </div>
                                 <div class="row mb-4">
                                 <div class="col-lg-6">
                                    <input 
                                       class="input-field form-control border" 
                                       type="text" 
                                       name="phone" 
                                       placeholder="{{ __('Phone Number') }}" 
                                       required 
                                       maxlength="10"
                                       minlength="10"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                       value="{{ old('phone', $user->phone) }}">

                                    @error('phone')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>

                                 <div class="col-lg-6">
                                    <input 
                                       name="fax" 
                                       type="tel" 
                                       class="input-field form-control border" 
                                       placeholder="{{ __('Aadhar Number') }}" 
                                       value="{{ $user->fax }}" 
                                       pattern="\d{12}" 
                                       maxlength="12" 
                                       minlength="12" 
                                       title="Aadhar number must be exactly 12 digits"
                                       required
                                    >
                                 </div>

                                 </div>
                               

                                 <div class="row mb-4 g-3">
                                       <div class="col-lg-6">
                                          <input name="zip" id="zip" type="text" class="input-field form-control border" placeholder="Zip" value="{{ $user->zip }}" maxlength="6">
                                       </div>

                                       <div class="col-lg-6">
                                          <input name="country" id="country" type="text" class="input-field form-control border" placeholder="Country" value="{{ $user->country }}" readonly>
                                       </div>

                                       <div class="col-lg-6">
                                          <input name="state_id" id="state" type="text" class="input-field form-control border" placeholder="State" value="{{ $user->state_id }}" readonly>
                                       </div>

                                       <div class="col-lg-6">
                                          
                                          <input name="city_id" id="city" type="text" class="input-field form-control border" placeholder="City" value="{{ $user->city_id }}" readonly>
                                       </div>
                                    </div>



                                 <div class="row mb-4">
                                    <div class="col-lg-12">
                                       <textarea class="input-field form-control border" name="address"
                                          placeholder="{{ __('Address') }}" cols="30" rows="10"
                                          required>{{ $user->address }}</textarea>
                                    </div>
                                 </div>
                                 <div class="form-links">
                                    <button class="submit-btn btn btn-primary" type="submit">{{ __('Save') }}</button>
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
</div>
<!--==================== Blog Section End ====================-->
{{-- Modal --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header d-block text-center">
            <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p class="text-center">{{ __('The Licenes Key is :') }} <span id="key"></span></p>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
         </div>
      </div>
   </div>
</div>
@includeIf('partials.global.common-footer')
@endsection
@section('script')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let fetchedPin = '';

    $('#zip').on('keyup', function (e) {
        let pincode = $(this).val().trim();

        // Only trigger on exactly 6 digits and not previously fetched
        if (pincode.length === 6 && /^\d{6}$/.test(pincode) && pincode !== fetchedPin) {
            fetchedPin = pincode;

            // Optional: show loading indicator
            $('#city, #state, #country').val('Loading...');

            $.ajax({
                url: "https://api.postalpincode.in/pincode/" + pincode,
                type: "GET",
                success: function (response) {
                    if (response[0].Status === "Success" && response[0].PostOffice.length > 0) {
                        let postOffice = response[0].PostOffice[0];
                        $('#city').val(postOffice.District);
                        $('#state').val(postOffice.State);
                        $('#country').val(postOffice.Country);
                    } else {
                        $('#city, #state, #country').val('');
                        alert("Invalid PIN code.");
                    }
                },
                error: function () {
                    $('#city, #state, #country').val('');
                    alert("Could not fetch data. Try again.");
                }
            });
        } else if (pincode.length < 6) {
            $('#city, #state, #country').val('');
        }
    });
});
</script>

@endsection