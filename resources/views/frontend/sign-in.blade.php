<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Secure sign-in to your CELIGIN account with OTP verification. Access your beauty rewards, order history, and personalized skincare recommendations." />
  <meta name="keywords"
    content="CELIGIN login, account sign in, OTP verification, secure login, beauty account, skincare login" />
  <meta name="robots" content="noindex, nofollow" />
  <meta name="theme-color" content="#bc4f38" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Secure Sign In | CELIGIN - Premium Beauty & Skincare</title>

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Compiled CSS with Tailwind and Custom Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Tailwind Dark Mode Initialization -->
  <script>
    // Simple Tailwind dark mode initialization
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.ico')}}" />
</head>

<body>
  <main class="min-h-screen flex items-center justify-center px-0 py-xl bg-gray-50 dark:bg-gray-900">
    <div class="form-container">
      <section class="form-card" aria-labelledby="signin-heading">
          <header class="mb-xl">
            <img src="{{ asset('assets/images/' . ($gs->logo ?? 'logo.png')) }}"
              alt="{{ config('app.name', 'CELIGIN') }} - Premium Beauty & Skincare"
              class="mx-auto h-10 max-w-[7.5rem] object-contain" width="120" height="40" />
          </header>

          <div class="sign-in-section" id="signInSection">
            <div class="mb-lg" id="methodSelection">
              <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-lg" id="signin-heading">Sign In with OTP</h1>
              <fieldset class="flex gap-0 mb-lg">
                <legend class="sr-only">Select your preferred verification method</legend>
                <button type="button"
                  class="method-btn method-btn--active"
                  id="phoneMethodBtn" data-method="phone" aria-pressed="true" aria-describedby="phone-help">
                  <span>Phone Number</span>
                </button>
                <button type="button"
                  class="method-btn method-btn--inactive"
                  id="emailMethodBtn" data-method="email" aria-pressed="false" aria-describedby="email-help">
                  <span>Email Address</span>
                </button>
              </fieldset>
            </div>

            <!-- Authentication Form -->
            <form class="text-left" id="signInForm" novalidate aria-labelledby="signin-heading" role="form">
              @csrf
              <!-- Phone Input (default) -->
              <div class="form-input-group block" id="phoneGroup">
                <label for="phoneNumber" class="form-label">
                  Mobile Number<abbr class="required-asterisk" title="required">*</abbr>
                </label>
                <div class="form-input-with-prefix">
                  <span class="form-input-prefix" aria-label="Country code India">{{ config('app.country_code', '+91') }}</span>
                  <input type="tel" id="phoneNumber" name="contact"
                    placeholder="{{ config('app.phone_placeholder', '00000 00000') }}"
                    maxlength="{{ config('app.phone_max_length', '11') }}"
                    required autocomplete="tel"
                    aria-describedby="phoneHelp phoneError" aria-invalid="false" aria-label="Enter your mobile number" />
                </div>
                <p class="form-help-text" id="phoneHelp">
                  Enter your 10-digit Indian mobile number. We'll send a secure OTP for verification.
                </p>
                <div class="alert alert-error hidden mt-xs" id="phoneError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
              </div>

              <!-- Email Input (hidden by default) -->
              <div class="form-input-group hidden" id="emailGroup">
                <label for="emailAddress" class="form-label">
                  Email Address<abbr class="required-asterisk" title="required">*</abbr>
                </label>
                <input type="email" id="emailAddress" name="contact" class="form-input"
                  placeholder="{{ config('app.email_placeholder', 'your@email.com') }}"
                  autocomplete="email" aria-describedby="emailHelp emailError"
                  aria-invalid="false" aria-label="Enter your email address" />
                <p class="form-help-text" id="emailHelp">
                  We'll send a secure OTP to your email address for verification.
                </p>
                <div class="alert alert-error hidden mt-xs" id="emailError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
              </div>

              <!-- Keep me signed in -->
              <div class="mb-lg">
                <div class="flex items-start gap-5">
                  <input type="checkbox" id="keepSignedIn" name="keep_signed_in"
                    class="mt-1 h-4 w-4 text-orange-600 dark:text-orange-400 border-border-medium rounded-none focus:ring-accent-primary focus:ring-2">
                  <div class="flex items-center gap-2">
                    <label for="keepSignedIn" class="text-sm text-gray-900 dark:text-gray-100 cursor-pointer">
                      Keep me signed in
                    </label>
                    <div class="tooltip-wrapper">
                      <button type="button" class="tooltip-trigger info-btn"
                        aria-label="Information about staying signed in">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                          <path
                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <div class="tooltip-content">
                          Stay signed in to save time on future visits. We'll remember your preferences and keep you
                          logged in for up to 30 days. You can always sign out manually for security.
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn--primary btn--full" id="sendOtpBtn" disabled>
                Send OTP
              </button>

              <!-- Terms and Privacy -->
              <div class="text-center text-sm text-gray-500 dark:text-gray-500">
                <p>
                  By signing in, you agree to our
                  <a href="{{ route('terms') ?? '#' }}"
                    class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline transition-colors duration-fast">Terms
                    and Conditions</a>
                  and that you've read our
                  <a href="{{ route('privacy') ?? '#' }}"
                    class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline transition-colors duration-fast">Privacy
                    Policy</a>.
                </p>
              </div>
            </form>
          </div>

          <div class="text-left" id="otpVerification" style="display: none" aria-labelledby="otp-heading" aria-live="polite">
            <div class="mb-lg">
              <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 text-center" id="otp-heading">Enter Verification Code</h2>
            </div>

            <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-lg" id="otpSubtitle">
              We've sent a 6-digit code to your contact
            </p>

            <form class="text-left" id="otpForm" novalidate aria-labelledby="otp-heading" role="form">
              @csrf
              <div class="form-input-group">
                <label for="otpInput" class="form-label">
                  6-Digit Verification Code<abbr class="required-asterisk" title="required">*</abbr>
                </label>
                <input type="text" id="otpInput" name="otp_code" class="form-input-otp"
                  placeholder="{{ config('app.otp_placeholder', '000000') }}"
                  maxlength="{{ config('app.otp_length', '6') }}"
                  required autocomplete="one-time-code" inputmode="numeric"
                  pattern="[0-9]{6}" aria-describedby="otpSubtitle otpError" aria-invalid="false" aria-label="Enter the 6-digit verification code" />
                <div class="alert alert-error hidden mt-xs" id="otpError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
                <div class="alert alert-success hidden mt-xs" id="otpSuccess" role="alert" aria-live="polite">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
              </div>

              <div class="text-center text-sm text-gray-600 dark:text-gray-400 mb-lg" id="otpTimer">
                <p>
                  Didn't receive the code?
                  <button type="button"
                    class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline font-medium disabled:text-gray-500 dark:text-gray-500 disabled:no-underline disabled:cursor-not-allowed"
                    id="resendOtp" disabled>
                    Resend OTP in <span id="countdown">60</span>s
                  </button>
                </p>
              </div>

              <button type="submit" class="btn btn--primary btn--full" id="verifyOtpBtn" disabled>
                Verify OTP
              </button>

              <button type="button" class="btn btn--primary btn--full" id="loginBtn" style="display: none">
                Continue to Account
              </button>
            </form>

            <div class="text-center mt-lg">
              <button type="button"
                class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline font-medium flex items-center gap-xs mx-auto"
                id="backToLogin" aria-label="Go back to sign in form">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    d="M8.707 3.293a1 1 0 0 0-1.414 1.414L12.586 10l-5.293 5.293a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0 0-1.414l-6-6z"
                    transform="rotate(180 10 10)" />
                </svg>
                <span>Back</span>
              </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>


  <!-- Scripts -->
  <script>
    class SecureSignInPage {
      constructor() {
        // Configuration constants
        this.config = {
          defaultMethod: "phone",
          resendDelay: 60,
          autoRedirectDelay: 2000,
          phoneMaxLength: 10,
          otpLength: 6,
          endpoints: {
            send: '{{ url("/otp/send") }}',
            verify: '{{ url("/otp/verify") }}',
            resend: '{{ url("/otp/resend") }}'
          }
        };

        // State variables
        this.currentMethod = this.config.defaultMethod;
        this.currentContact = "";
        this.resendTimer = null;
        this.redirectUrl = null;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this.init();
      }

      init() {
        this.cacheElements();
        this.setupCsrfToken();
        this.initializeMethodSelection();
        this.initializeForm();
        this.initializePhoneFormatting();
        this.initializeOtpSection();
      }

      cacheElements() {
        // Cache frequently used DOM elements
        this.elements = {
          // Method selection
          phoneMethodBtn: document.getElementById("phoneMethodBtn"),
          emailMethodBtn: document.getElementById("emailMethodBtn"),

          // Form groups
          phoneGroup: document.getElementById("phoneGroup"),
          emailGroup: document.getElementById("emailGroup"),

          // Inputs
          phoneInput: document.getElementById("phoneNumber"),
          emailInput: document.getElementById("emailAddress"),
          otpInput: document.getElementById("otpInput"),

          // Error elements
          phoneError: document.getElementById("phoneError"),
          emailError: document.getElementById("emailError"),
          otpError: document.getElementById("otpError"),
          otpSuccess: document.getElementById("otpSuccess"),

          // Buttons
          sendOtpBtn: document.getElementById("sendOtpBtn"),
          verifyOtpBtn: document.getElementById("verifyOtpBtn"),
          loginBtn: document.getElementById("loginBtn"),
          resendOtp: document.getElementById("resendOtp"),
          backToLogin: document.getElementById("backToLogin"),

          // Sections
          signInSection: document.getElementById("signInSection"),
          otpVerification: document.getElementById("otpVerification"),
          otpSubtitle: document.getElementById("otpSubtitle"),

          // Forms
          signInForm: document.getElementById("signInForm"),
          otpForm: document.getElementById("otpForm"),

          // Timer
          countdown: document.getElementById("countdown")
        };
      }

      setupCsrfToken() {
        // Set CSRF token for all AJAX requests
        const headers = {
          'X-CSRF-TOKEN': this.csrfToken,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        };

        // Set default headers for fetch
        this.defaultHeaders = headers;
      }

      async makeRequest(url, method = 'POST', data = {}) {
        try {
          const response = await fetch(url, {
            method: method,
            headers: this.defaultHeaders,
            body: JSON.stringify(data)
          });

          const result = await response.json();

          if (!response.ok) {
            throw {
              status: response.status,
              data: result
            };
          }

          return result;
        } catch (error) {
          console.error('Request failed:', error);
          throw error;
        }
      }

      initializeMethodSelection() {
        const phoneBtn = document.getElementById("phoneMethodBtn");
        const emailBtn = document.getElementById("emailMethodBtn");
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");

        phoneBtn.addEventListener("click", () => {
          this.switchMethod(
            "phone",
            phoneBtn,
            emailBtn,
            phoneGroup,
            emailGroup,
            phoneInput,
            emailInput
          );
        });

        emailBtn.addEventListener("click", () => {
          this.switchMethod(
            "email",
            emailBtn,
            phoneBtn,
            emailGroup,
            phoneGroup,
            emailInput,
            phoneInput
          );
        });
      }

      switchMethod(
        method,
        activeBtn,
        inactiveBtn,
        activeGroup,
        inactiveGroup,
        activeInput,
        inactiveInput
      ) {
        this.currentMethod = method;

        // Update button styles using DRY CSS classes
        activeBtn.className = "method-btn method-btn--active";
        activeBtn.setAttribute("aria-pressed", "true");
        inactiveBtn.className = "method-btn method-btn--inactive";
        inactiveBtn.setAttribute("aria-pressed", "false");

        // Update form group visibility for Tailwind
        activeGroup.className = "mb-lg block";
        inactiveGroup.className = "mb-lg hidden";

        activeInput.required = true;
        activeInput.setAttribute("aria-invalid", "false");
        inactiveInput.required = false;
        inactiveInput.value = "";
        inactiveInput.setAttribute("aria-invalid", "false");

        this.clearErrors();
        this.updateSendOtpButtonState();
      }

      initializePhoneFormatting() {
        const phoneInput = document.getElementById("phoneNumber");
        const phoneError = document.getElementById("phoneError");

        phoneInput.addEventListener("input", (e) => {
          const originalValue = e.target.value;
          let cleanValue = originalValue.replace(/\D/g, "");

          // Limit to 10 digits
          if (cleanValue.length > 10) {
            cleanValue = cleanValue.substring(0, 10);
          }

          // Format with space after 5 digits for display
          let formattedValue = cleanValue;
          if (cleanValue.length > 5) {
            formattedValue = cleanValue.replace(/(\d{5})(\d{0,5})/, "$1 $2");
          }

          e.target.value = formattedValue;

          // Validate the phone number using the formatted value (validatePhone handles cleaning)
          this.validatePhone(formattedValue);
          this.updateSendOtpButtonState();
        });

        phoneInput.addEventListener("keypress", (e) => {
          // Allow: backspace, delete, tab, escape, enter, and numeric keys
          if (
            ["Backspace", "Delete", "Tab", "Escape", "Enter"].includes(e.key) ||
            (e.ctrlKey && ["a", "c", "v", "x"].includes(e.key.toLowerCase())) ||
            /^[0-9]$/.test(e.key)
          ) {
            return;
          }

          // Prevent non-numeric input
          e.preventDefault();
        });
      }

      initializeForm() {
        const form = document.getElementById("signInForm");
        const emailInput = document.getElementById("emailAddress");

        emailInput.addEventListener("input", (e) => {
          this.validateEmail(e.target.value);
          this.updateSendOtpButtonState();
        });

        form.addEventListener("submit", (e) => {
          e.preventDefault();
          this.handleSubmit();
        });
      }

      initializeOtpSection() {
        const backBtn = document.getElementById("backToLogin");
        const otpForm = document.getElementById("otpForm");
        const otpInput = document.getElementById("otpInput");
        const resendBtn = document.getElementById("resendOtp");
        const loginBtn = document.getElementById("loginBtn");

        backBtn.addEventListener("click", () => {
          this.showSignInSection();
        });

        otpInput.addEventListener("input", (e) => {
          let value = e.target.value.replace(/\D/g, "");
          e.target.value = value;
          this.validateOtp(value);
        });

        otpInput.addEventListener("keypress", (e) => {
          if (
            !/\d/.test(e.key) &&
            !["Backspace", "Delete", "Tab", "Enter"].includes(e.key)
          ) {
            e.preventDefault();
          }
        });

        otpForm.addEventListener("submit", (e) => {
          e.preventDefault();
          this.verifyOtp();
        });

        resendBtn.addEventListener("click", () => {
          this.resendOtp();
        });

        loginBtn.addEventListener("click", () => {
          this.redirectToAccount();
        });
      }


      validatePhone(phone) {
        const cleanPhone = phone.replace(/\D/g, "");

        if (!phone) {
          this.clearError(this.elements.phoneError);
          return false;
        }

        if (cleanPhone.length < this.config.phoneMaxLength) {
          this.showError(this.elements.phoneError, `Mobile number must be ${this.config.phoneMaxLength} digits`);
          return false;
        }

        if (cleanPhone.length > this.config.phoneMaxLength) {
          this.showError(this.elements.phoneError, `Mobile number cannot exceed ${this.config.phoneMaxLength} digits`);
          return false;
        }

        // Validate Indian mobile number format (must start with 6-9)
        if (!/^[6-9][0-9]{9}$/.test(cleanPhone)) {
          this.showError(this.elements.phoneError, "Please enter a valid Indian mobile number");
          return false;
        }

        this.clearError(this.elements.phoneError);
        return true;
      }

      validateEmail(email) {
        // More comprehensive email regex
        const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

        if (!email) {
          this.clearError(this.elements.emailError);
          return false;
        }

        if (email.length > 254) {
          this.showError(this.elements.emailError, "Email address is too long (max 254 characters)");
          return false;
        }

        if (!emailRegex.test(email)) {
          this.showError(this.elements.emailError, "Please enter a valid email address");
          return false;
        }

        this.clearError(this.elements.emailError);
        return true;
      }

      validateOtp(otp) {
        if (!otp) {
          this.showError(this.elements.otpError, "");
          this.elements.verifyOtpBtn.disabled = true;
          return false;
        }

        if (otp.length < this.config.otpLength) {
          this.showError(this.elements.otpError, `OTP must be ${this.config.otpLength} digits`);
          this.elements.verifyOtpBtn.disabled = true;
          return false;
        }

        const otpPattern = new RegExp(`^\\d{${this.config.otpLength}}$`);
        if (!otpPattern.test(otp)) {
          this.showError(this.elements.otpError, "OTP must contain only numbers");
          this.elements.verifyOtpBtn.disabled = true;
          return false;
        }

        this.clearError(this.elements.otpError);
        this.elements.verifyOtpBtn.disabled = false;
        return true;
      }

      showError(errorElement, message) {
        const messageDiv = errorElement.querySelector('.alert-message');
        if (messageDiv) {
          messageDiv.textContent = message;
        }

        if (message) {
          errorElement.classList.remove('hidden');
          errorElement.classList.add('visible');
        } else {
          errorElement.classList.add('hidden');
          errorElement.classList.remove('visible');
        }

        // Update aria-invalid attribute for associated input
        const inputId = errorElement.id.replace('Error', '').replace('phone', 'phoneNumber').replace('email', 'emailAddress').replace('otp', 'otpInput');
        const input = document.getElementById(inputId);
        if (input) {
          input.setAttribute("aria-invalid", message ? "true" : "false");
        }
      }

      clearError(errorElement) {
        const messageDiv = errorElement.querySelector('.alert-message');
        if (messageDiv) {
          messageDiv.textContent = "";
        }
        errorElement.classList.add('hidden');
        errorElement.classList.remove('visible');

        // Also hide success message if clearing OTP error
        if (errorElement.id === "otpError") {
          const otpSuccess = document.getElementById("otpSuccess");
          if (otpSuccess) {
            otpSuccess.classList.add('hidden');
            otpSuccess.classList.remove('visible');
            const successMessage = otpSuccess.querySelector('.alert-message');
            if (successMessage) {
              successMessage.textContent = "";
            }
          }
        }
      }

      clearErrors() {
        const errors = document.querySelectorAll("[id$='Error']");
        errors.forEach((error) => this.clearError(error));
      }

      getCurrentMethodData() {
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");

        if (phoneGroup.className.includes("block")) {
          return {
            method: 'phone',
            input: phoneInput,
            value: phoneInput.value.trim(),
            errorElement: document.getElementById("phoneError")
          };
        } else {
          return {
            method: 'email',
            input: emailInput,
            value: emailInput.value.trim(),
            errorElement: document.getElementById("emailError")
          };
        }
      }

      updateSendOtpButtonState() {
        const sendOtpBtn = document.getElementById("sendOtpBtn");
        const methodData = this.getCurrentMethodData();

        const isValid = methodData.method === 'phone'
          ? this.validatePhone(methodData.value)
          : this.validateEmail(methodData.value);

        sendOtpBtn.disabled = !isValid;
      }

      async handleSubmit() {
        const methodData = this.getCurrentMethodData();
        const submitBtn = document.getElementById("sendOtpBtn");

        const isValid = methodData.method === 'phone'
          ? this.validatePhone(methodData.value)
          : this.validateEmail(methodData.value);

        if (!isValid) {
          return;
        }

        // Set current contact for OTP verification
        this.currentContact = methodData.method === 'phone'
          ? methodData.value.replace(/\D/g, "")
          : methodData.value;
        this.currentMethod = methodData.method;

        submitBtn.textContent = "Sending...";
        submitBtn.disabled = true;

        try {
          const result = await this.makeRequest('{{ url("/otp/send") }}', 'POST', {
            contact: this.currentContact,
            method: this.currentMethod
          });

          if (result.message) {
            this.showOtpSection();
            // OTP sent successfully - do not log OTP for security
          } else {
            this.showError(methodData.errorElement, result.message);
          }

        } catch (error) {
          const errorMessage = error.data?.message || 'Failed to send OTP. Please try again.';
          this.showError(methodData.errorElement, errorMessage);
        } finally {
          submitBtn.textContent = "Send OTP";
          submitBtn.disabled = false;
        }
      }

      showOtpSection() {
        const signInSection = document.getElementById("signInSection");
        const otpSection = document.getElementById("otpVerification");
        const otpSubtitle = document.getElementById("otpSubtitle");

        const contactDisplay = this.currentMethod === "phone"
          ? this.formatPhoneForDisplay(this.currentContact)
          : this.currentContact;

        otpSubtitle.textContent = `We've sent a 6-digit code to your ${this.currentMethod === "phone" ? "phone number" : "email"} ${contactDisplay}`;

        signInSection.style.display = "none";
        otpSection.style.display = "block";

        this.startResendTimer();
      }

      showSignInSection() {
        const signInSection = document.getElementById("signInSection");
        const otpSection = document.getElementById("otpVerification");
        const otpInput = document.getElementById("otpInput");

        signInSection.style.display = "block";
        otpSection.style.display = "none";
        otpInput.value = "";
        this.clearErrors();

        if (this.resendTimer) {
          clearInterval(this.resendTimer);
        }
      }

      formatPhoneForDisplay(phone) {
        const cleanPhone = phone.replace(/\D/g, "");
        if (cleanPhone.length === 10) {
          return `+91 ${cleanPhone.slice(0, 5)} ${cleanPhone.slice(5)}`;
        }
        return `+91 ${cleanPhone}`;
      }

      startResendTimer() {
        let timeLeft = this.config.resendDelay;

        this.elements.resendOtp.disabled = true;

        this.resendTimer = setInterval(() => {
          timeLeft--;
          this.elements.countdown.textContent = timeLeft;

          if (timeLeft <= 0) {
            clearInterval(this.resendTimer);
            this.elements.resendOtp.disabled = false;
            this.elements.resendOtp.innerHTML = "Resend OTP";
          }
        }, 1000);
      }

      async resendOtp() {
        const otpInput = document.getElementById("otpInput");
        const otpError = document.getElementById("otpError");

        otpInput.value = "";
        this.clearErrors();

        try {
          const result = await this.makeRequest('{{ url("/otp/resend") }}', 'POST', {
            contact: this.currentContact,
            method: this.currentMethod
          });

          if (result.success) {
            this.startResendTimer();
            this.showError(otpError, "New OTP sent successfully!");
            setTimeout(() => {
              this.clearError(otpError);
            }, 3000);

            // OTP resent successfully - do not log OTP for security
          } else {
            this.showError(otpError, result.message);
          }

        } catch (error) {
          const errorMessage = error.data?.message || 'Failed to resend OTP. Please try again.';
          this.showError(otpError, errorMessage);
        }
      }

      async verifyOtp() {
        const otpInput = document.getElementById("otpInput");
        const enteredOtp = otpInput.value.trim();
        const otpError = document.getElementById("otpError");
        const verifyBtn = document.getElementById("verifyOtpBtn");
        const loginBtn = document.getElementById("loginBtn");
        const keepSignedIn = document.getElementById("keepSignedIn").checked;

        if (!this.validateOtp(enteredOtp)) {
          return;
        }

        verifyBtn.textContent = "Verifying...";
        verifyBtn.disabled = true;

        try {
          const result = await this.makeRequest('{{ url("/otp/verify") }}', 'POST', {
            contact: this.currentContact,
            otp_code: enteredOtp,
            method: this.currentMethod,
            keep_signed_in: keepSignedIn
          });

          if (result.success) {
            // Hide error message and show success message
            const otpSuccess = document.getElementById("otpSuccess");

            otpError.classList.add('hidden');
            otpError.classList.remove('visible');

            const successMessage = otpSuccess.querySelector('.alert-message');
            if (successMessage) {
              successMessage.textContent = "✓ OTP verified successfully! Redirecting...";
            }
            otpSuccess.classList.remove('hidden');
            otpSuccess.classList.add('visible');

            verifyBtn.style.display = "none";
            loginBtn.style.display = "block";

            if (this.resendTimer) {
              clearInterval(this.resendTimer);
            }

            // Store redirect URL for auto-redirect
            this.redirectUrl = result.redirect_url;

            // Auto-redirect after configured delay
            setTimeout(() => {
              this.redirectToAccount();
            }, this.config.autoRedirectDelay);
          } else {
            this.showError(otpError, result.message);
            verifyBtn.textContent = "Verify OTP";
            verifyBtn.disabled = false;
          }

        } catch (error) {
          const errorMessage = error.data?.message || 'Verification failed. Please try again.';
          this.showError(otpError, errorMessage);
          verifyBtn.textContent = "Verify OTP";
          verifyBtn.disabled = false;
        }
      }

      redirectToAccount() {
        const loginBtn = document.getElementById("loginBtn");
        loginBtn.textContent = "Redirecting...";
        loginBtn.disabled = true;

        // Check sessionStorage for intended URL
        const sessionIntendedUrl = sessionStorage.getItem('intendedUrl');

        // Use intended URL from: 1) Backend response, 2) sessionStorage, 3) Laravel session, 4) homepage
        const redirectUrl = this.redirectUrl || sessionIntendedUrl || "{{ session('url.intended', route('front.index')) }}";

        // Clear sessionStorage
        if (sessionIntendedUrl) {
          sessionStorage.removeItem('intendedUrl');
        }

        // Validate URL is from same origin (prevent open redirect)
        try {
          const url = new URL(redirectUrl, window.location.origin);
          if (url.origin === window.location.origin) {
            window.location.href = url.href;
          } else {
            // External URL - redirect to homepage for security
            window.location.href = "{{ route('front.index') }}";
          }
        } catch(e) {
          // Invalid URL - redirect to homepage
          window.location.href = "{{ route('front.index') }}";
        }
      }
    }



    document.addEventListener("DOMContentLoaded", () => {
      new SecureSignInPage();
    });
  </script>
</body>

</html>