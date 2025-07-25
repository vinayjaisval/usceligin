@if (Session::has('order_address'))
@php
    $user = Session::get('order_address');
@endphp
<div class="row mt-2">
  <div class="col col-md-4 col-sm-6">
    <label for="name">Name *</label>
    <input type="text" class="form-control" required name="customer_name" id="name" value="{{$user['customer_name']}}" placeholder="Name">
  </div>
  <div class="col col-md-4 col-sm-6">
    <label for="email">Email *</label>
    <input type="text" class="form-control" required name="customer_email" id="email" placeholder="Email" value="{{$user['customer_email']}}">
  </div>
  <div class="col col-md-4 col-sm-6">
    <label for="phone">Phone *</label>
    <input type="text" class="form-control" required name="customer_phone" id="phone" placeholder="Phone" value="{{$user['customer_phone']}}">
  </div>
  {{-- <div class="col col-md-12 col-sm-12">
    <label for="customer_address">Address *</label>
   <textarea type="text" class="form-control" name="customer_address" placeholder="Address" id="customer_address">{{$user['customer_address']}}</textarea>
  </div> --}}
</div>
<div class="row">
  {{-- <div class="col col-md-6 col-sm-6">
    <label for="customer_country">Country * </label>
      <select type="text" class="form-control" name="customer_country" id="customer_country" required>
        <option value="">{{ __('Select Country') }}</option>
        @foreach (DB::table('countries')->get() as $data)
            <option value="{{ $data->country_name }}"  {{$user['customer_country'] == $data->country_name ? 'selected' : ''}}>
                {{ $data->country_name }}
            </option>		
        @endforeach
    </select>
  </div> --}}
  <div class="col col-md-6 col-sm-6">
    <label for="post_code">Country</label>
    <input type="text" class="form-control" name="customer_country" id="customer_country" placeholder="Country" value="{{$user['customer_country']}}" required readonly>
  </div>
  <div class="col col-md-6 col-sm-6">
    <label for="customer_city">City</label>
    <input type="text" class="form-control" name="customer_city" id="customer_city" placeholder="City" value="{{$user['customer_city']}}" required readonly>
  </div>
  <div class="col col-md-6 col-sm-6">
    <label for="customer_state">State</label>
    <input type="text" class="form-control" name="customer_state" id="customer_state" placeholder="State" value="{{$user['customer_state']}}" required readonly>
  </div>
 
  <div class="col col-md-6 col-sm-6">
    <label for="post_code">Postal Code</label>
    <input type="text" class="form-control zipcode" name="customer_zip" id="post_code" placeholder="Postal Code" value="{{$user['customer_zip']}}" >
  </div>
  <div class="col col-md-12 col-sm-12">
    <label for="customer_address">Address *</label>
   <textarea type="text" class="form-control" name="customer_address" placeholder="Address" id="customer_address" required>{{$user['customer_address']}}</textarea>
  </div>
  <input type="hidden" value="0" name="shipping_cost" id="shipping_cost">
</div>

@else  

@php
    $isUser = isset($isUser) ? $isUser : false;
   
@endphp
@if ($isUser == 1)
  <div class="row mt-2">
    <div class="col col-md-4 col-sm-6">
      <label for="name">Name *</label>
      <input type="text" class="form-control" required name="customer_name" id="name" value="{{$user['name']}}" placeholder="Name" required >
    </div>
    <div class="col col-md-4 col-sm-6">
      <label for="email">Email *</label>
      <input type="text" class="form-control" required name="customer_email" id="email" placeholder="Email" value="{{$user['email']}}" required >
    </div>
    <div class="col col-md-4 col-sm-6">
      <label for="phone">Phone *</label>
      <input type="text" class="form-control" required name="customer_phone" id="phone" placeholder="Phone" value="{{$user['phone']}}" required >
    </div>
    
  </div>
  <div class="row">

    <div class="col col-md-6 col-sm-6">
      <label for="customer_zip">Postal Code *</label>
       <input type="text" class="form-control zipcode" required name="customer_zip" id="customer_zip" placeholder="Postal Code" required>
       <span class="loader" id="loader" style="display: none" ><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
    </div>

    <div class="col col-md-6 col-sm-6">
      <label for="post_code">Country</label>
      <input type="text" class="form-control" name="customer_country" id="customer_country" placeholder="Country" required readonly>
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_city">City</label>
      <input type="text" class="form-control" name="customer_city" id="customer_city" placeholder="City" required readonly>
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_state">State</label>
      <input type="text" class="form-control" name="customer_state" id="customer_state" placeholder="State" required readonly>
    </div>
    <div class="col col-md-12 col-sm-12">
      <label for="customer_address">Address *</label>  
    <textarea  type="text" class="form-control"  name="customer_address" id="customer_address" placeholder="Address" required>{{$user['address']}}</textarea>
    </div>
    <input type="hidden" value="0" name="shipping_cost" id="shipping_cost">

    {{-- <div class="col col-md-6 col-sm-6">
      <label for="customer_country">Country * </label>
      <select type="text" class="form-control" name="customer_country" id="customer_country" required>
        <option value="">{{ __('Select Country') }}</option>
        @foreach (DB::table('countries')->get() as $data)
            <option value="{{ $data->country_name }}"  {{$user['country'] == $data->country_name ? 'selected' : ''}}>
                {{ $data->country_name }}
            </option>		
         @endforeach
    </select>
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_city">City</label>
      <input type="text" class="form-control" name="customer_city" id="customer_city" placeholder="City" value="{{$user['city']}}">
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_state">State</label>
      <input type="text" class="form-control" name="customer_state" id="customer_state" placeholder="State" value="{{$user['state']}}">
    </div>
   
    <div class="col col-md-6 col-sm-6">
      <label for="post_code">Postal Code</label>
      <input type="text" class="form-control" name="customer_zip" id="post_code" placeholder="Postal Code" value="{{$user['zip']}}">
    </div> --}}
  </div>
