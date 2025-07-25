@extends('layouts.load')
@section('content')

<div class="content-area">
	<div class="add-product-content1">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area">
						@include('alerts.admin.form-error')
						<form id="geniusformdata" action="{{ route('admin-user-edit',$data->id) }}" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}

							<div class="row">
								<div class="col-lg-4">
									<div class="left-area">
										<h4 class="heading">{{ __("Customer Profile Image") }} *</h4>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="img-upload">
										@if($data->is_provider == 1)
										<div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset($data->photo):asset('assets/images/noimage.png') }});">
											@else
											<div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/noimage.png') }});">
												@endif
												@if($data->is_provider != 1)
												<label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __("Upload Image") }}</label>
												<input type="file" name="photo" class="img-upload" id="image-upload">
												@endif
											</div>
											<p class="text">{{ __("Prefered Size: (600x600) or Square Sized Image") }}</p>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Name") }} *</h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input type="text" class="input-field" name="name" placeholder="{{ __("User Name") }}" required="" value="{{ $data->name }}">
									</div>
								</div>


								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Email") }} *</h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input type="email" class="input-field" name="email" placeholder="{{ __("Email Address") }}" value="{{ $data->email }}">
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Phone") }} *</h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input type="text" class="input-field" name="phone" placeholder="{{ __("Phone Number") }}" required="" value="{{ $data->phone }}">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Postal Code") }} </h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input name="zip" id="zipp" type="text" class="input-field form-control border" placeholder="Zip" value="{{$data->zip }}" maxlength="6">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Country") }} </h4>
										</div>
									</div>
									<div class="col-lg-7">

										<input name="country" id="country" type="text" class="input-field form-control border" placeholder="Country" value="{{ $data->country }}" readonly>

									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("State") }} </h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input name="state_id" id="state" type="text" class="input-field form-control border" placeholder="State" value="{{ $data->state_id }}" readonly>

									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("City") }} </h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input name="city_id" id="city" type="text" class="input-field form-control border" placeholder="City" value="{{ $data->city_id }}" readonly>

									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Address") }} *</h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input type="text" class="input-field" name="address" placeholder="{{ __('Address') }}" required="" value="{{ $data->address }}">
									</div>
								</div>
								<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
									<script>
									$(document).ready(function() {
										console.log("Script loaded");
										let fetchedPin = '';

										$('#zipp').on('keyup', function() {
										
											let pincode = $(this).val().trim();

											if (pincode.length === 6 && /^\d{6}$/.test(pincode) && pincode !== fetchedPin) {
												fetchedPin = pincode;

												$('#city').val('Loading...');
												$('#state').val('Loading...');
												$('#country').val('Loading...');

												$.ajax({
													url: "https://api.postalpincode.in/pincode/" + pincode,
													type: "GET",
													success: function(response) {
														console.log('API Response:', response);
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
													error: function() {
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


								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{ __("Aadhar Number") }} </h4>
										</div>
									</div>
									<div class="col-lg-7">
										
										<input 
                                       name="fax" 
                                       type="number"
                                       class="input-field form-control border" 
                                       placeholder="{{ __('Aadhar Number') }}" 
                                       value="{{ $data->fax }}" 
                                       pattern="\d{12}" 
                                       maxlength="12" 
                                       minlength="12" 
                                       title="Aadhar number must be exactly 12 digits"
                                      
                                    >
									</div>
								</div>





								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">
											<h4 class="heading">{{__('Password')}} *</h4>
										</div>
									</div>
									<div class="col-lg-7">
										<input type="password" class="input-field" name="password" placeholder="{{__('Enter Password')}}" value="">
									</div>
								</div>


								<div class="row">
									<div class="col-lg-4">
										<div class="left-area">

										</div>
									</div>
									<div class="col-lg-7">
										<button class="addProductSubmit-btn" type="submit">{{ __("Save") }}</button>
									</div>
								</div>

						</form>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')

@endsection
