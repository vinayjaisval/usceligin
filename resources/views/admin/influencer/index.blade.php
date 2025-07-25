@extends('layouts.admin') 

@section('content')  

					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Influencer") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-subs-index') }}">{{ __("Influencer") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
                                    @include('alerts.admin.form-both')  
										<div class="table-responsive">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __("#Sl") }}</th>
									                        <th>{{ __("Name") }}</th>
									                        <th>{{ __("Email") }}</th>
									                        <th>{{ __("Phone") }}</th>
									                        <th>{{ __("Instagram") }}</th>
									                        <th>{{ __("YouTube") }}</th>
									                        <th>{{ __("Sync To User") }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



@endsection    



@section('scripts')

    <script type="text/javascript">

(function ($) {
    "use strict";

    $('#geniustable').DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route('influencer-list-datatables') }}',
        columns: [
            { data: 'id', name: 'id' },
            { 
                data: 'name', 
                render: function (data) {
                    return `<a href="#">${data}</a>`;
                }, 
                name: 'name' 
            },
            { 
                data: 'email', 
                render: function (data) {
                    return `<a href="mailto:${data}">${data}</a>`;
                }, 
                name: 'email' 
            },
            { 
                data: 'phone', 
                render: function (data) {
                    return `<a href="tel:${data}">${data}</a>`;
                }, 
                name: 'phone' 
            },
            { 
                data: 'instagram_profile_link', 
                render: function (data) {
                    return data ? `<a href="${data}" target="_blank"><i class="fab fa-instagram"></i></a>` : '';
                }, 
                name: 'instagram_profile_link' 
            },
            { 
                data: 'youtube_profile_link', 
                render: function (data) {
                    return data ? `<a href="${data}" target="_blank"><i class="fab fa-youtube"></i></a>` : '';
                }, 
                name: 'youtube_profile_link' 
            },
            { 
                data: 'sync_action', // Handle this server-side
                render: function (data) {
                    return data ? `<a href="${data}" ><i class="fas fa-sync-alt"></i></a>` : 'User Created';
                }, 
                name: 'sync_action', 
                orderable: false 
            },
        ],
        language: {
            processing: `<img src="{{ asset('assets/images/' . $gs->admin_loader) }}">`
        }
    });

})(jQuery);

    </script>
@endsection   