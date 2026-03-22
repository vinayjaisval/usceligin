<script>
/**
 * Pincode auto-fill — called by address-form component via onkeyup
 * Fetches city/state from postalpincode.in API when 6 digits are entered
 */
function fetchPincodeDetails(formId) {
  const pincodeInput = document.getElementById(`${formId}_pincode`);
  const cityInput    = document.getElementById(`${formId}_city`);
  const stateInput   = document.getElementById(`${formId}_state`);

  if (!pincodeInput || !cityInput || !stateInput) return;

  const pincode = pincodeInput.value.trim();

  if (pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
    cityInput.value  = '';
    stateInput.value = '';
    return;
  }

  cityInput.value  = 'Loading...';
  stateInput.value = 'Loading...';

  fetch(`https://api.postalpincode.in/pincode/${pincode}`)
    .then(r => r.json())
    .then(data => {
      if (data[0]?.Status === 'Success') {
        const po = data[0].PostOffice[0];
        cityInput.value  = po.District ?? '';
        stateInput.value = po.State    ?? '';
        const countryInput = document.getElementById(`${formId}_country`);
        if (countryInput) countryInput.value = po.Country ?? 'India';
      } else {
        cityInput.value  = '';
        stateInput.value = '';
        AddressManager?.showToast?.('Pincode not found. Please enter city and state manually.', 'warning')
          ?? alert('Pincode not found. Please verify it and try again.');
      }
    })
    .catch(() => {
      cityInput.value  = '';
      stateInput.value = '';
    });
}

/**
 * Cancel add-address form (toggles the container back)
 */
function cancelAddressForm() {
  AddressManager.toggleNewAddressForm('delivery');
}
</script>