@else

  <div class="row mt-2">
    <div class="col col-md-4 col-sm-6">
      <label for="name">Name *</label>
      <input type="text" class="form-control" required name="customer_name" id="name" placeholder="Name" required>
    </div>
    <div class="col col-md-4 col-sm-6">
      <label for="email">Email *</label>
      <input type="text" class="form-control" required name="customer_email" id="email" placeholder="Email" required>
    </div>
    <div class="col col-md-4 col-sm-6">
      <label for="phone">Phone *</label>
      <input type="text" class="form-control" required name="customer_phone" id="phone" placeholder="Phone" required>
    </div>
  </div>
  <div class="row">
    {{-- <div class="col col-md-6 col-sm-6">
      <label for="customer_country">Country * </label>
      <select  class="form-control" name="customer_country" id="customer_country" required>
        <option value="">{{ __('Select Country') }}</option>
        @foreach (DB::table('countries')->get() as $data)
            <option value="{{ $data->country_name }}" >
                {{ $data->country_name }}
            </option>		
         @endforeach
    </select> --}}

    <div class="col col-md-6 col-sm-6">
      <label for="customer_zip">Postal Code *</label>
       <input type="text" class="form-control zipcode" required name="customer_zip" id="customer_zip" placeholder="Postal Code" required>
       <span class="loader" id="loader" style="display: none" ><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
    </div>

    <div class="col col-md-6 col-sm-6">
      <label for="post_code">Country</label>
      <input type="text" class="form-control" name="customer_country" id="customer_country" placeholder="Country" readonly required>
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_city">City</label>
      <input type="text" class="form-control" name="customer_city" id="customer_city" placeholder="City" readonly required>
    </div>
    <div class="col col-md-6 col-sm-6">
      <label for="customer_state">State</label>
      <input type="text" class="form-control" name="customer_state" id="customer_state" placeholder="State" readonly required>
    </div>
    <div class="col col-md-12 col-sm-12">
      <label for="customer_address">Address *</label>
      <textarea  type="text"  class="form-control" required name="customer_address" placeholder="Address" id="customer_address" required></textarea>
    </div>
    <input type="hidden" value="0" name="shipping_cost" id="shipping_cost">
  </div>
@endif
    
@endif


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const zipcodeInput = document.querySelector('.zipcode');
    zipcodeInput.addEventListener('keyup', (e) => {
      const zipcode = zipcodeInput.value;
      if (!/^\d+$/.test(zipcode)) {
        zipcodeInput.value = '';
        return;
      }
      if (zipcode.length === 6) {
        document.querySelector('#loader').style.display = 'inline-block';
        fetch(`${mainurl}/getPinCodeDetails`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ zipcode }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status) {
              $("#customer_city").val(data.result.city);
              $("#customer_state").val(data.result.state);
              $("#customer_country").val(data.result.country);
              $("#shipping_cost").val(data.result.shipping_cost);
              document.querySelector('#loader').style.display = 'none';
              return false;
            } else {
              getShipping(data.result.shipping_cost);
            }
          })
          .catch((error) => console.error('Error: ', error));
      }
    });
  });
</script>
