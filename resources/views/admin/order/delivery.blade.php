@extends('layouts.load')

@section('content')

<div class="content-area">
  <div class="add-product-content1">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-description">
          <div class="body-area" id="modalEdit">

            @include('alerts.admin.form-error')

            <form id="geniusformdata" action="{{ route('admin-order-update',$data->id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

              {{-- Payment Status --}}
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Payment Status') }} *</h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <select name="payment_status" required class="form-control">
                    <option value="Pending" {{ $data->payment_status == 'Pending' ? "selected" : "" }}>
                      {{ __('Unpaid') }}
                    </option>
                    <option value="Completed" {{ $data->payment_status == 'Completed' ? "selected" : "" }}>
                      {{ __('Paid') }}
                    </option>
                  </select>
                </div>
              </div>

              {{-- Delivery Status --}}
              <div class="row mt-3">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Delivery Status') }} *</h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <select name="status" required id="myDiv" class="form-control">
                    <option value="pending" {{ $data->status == "pending" ? "selected" : "" }}>Pending</option>
                    <option value="processing" {{ $data->status == "processing" ? "selected" : "" }}>Processing</option>
                    <option value="on delivery" {{ $data->status == "on delivery" ? "selected" : "" }}>On Delivery</option>
                    <option value="completed" {{ $data->status == "completed" ? "selected" : "" }}>Completed</option>
                    <option value="declined" {{ $data->status == "declined" ? "selected" : "" }}>Declined</option>
                  </select>
                </div>
              </div>

              {{-- Track Note --}}
              <div class="row mt-3">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Track Note') }} *</h4>
                    <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <textarea class="input-field form-control" required name="track_text" placeholder="Enter Track Note Here"></textarea>
                </div>
              </div>

              {{-- Submit --}}
              <div class="row mt-4">
                <div class="col-lg-4"></div>
                <div class="col-lg-7">
                  <button class="addProductSubmit-btn mybtn8 btn btn-primary" type="submit">
                    {{ __('Save') }}
                  </button>
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


@section('scripts')
<script>
$(document).ready(function(){

    $(".mybtn8").click(function(e){

        e.preventDefault(); // stop default submit

        var status = $('#myDiv').val();
        var form = $("#geniusformdata");
        var button = $(".mybtn8");

        // disable button to prevent multiple clicks
        button.prop('disabled', true);

        // ✅ If Declined → call API
        if(status === 'declined') {

            if(!confirm("Are you sure you want to cancel this order?")) {
                button.prop('disabled', false);
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: mainurl + "/cancelWaybill/{{ $data->id }}",
                type: 'POST',
                data: { cancel: status },

                success: function(response) {
                    console.log("Cancelled:", response);

                    form.off('submit').submit(); // submit after success
                },

                error: function(err) {
                    console.log(err);
                    alert("Error while cancelling order!");
                    button.prop('disabled', false);
                }
            });

        } else {
            // ✅ Normal submit for other statuses
            form.off('submit').submit();
        }

    });

});
</script>
@endsection