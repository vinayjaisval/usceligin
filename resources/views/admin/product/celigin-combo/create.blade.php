@extends('layouts.admin')

@section('styles')
	<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>
@endsection

@section('content')
<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
					<h4 class="heading">{{ __("Celigin Combo") }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
					<ul class="links">
						<li>
							<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
						</li>
					<li>
						<a href="javascript:;">{{ __("Celigin Combo") }} </a>
					</li>
					<li>
						<a href="{{ route('admin-import-index') }}">{{ __("All Products") }}</a>
					</li>
						<li>
							<a href="{{ route('admin-import-create') }}">{{ __("Add Celigin Combo") }}</a>
						</li>
					</ul>
			</div>
		</div>
	</div>

	<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
	  @include('alerts.admin.form-both')
	  <div class="row">
		  <div class="col-lg-12">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
								<form action="{{route('admin-celigin-combo-store')}}" method="POST">
									@csrf
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __("Category") }}*</h4>
											</div>
										</div>
										<div class="col-lg-8">
											<select id="cat" name="category_id" required="">
												<option value="">{{ __("Select Category") }}</option>
												@foreach($categories as $cat)
													<option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-12">
											<div class="custom-control custom-checkbox">
												@foreach($products as $cat)
													<div class="form-check form-check-inline col-md-4 mt-2">
														<input type="checkbox" id="cat{{$cat->id}}" name="product_id[]" value="{{ $cat->id }}" class="custom-control-input">
														<label class="custom-control-label" for="cat{{$cat->id}}">{{$cat->name}}</label>
													</div>
												@endforeach
											</div>
										</div>
										<input type="hidden" name="status" value="1">
									</div>
									<div class="row">
										<div class="col-lg-8 text-center">
											<button class="addProductSubmit-btn" type="submit">{{ __("Create Celigin Combo") }}</button>
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
@endsection

