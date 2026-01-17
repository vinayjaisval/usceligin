<script>
// Form submission handler for address forms
document.addEventListener('DOMContentLoaded', function() {
  // Handle first-time address form
  const firstForm = document.getElementById('firstAddressForm');
  if (firstForm) {
    firstForm.addEventListener('submit', function(e) {
      e.preventDefault();
      submitAddressForm(this, 'create');
    });
  }

  // Handle new address form
  const newForm = document.getElementById('newAddressForm');
  if (newForm) {
    newForm.addEventListener('submit', function(e) {
      e.preventDefault();
      submitAddressForm(this, 'create');
    });
  }

  // Handle edit address forms (dynamic - one per address)
  document.querySelectorAll('[id^="editAddressForm"]').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const addressId = this.id.replace('editAddressForm', '');
      submitAddressForm(this, 'update', addressId);
    });
  });
});

// Submit address form via AJAX
function submitAddressFormold(form, action, addressId = null) {
  const formData = new FormData(form);
  const submitBtn = form.querySelector('button[type="submit"]');
  const originalText = submitBtn.textContent;

  // Disable button and show loading state
  submitBtn.disabled = true;
  submitBtn.textContent = 'Saving...';

  let url, method;
  if (action === 'creates') {
    url = '{{ route("user.addresses.store") }}';
    method = 'POST';
  } else if (action === 'update') {
    url = `/user/addresses/${addressId}`;
    method = 'POST'; // Will use _method: PUT in formData
    formData.append('_method', 'PUT');
  }

  fetch(url, {
    method: method,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
  })
  
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.success) {
      // Reload page to show updated addresses
      window.location.reload();
    } else {
      alert(data.error || 'Failed to save address. Please try again.');
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
  });
}
function submitAddressForm(form, action, addressId = null) {
  const formData = new FormData(form);
  const submitBtn = form.querySelector('button[type="submit"]');
  const originalText = submitBtn.textContent;

  submitBtn.disabled = true;
  submitBtn.textContent = 'Saving...';

  let url = '';
  let method = 'POST';

  // ✅ FIX: create (not creates)
  if (action === 'create') {
    url = "{{ route('user.addresses.store') }}";
  } 
  else if (action === 'update' && addressId) {
    url = `/usceligin/user/addresses/${addressId}`;
    formData.append('_method', 'PUT');
  } 
  else {
    alert('Invalid action');
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
    return;
  }

  fetch(url, {
    method: method,
    headers: {
      'X-CSRF-TOKEN': document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content'),
      'Accept': 'application/json' // ✅ VERY IMPORTANT
    },
    body: formData
  })
  .then(async response => {
    const data = await response.json();
    if (!response.ok) {
      throw data;
    }
    return data;
  })
  .then(data => {
    console.log(data);
    if (data.success) {
      window.location.reload();
    } else {
      alert(data.error || 'Failed to save address.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.error || 'Validation or server error occurred.');
  })
  .finally(() => {
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
  });
}

// Fetch pincode details
function fetchPincodeDetails(formId) {
  const pincodeInput = document.getElementById(`${formId}_pincode`);
  const cityInput = document.getElementById(`${formId}_city`);
  const stateInput = document.getElementById(`${formId}_state`);

  const pincode = pincodeInput.value.trim();

  if (pincode.length === 6 && /^\d{6}$/.test(pincode)) {
    // Fetch from postal API
    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
      .then(response => response.json())
      .then(data => {
        if (data && data[0] && data[0].Status === 'Success') {
          const postOffice = data[0].PostOffice[0];
          cityInput.value = postOffice.District || '';
          stateInput.value = postOffice.State || '';
        } else {
          // Clear fields if pincode not found
          cityInput.value = '';
          stateInput.value = '';
          alert('Invalid pincode. Please check and try again.');
        }
      })
      .catch(error => {
        console.error('Error fetching pincode:', error);
      });
  } else {
    // Clear fields if pincode is invalid
    cityInput.value = '';
    stateInput.value = '';
  }
}

// Cancel address form (for new address in checkout)
function cancelAddressForm() {
  toggleNewAddressForm();
}
</script>
