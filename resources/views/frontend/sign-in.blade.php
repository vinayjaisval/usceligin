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

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.ico')}}" />
</head>

<body>
  <!-- Skip Links for Accessibility -->
  <a href="#signin-heading" class="skip-link">Skip to main content</a>

  <!-- Header Navigation -->
  <header class="flex items-center min-h-16 px-md py-md" role="banner">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl">
      <nav class="header-content" aria-label="Main navigation">
        <div class="justify-self-start">
          <a href="{{url('/')}}"
            class="text-accent-primary hover:text-accent-dark font-medium transition-colors duration-fast flex items-center gap-xs no-underline hover:underline"
            aria-label="Go back to CELIGIN homepage">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path
                d="M8.707 3.293a1 1 0 0 0-1.414 1.414L12.586 10l-5.293 5.293a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0 0-1.414l-6-6z"
                transform="rotate(180 10 10)" />
            </svg>
            <span>Go Back</span>
          </a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="min-h-[calc(100vh-8rem)] flex items-center justify-center px-0 py-xl bg-bg-quaternary" role="main">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl">
      <div class="w-full max-w-[30rem] mx-auto">
        <article class="bg-bg-primary rounded-none shadow-medium px-3xl py-3xl text-center">
          <!-- Brand Logo -->
          <header class="mb-xl">
            <img src="{{ asset('assets/images/' . ($gs->logo ?? 'logo.png')) }}"
              alt="CELIGIN - Premium Beauty & Skincare" class="mx-auto h-10 max-w-[7.5rem] object-contain" width="120"
              height="40" />
          </header>

          <!-- Sign In Section -->
          <section class="sign-in-section" id="signInSection" aria-labelledby="signin-heading">
            <!-- Authentication Method Selection -->
            <div class="mb-lg" id="methodSelection">
              <h1 class="text-2xl font-semibold text-text-primary mb-lg" id="signin-heading">Sign In with OTP</h1>
              <fieldset class="flex gap-0 mb-lg" aria-label="Choose verification method">
                <legend class="sr-only">Select your preferred verification method</legend>
                <button type="button"
                  class="flex-1 px-lg py-sm bg-accent-primary text-white border border-accent-primary rounded-none font-medium cursor-pointer transition-all duration-fast hover:bg-accent-dark active"
                  id="phoneMethodBtn" data-method="phone" aria-pressed="true" aria-describedby="phone-help">
                  <span>Phone Number</span>
                </button>
                <button type="button"
                  class="flex-1 px-lg py-sm bg-bg-tertiary text-text-secondary border border-border-medium rounded-none font-medium cursor-pointer transition-all duration-fast hover:bg-bg-secondary hover:text-white"
                  id="emailMethodBtn" data-method="email" aria-pressed="false" aria-describedby="email-help">
                  <span>Email Address</span>
                </button>
              </fieldset>
            </div>

            <!-- Authentication Form -->
            <form class="text-left" id="signInForm" novalidate aria-labelledby="signin-heading">
              @csrf
              <!-- Phone Input (default) -->
              <div class="mb-lg block" id="phoneGroup">
                <label for="phoneNumber" class="block text-sm font-medium text-text-primary mb-xs">
                  Mobile Number<span class="text-danger ml-1" aria-label="required">*</span>
                </label>
                <div
                  class="relative flex items-center border border-border-medium rounded-none overflow-hidden focus-within:border-accent-primary focus-within:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)]">
                  <span
                    class="bg-bg-tertiary text-text-secondary px-sm py-sm text-sm font-medium border-r border-border-medium flex-shrink-0"
                    aria-label="Country code India">+91</span>
                  <input type="tel" id="phoneNumber" name="contact"
                    class="flex-1 px-md py-sm border-0 text-base text-text-primary bg-bg-primary outline-none placeholder:text-text-tertiary"
                    placeholder="12345 67890" maxlength="11" required autocomplete="tel"
                    aria-describedby="phoneHelp phoneError" aria-invalid="false" />
                </div>
                <p class="text-sm text-text-tertiary mt-xs" id="phoneHelp">
                  We'll send a secure OTP to your mobile number for verification.
                </p>
                <div class="alert alert-error hidden mt-xs" id="phoneError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
              </div>

              <!-- Email Input (hidden by default) -->
              <div class="mb-lg hidden" id="emailGroup">
                <label for="emailAddress" class="block text-sm font-medium text-text-primary mb-xs">
                  Email Address<span class="text-danger ml-1" aria-label="required">*</span>
                </label>
                <input type="email" id="emailAddress" name="contact"
                  class="w-full px-md py-sm border border-border-medium rounded-none text-base text-text-primary bg-bg-primary transition-all duration-fast focus:outline-none focus:border-accent-primary focus:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)] placeholder:text-text-tertiary"
                  placeholder="your@email.com" autocomplete="email" aria-describedby="emailHelp emailError"
                  aria-invalid="false" />
                <p class="text-sm text-text-tertiary mt-xs" id="emailHelp">
                  We'll send a secure OTP to your email address for verification.
                </p>
                <div class="alert alert-error hidden mt-xs" id="emailError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
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
                         class="mt-1 h-4 w-4 text-accent-primary border-border-medium rounded-none focus:ring-accent-primary focus:ring-2">
                  <div class="flex items-center gap-2">
                    <label for="keepSignedIn" class="text-sm text-text-primary cursor-pointer">
                      Keep me signed in
                    </label>
                    <div class="tooltip-wrapper">
                      <button type="button" class="tooltip-trigger info-btn" aria-label="Information about staying signed in">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                          <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <div class="tooltip-content">
                          Stay signed in to save time on future visits. We'll remember your preferences and keep you logged in for up to 30 days. You can always sign out manually for security.
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit"
                class="w-full mb-xl bg-accent-primary text-white border border-accent-primary px-6 py-3 font-medium cursor-pointer transition-all duration-fast hover:bg-accent-dark hover:-translate-y-0.5 hover:shadow-medium disabled:bg-grey-medium disabled:border-grey-medium disabled:text-white disabled:cursor-not-allowed"
                id="sendOtpBtn" disabled>
                Send OTP
              </button>

              <!-- Terms and Privacy -->
              <div class="text-center text-sm text-text-tertiary">
                <p>
                  By signing in, you agree to our
                  <a href="#"
                    class="text-accent-primary hover:text-accent-dark underline transition-colors duration-fast">Terms
                    and Conditions</a>
                  and that you've read our
                  <a href="#"
                    class="text-accent-primary hover:text-accent-dark underline transition-colors duration-fast">Privacy
                    Policy</a>.
                </p>
              </div>
            </form>
          </section>

          <!-- OTP Verification Section (hidden by default) -->
          <section class="text-left" id="otpVerification" style="display: none" aria-labelledby="otp-heading"
            aria-live="polite">
            <header class="mb-lg">
              <h2 class="text-2xl font-semibold text-text-primary text-center" id="otp-heading">Enter Verification Code
              </h2>
            </header>

            <p class="text-sm text-text-secondary text-center mb-lg" id="otpSubtitle">
              We've sent a 6-digit code to your contact
            </p>

            <form class="text-left" id="otpForm" novalidate aria-labelledby="otp-heading">
              @csrf
              <div class="mb-lg">
                <label for="otpInput" class="block text-sm font-medium text-text-primary mb-xs">
                  6-Digit Verification Code<span class="text-danger ml-1" aria-label="required">*</span>
                </label>
                <input type="text" id="otpInput" name="otp_code"
                  class="w-full px-md py-sm border border-border-medium rounded-none text-base text-text-primary bg-bg-primary transition-all duration-fast focus:outline-none focus:border-accent-primary focus:shadow-[0_0_0_0.125rem_rgba(188,79,56,0.1)] placeholder:text-text-tertiary text-center text-2xl tracking-widest font-mono"
                  placeholder="000000" maxlength="6" required autocomplete="one-time-code" inputmode="numeric"
                  pattern="[0-9]{6}" aria-describedby="otpSubtitle otpError" aria-invalid="false" />
                <div class="alert alert-error hidden mt-xs" id="otpError" role="alert" aria-live="assertive">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
                <div class="alert alert-success hidden mt-xs" id="otpSuccess" role="alert" aria-live="polite">
                  <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                  </svg>
                  <div class="alert-content">
                    <div class="alert-message"></div>
                  </div>
                </div>
              </div>

              <div class="text-center text-sm text-text-secondary mb-lg" id="otpTimer">
                <p>
                  Didn't receive the code?
                  <button type="button"
                    class="text-accent-primary hover:text-accent-dark underline font-medium disabled:text-text-tertiary disabled:no-underline disabled:cursor-not-allowed"
                    id="resendOtp" disabled>
                    Resend OTP in <span id="countdown">60</span>s
                  </button>
                </p>
              </div>

              <button type="submit"
                class="w-full mb-xl bg-accent-primary text-white border border-accent-primary px-6 py-3 font-medium cursor-pointer transition-all duration-fast hover:bg-accent-dark hover:-translate-y-0.5 hover:shadow-medium disabled:bg-grey-medium disabled:border-grey-medium disabled:text-white disabled:cursor-not-allowed"
                id="verifyOtpBtn" disabled>
                Verify OTP
              </button>

              <button type="button"
                class="w-full mb-xl bg-accent-primary text-white border border-accent-primary px-6 py-3 font-medium cursor-pointer transition-all duration-fast hover:bg-accent-dark hover:-translate-y-0.5 hover:shadow-medium"
                id="loginBtn" style="display: none">
                Continue to Account
              </button>
            </form>

            <div class="text-center mt-lg">
              <button type="button"
                class="text-accent-primary hover:text-accent-dark underline font-medium flex items-center gap-xs mx-auto"
                id="backToLogin" aria-label="Go back to sign in form">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    d="M8.707 3.293a1 1 0 0 0-1.414 1.414L12.586 10l-5.293 5.293a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0 0-1.414l-6-6z"
                    transform="rotate(180 10 10)" />
                </svg>
                <span>Back</span>
              </button>
            </div>
          </section>
        </article>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-left flex items-center justify-center min-h-16 mb-0" role="contentinfo">
    <div class="w-full max-w-container-2xl mx-auto px-md lg:px-lg xl:px-xl">
      <div class="text-left flex items-center justify-center min-h-16 mb-0">
        <p class="text-text-secondary text-sm mb-0">&copy; 2024 CELIGIN Global. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    class SecureSignInPage {
      constructor() {
        this.currentMethod = "phone";
        this.currentContact = "";
        this.resendTimer = null;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.init();
      }

      init() {
        this.setupCsrfToken();
        this.initializeMethodSelection();
        this.initializeForm();
        this.initializePhoneFormatting();
        this.initializeOtpSection();
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

        // Update button styles for Tailwind
        activeBtn.className = "flex-1 px-lg py-sm bg-accent-primary text-white border border-accent-primary rounded-none font-medium cursor-pointer transition-all duration-fast hover:bg-accent-dark active";
        activeBtn.setAttribute("aria-pressed", "true");
        inactiveBtn.className = "flex-1 px-lg py-sm bg-bg-tertiary text-text-secondary border border-border-medium rounded-none font-medium cursor-pointer transition-all duration-fast hover:bg-bg-secondary hover:text-white";
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
          let value = originalValue.replace(/\D/g, "");

          if (originalValue !== value && originalValue.length > 0) {
            this.showError(phoneError, "Please enter only numbers (0-9) for your mobile number");
            setTimeout(() => {
              if (phoneError.textContent === "Please enter only numbers (0-9) for your mobile number") {
                this.clearError(phoneError);
                this.validatePhone(e.target.value);
              }
            }, 3000);
          }

          if (value.length > 5) {
            value = value.replace(/(\d{5})(\d{0,5})/, "$1 $2");
          }

          e.target.value = value;

          if (phoneError.textContent !== "Please enter only numbers (0-9) for your mobile number") {
            this.validatePhone(value);
          }

          this.updateSendOtpButtonState();
        });

        phoneInput.addEventListener("keypress", (e) => {
          if (
            ["Backspace", "Delete", "Tab", "Escape", "Enter"].includes(e.key) ||
            (e.ctrlKey && ["a", "c", "v", "x"].includes(e.key.toLowerCase())) ||
            /^[0-9]$/.test(e.key)
          ) {
            return;
          }

          e.preventDefault();
          this.showError(phoneError, "Only numbers (0-9) are allowed for mobile number");

          setTimeout(() => {
            if (phoneError.textContent === "Only numbers (0-9) are allowed for mobile number") {
              this.clearError(phoneError);
              this.validatePhone(phoneInput.value);
            }
          }, 2000);
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
        const phoneError = document.getElementById("phoneError");
        const cleanPhone = phone.replace(/\D/g, "");

        if (!phone) {
          this.showError(phoneError, "");
          return false;
        }

        if (cleanPhone.length < 10) {
          this.showError(phoneError, "Mobile number must be 10 digits");
          return false;
        }

        if (cleanPhone.length > 10) {
          this.showError(phoneError, "Mobile number cannot exceed 10 digits");
          return false;
        }

        if (!/^[6-9]/.test(cleanPhone)) {
          this.showError(phoneError, "Please enter a valid mobile number");
          return false;
        }

        this.clearError(phoneError);
        return true;
      }

      validateEmail(email) {
        const emailError = document.getElementById("emailError");
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!email) {
          this.showError(emailError, "");
          return false;
        }

        if (email.length > 254) {
          this.showError(emailError, "Email address is too long");
          return false;
        }

        if (!emailRegex.test(email)) {
          this.showError(emailError, "Please enter a valid email address");
          return false;
        }

        this.clearError(emailError);
        return true;
      }

      validateOtp(otp) {
        const otpError = document.getElementById("otpError");
        const verifyBtn = document.getElementById("verifyOtpBtn");

        if (!otp) {
          this.showError(otpError, "");
          verifyBtn.disabled = true;
          return false;
        }

        if (otp.length < 6) {
          this.showError(otpError, "OTP must be 6 digits");
          verifyBtn.disabled = true;
          return false;
        }

        if (!/^\d{6}$/.test(otp)) {
          this.showError(otpError, "OTP must contain only numbers");
          verifyBtn.disabled = true;
          return false;
        }

        this.clearError(otpError);
        verifyBtn.disabled = false;
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

        const inputId = errorElement.id.replace('Error', '');
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

      updateSendOtpButtonState() {
        const sendOtpBtn = document.getElementById("sendOtpBtn");
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");

        let isValid = false;

        if (phoneGroup.className.includes("block")) {
          const phoneValue = phoneInput.value.trim();
          isValid = this.validatePhone(phoneValue);
        } else if (emailGroup.className.includes("block")) {
          const emailValue = emailInput.value.trim();
          isValid = this.validateEmail(emailValue);
        }

        sendOtpBtn.disabled = !isValid;
      }

      async handleSubmit() {
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");
        const submitBtn = document.getElementById("sendOtpBtn");

        let isValid = false;
        let contactValue = "";

        if (phoneGroup.className.includes("block")) {
          contactValue = phoneInput.value.trim();
          isValid = this.validatePhone(contactValue);
          this.currentContact = contactValue.replace(/\D/g, "");
        } else {
          contactValue = emailInput.value.trim();
          isValid = this.validateEmail(contactValue);
          this.currentContact = contactValue;
        }

        if (!isValid) {
          return;
        }

        submitBtn.textContent = "Sending...";
        submitBtn.disabled = true;

        try {
          const result = await this.makeRequest('/otp/send', 'POST', {
            contact: this.currentContact,
            method: this.currentMethod
          });

          if (result.success) {
            this.showOtpSection();
            if (result.development_otp) {
              console.log('Development OTP:', result.development_otp);
            }
          } else {
            this.showError(
              this.currentMethod === 'phone'
                ? document.getElementById("phoneError")
                : document.getElementById("emailError"),
              result.message
            );
          }

        } catch (error) {
          const errorMessage = error.data?.message || 'Failed to send OTP. Please try again.';
          this.showError(
            this.currentMethod === 'phone'
              ? document.getElementById("phoneError")
              : document.getElementById("emailError"),
            errorMessage
          );
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
        const resendBtn = document.getElementById("resendOtp");
        const countdown = document.getElementById("countdown");
        let timeLeft = 60;

        resendBtn.disabled = true;

        this.resendTimer = setInterval(() => {
          timeLeft--;
          countdown.textContent = timeLeft;

          if (timeLeft <= 0) {
            clearInterval(this.resendTimer);
            resendBtn.disabled = false;
            resendBtn.innerHTML = "Resend OTP";
          }
        }, 1000);
      }

      async resendOtp() {
        const otpInput = document.getElementById("otpInput");
        const otpError = document.getElementById("otpError");

        otpInput.value = "";
        this.clearErrors();

        try {
          const result = await this.makeRequest('/otp/resend', 'POST', {
            contact: this.currentContact,
            method: this.currentMethod
          });

          if (result.success) {
            this.startResendTimer();
            this.showError(otpError, "New OTP sent successfully!");
            setTimeout(() => {
              this.clearError(otpError);
            }, 3000);

            if (result.development_otp) {
              console.log('New Development OTP:', result.development_otp);
            }
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
          const result = await this.makeRequest('/otp/verify', 'POST', {
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
              successMessage.textContent = "✓ OTP verified successfully!";
            }
            otpSuccess.classList.remove('hidden');
            otpSuccess.classList.add('visible');

            console.log("Success message displayed");
            verifyBtn.style.display = "none";
            loginBtn.style.display = "block";

            if (this.resendTimer) {
              clearInterval(this.resendTimer);
            }

            // Store redirect URL for login button
            this.redirectUrl = result.redirect_url;
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

        setTimeout(() => {
          window.location.href = this.redirectUrl || '/';
        }, 1500);
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      new SecureSignInPage();
    });
  </script>
</body>

</html>