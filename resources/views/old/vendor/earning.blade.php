@extends('layouts.vendor')
@section('styles')
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')

          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Earning')}}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('vendor.dashboard') }}">{{ __('Dashbord') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('vendor-shipping-index') }}">{{ __('Earning') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <form action="{{route('vendor.income')}}" method="GET">
            <div class="product-area">
              <div class="row">

                @include('includes.admin.form-both')

                <div class="col-sm-3  offset-2 mt-3">
								  <input type="text"  autocomplete="off" class="input-field discount_date" value="{{$start_date != '' ? $start_date->format('d-m-Y') : ''}}"  name="start_date"  placeholder="{{ __("Enter Date") }}"  value="">
								</div>
								<div class="col-sm-3 mt-3">
								  <input type="text"  autocomplete="off" class="input-field discount_date" value="{{$end_date != '' ? $end_date->format('d-m-Y') : ''}}" name="end_date"  placeholder="{{ __("Enter Date") }}"  value="">
								</div>
								<div class="col-sm-4 mt-3">
								 <button type="submit" class="mybtn1">Check</button>
								 <button type="button" id="reset" class="mybtn1">Reset</button>
								</div>

                <div class="col-lg-12">
                  <p class="text-center"> <b> {{$start_date != '' ? $start_date->format('d-m-Y') : ''}} {{$start_date != '' && $end_date != '' ? 'To' : ''}}  {{$end_date != '' ? $end_date->format('d-m-Y') : ''}} {{__('Total Earning')}} : {{$total}}</b></p>
                  <div class="mr-table allproduct">

                </form>


                        @include('includes.admin.form-success')
                    <div class="table-responsive">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th>{{ __('Order Number') }}</th>
                                <th>{{__('Total Earning') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Txn Id') }}</th>
                                <th>{{ __('Order Date') }}</th>
                            </tr>
                          </thead>
                          <tbody>

                            @foreach ($datas as $data)
                                <tr>
                                  <td>

                                    <a href="{{route('vendor-order-invoice',$data->order_number)}}">{{$data->order_number}}</a>
                                  </td>
                                  <td>
                                    {{ round($data->seller_commission , 2)}}
                                  </td>
                                  <td>
                                    {{$data->method}}
                                  </td>
                                  <td>
                                    {{$data->txnid}}
                                  </td>
                                  <td>
                                    {{$data->created_at->format('d-m-Y')}}
                                  </td>
                                </tr>
                            @endforeach

                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



@endsection

@section('scripts')


{{-- DATA TABLE --}}

<script type="text/javascript">
		$('#geniustable').DataTable();

  $(document).on('click','#reset',function(){
    $('.discount_date').val('');
    location.href = '{{route('vendor.income')}}';
  })
</script>

@endsection
