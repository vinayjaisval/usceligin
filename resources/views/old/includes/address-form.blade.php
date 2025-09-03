<div class="modal fade" id="add{{ ucfirst($type) }}Modal" tabindex="-1" aria-labelledby="add{{ ucfirst($type) }}ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
        @csrf
        <input type="hidden" name="address_type" value="{{ $type }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New {{ ucfirst($type) }} Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input name="name" class="form-control mb-2" placeholder="Full Name" required>
                <input name="address" class="form-control mb-2" placeholder="Full Address" required>
                <input name="city" class="form-control mb-2" placeholder="City" required>
                <input name="state" class="form-control mb-2" placeholder="State" required>
                <input name="zip" class="form-control mb-2" placeholder="ZIP Code" required>
                <input name="country" class="form-control mb-2" placeholder="Country" required>
                <input name="phone" class="form-control mb-2" placeholder="Mobile Number" required>
                @if($type === 'billing')
                    <input name="company_name" class="form-control mb-2" placeholder="Company Name (optional)">
                    <input name="gst_number" class="form-control mb-2" placeholder="GST Number (optional)">
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save Address</button>
            </div>
        </div>
    </form>
  </div>
</div>
