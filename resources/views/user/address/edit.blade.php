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
                     <h4 class="widget-title down-line mb-30">{{ __('Address add') }}
                     </h4>
                     <div class="edit-info-area">
                        <div class="body">
                           <div class="edit-info-area-form">
                              
                              <form  action="{{route('user-address-update'. '/' . $address->id)}}" method="POST"
                                >
                                 @csrf
                                
                                 <div class="row mb-4">
                                    <div class="col-lg-6">
                                       <input type="hidden" name="user_id" value="{{ $address->id }}" class="input-field form-control border">
                                       <input name="name" type="text" class="input-field form-control border"
                                          placeholder="{{ __('User Name') }}" required="" value="{{ $user->name }}">
                                    </div>
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
                                       <div class="col-lg-6">
                                          <input name="flat_no" id="flat_no" type="text" class="input-field form-control border" placeholder="House No." value="{{$address->flat_no}}">
                                       </div>

                                       <div class="col-lg-6">
                                          <input name="flat_no" id="flat_no" type="text" class="input-field form-control border" placeholder="Landmark." value="{{$address->landmark}}">
                                       </div>
                                    </div>



                                 <div class="row mb-4">
                                    <div class="col-lg-12">
                                       <textarea class="input-field form-control border" name="address"
                                          placeholder="{{ __('Address') }}" cols="10" rows="5"
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