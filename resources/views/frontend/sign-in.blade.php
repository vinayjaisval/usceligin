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
  <title>Secure Sign In | CELIGIN - Premium Beauty & Skincare</title>

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/styles.css')}}" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.ico')}}" />
</head>

<body>
  <!-- Skip Links for Accessibility -->
  <a href="#signin-heading" class="skip-link">Skip to main content</a>

  <!-- Header Navigation -->
  <header class="header" role="banner">
    <div class="container">
      <nav class="header-content" aria-label="Main navigation">
        <div class="header-actions">
          <a href="{{url('/')}}" class="btn btn-text" aria-label="Go back to CELIGIN homepage">
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
  <main class="sign-in-main" role="main">
    <div class="container">
      <div class="sign-in-container">
        <article class="sign-in-card">
          <!-- Brand Logo -->
          <header class="sign-in-logo">
            <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="CELIGIN - Premium Beauty & Skincare"
              class="sign-in-logo-img" width="120" height="40" />
          </header>

          <!-- Sign In Section -->
          <section class="sign-in-section" id="signInSection" aria-labelledby="signin-heading">
            <!-- Authentication Method Selection -->
            <div class="otp-method-selection" id="methodSelection">
              <h1 class="method-title" id="signin-heading">Sign In with OTP</h1>
              <fieldset class="method-buttons" aria-label="Choose verification method">
                <legend class="sr-only">Select your preferred verification method</legend>
                <button type="button" class="btn btn-method active" id="phoneMethodBtn" data-method="phone"
                  aria-pressed="true" aria-describedby="phone-help">
                  <span>Phone Number</span>
                </button>
                <button type="button" class="btn btn-method" id="emailMethodBtn" data-method="email"
                  aria-pressed="false" aria-describedby="email-help">
                  <span>Email Address</span>
                </button>
              </fieldset>
            </div>

            <!-- Authentication Form -->
            <form class="sign-in-form" id="signInForm" novalidate aria-labelledby="signin-heading">
              <!-- Phone Input (default) -->
              <div class="form-group phone-group active" id="phoneGroup">
                <label for="phoneNumber" class="form-label">
                  Mobile Number<span class="required" aria-label="required">*</span>
                </label>
                <div class="phone-input-wrapper">
                  <span class="country-code" aria-label="Country code India">+91</span>
                  <input type="tel" id="phoneNumber" name="phoneNumber" class="form-input phone-input"
                    placeholder="12345 67890" maxlength="11" required autocomplete="tel"
                    aria-describedby="phoneHelp phoneError" aria-invalid="false" />
                </div>
                <p class="form-help" id="phoneHelp">
                  We'll send a secure OTP to your mobile number for verification.
                </p>
                <div class="error-message" id="phoneError" role="alert" aria-live="polite"></div>
              </div>

              <!-- Email Input (hidden by default) -->
              <div class="form-group email-group" id="emailGroup">
                <label for="emailAddress" class="form-label">
                  Email Address<span class="required" aria-label="required">*</span>
                </label>
                <input type="email" id="emailAddress" name="emailAddress" class="form-input"
                  placeholder="your@email.com" autocomplete="email" aria-describedby="emailHelp emailError"
                  aria-invalid="false" />
                <p class="form-help" id="emailHelp">
                  We'll send a secure OTP to your email address for verification.
                </p>
                <div class="error-message" id="emailError" role="alert" aria-live="polite"></div>
              </div>

              <!-- Keep me signed in -->
              <div class="form-group checkbox-group">
                <label class="checkbox-label">
                  <input type="checkbox" id="keepSignedIn" name="keepSignedIn" class="checkbox-input" />
                  <span class="checkbox-custom"></span>
                  <span class="checkbox-text">Keep me signed in</span>
                  <div class="info-btn-wrapper">
                    <button type="button" class="info-btn" aria-label="Information about staying signed in">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                          d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                    </button>
                    <div class="tooltip" id="keepSignedInTooltip">
                      Stay signed in to save time on future visits. We'll
                      remember your preferences and keep you logged in for up
                      to 30 days. You can always sign out manually for
                      security.
                    </div>
                  </div>
                </label>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-accent-primary btn-full" id="sendOtpBtn" disabled>
                Send OTP
              </button>

              <!-- Terms and Privacy -->
              <div class="terms-text">
                <p>
                  By sign in, you agree to our
                  <a href="#" class="link">Terms and Conditions</a>
                  and that you've read our
                  <a href="#" class="link">Privacy Policy</a>.
                </p>
              </div>
            </form>
          </section>

          <!-- OTP Verification Section (hidden by default) -->
          <section class="otp-verification" id="otpVerification" style="display: none" aria-labelledby="otp-heading"
            aria-live="polite">
            <header class="otp-header">
              <h2 class="otp-title" id="otp-heading">Enter Verification Code</h2>
            </header>

            <p class="otp-subtitle" id="otpSubtitle">
              We've sent a 6-digit code to your phone number
            </p>

            <form class="otp-form" id="otpForm" novalidate aria-labelledby="otp-heading">
              <div class="form-group">
                <label for="otpInput" class="form-label">
                  6-Digit Verification Code<span class="required" aria-label="required">*</span>
                </label>
                <input type="text" id="otpInput" name="otpInput" class="form-input otp-input" placeholder="000000"
                  maxlength="6" required autocomplete="one-time-code" inputmode="numeric" pattern="[0-9]{6}"
                  aria-describedby="otpSubtitle otpError" aria-invalid="false" />
                <div class="error-message" id="otpError" role="alert" aria-live="polite"></div>
              </div>

              <div class="otp-timer" id="otpTimer">
                <p>
                  Didn't receive the code?
                  <button type="button" class="resend-btn" id="resendOtp" disabled>
                    Resend OTP in <span id="countdown">60</span>s
                  </button>
                </p>
              </div>

              <button type="submit" class="btn btn-accent-primary btn-full" id="verifyOtpBtn" disabled>
                Verify OTP
              </button>

              <button type="button" class="btn btn-accent-primary btn-full" id="loginBtn" style="display: none">
                Login
              </button>
            </form>

            <div class="otp-back"><button type="button" class="link" id="backToLogin" aria-label="Go back to sign in form">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    d="M8.707 3.293a1 1 0 0 0-1.414 1.414L12.586 10l-5.293 5.293a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0 0-1.414l-6-6z"
                    transform="rotate(180 10 10)" />
                </svg>
                <span>Back</span>
              </button></div>
          </section>
        </article>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="footer-content">
        <p>&copy; 2024 CELIGIN Global. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    class SignInPage {
      constructor() {
        this.generatedOtp = "";
        this.currentMethod = "phone";
        this.currentContact = "";
        this.resendTimer = null;
        this.init();
      }

      init() {
        this.initializeMethodSelection();
        this.initializeForm();
        this.initializePhoneFormatting();
        this.initializeOtpSection();
        this.initializeTooltips();
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

        activeBtn.classList.add("active");
        activeBtn.setAttribute("aria-pressed", "true");
        inactiveBtn.classList.remove("active");
        inactiveBtn.setAttribute("aria-pressed", "false");

        activeGroup.classList.add("active");
        inactiveGroup.classList.remove("active");

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

          // Check if user tried to enter non-numeric characters
          if (originalValue !== value && originalValue.length > 0) {
            this.showError(phoneError, "Please enter only numbers (0-9) for your mobile number");
            // Clear the error after 3 seconds
            setTimeout(() => {
              if (phoneError.textContent === "Please enter only numbers (0-9) for your mobile number") {
                this.clearError(phoneError);
                this.validatePhone(e.target.value);
              }
            }, 3000);
          }

          // Format as 12345 67890 (mobile format)
          if (value.length > 5) {
            value = value.replace(/(\d{5})(\d{0,5})/, "$1 $2");
          }

          e.target.value = value;

          // Only validate if no character error is showing
          if (phoneError.textContent !== "Please enter only numbers (0-9) for your mobile number") {
            this.validatePhone(value);
          }

          this.updateSendOtpButtonState();
        });

        phoneInput.addEventListener("keypress", (e) => {
          // Allow: backspace, delete, tab, escape, enter, and numbers
          if (
            ["Backspace", "Delete", "Tab", "Escape", "Enter"].includes(e.key) ||
            // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
            (e.ctrlKey && ["a", "c", "v", "x"].includes(e.key.toLowerCase())) ||
            // Allow numbers 0-9
            /^[0-9]$/.test(e.key)
          ) {
            return;
          }

          // Show immediate feedback for invalid characters
          e.preventDefault();
          this.showError(phoneError, "Only numbers (0-9) are allowed for mobile number");

          // Clear the error after 2 seconds
          setTimeout(() => {
            if (phoneError.textContent === "Only numbers (0-9) are allowed for mobile number") {
              this.clearError(phoneError);
              this.validatePhone(phoneInput.value);
            }
          }, 2000);
        });

        // Handle paste events
        phoneInput.addEventListener("paste", (e) => {
          setTimeout(() => {
            const value = e.target.value;
            const numbersOnly = value.replace(/\D/g, "");

            if (value !== numbersOnly && value.length > 0) {
              this.showError(phoneError, "Pasted content contains invalid characters. Only numbers are allowed");

              // Format and set the cleaned value
              let formattedValue = numbersOnly;
              if (formattedValue.length > 5) {
                formattedValue = formattedValue.replace(/(\d{5})(\d{0,5})/, "$1 $2");
              }
              e.target.value = formattedValue;

              setTimeout(() => {
                if (phoneError.textContent === "Pasted content contains invalid characters. Only numbers are allowed") {
                  this.clearError(phoneError);
                  this.validatePhone(formattedValue);
                }
              }, 3000);
            }
          }, 10);
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

      initializeTooltips() {
        const infoBtn = document.querySelector(".info-btn");
        const tooltip = document.getElementById("keepSignedInTooltip");

        infoBtn.addEventListener("mouseenter", () => {
          tooltip.style.display = "block";
        });

        infoBtn.addEventListener("mouseleave", () => {
          tooltip.style.display = "none";
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

        if (!/^\d{10}$/.test(cleanPhone)) {
          this.showError(
            phoneError,
            "Mobile number must contain only numbers"
          );
          return false;
        }

        // Check if it's a valid mobile number (starts with 6, 7, 8, or 9)
        if (!/^[6-9]/.test(cleanPhone)) {
          this.showError(
            phoneError,
            "Please enter a valid mobile number"
          );
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

        const parts = email.split("@");
        if (parts[0].length > 64) {
          this.showError(emailError, "Email local part is too long");
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
        errorElement.textContent = message;
        errorElement.style.display = message ? "block" : "none";

        // Update aria-invalid state for associated input
        const inputId = errorElement.id.replace('Error', '');
        const input = document.getElementById(inputId);
        if (input) {
          input.setAttribute("aria-invalid", message ? "true" : "false");
        }
      }

      clearError(errorElement) {
        errorElement.textContent = "";
        errorElement.style.display = "none";
      }

      clearErrors() {
        const errors = document.querySelectorAll(".error-message");
        errors.forEach((error) => this.clearError(error));
      }

      updateSendOtpButtonState() {
        const sendOtpBtn = document.getElementById("sendOtpBtn");
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");

        let isValid = false;

        if (phoneGroup.classList.contains("active")) {
          const phoneValue = phoneInput.value.trim();
          isValid = this.validatePhone(phoneValue);
        } else if (emailGroup.classList.contains("active")) {
          const emailValue = emailInput.value.trim();
          isValid = this.validateEmail(emailValue);
        }

        sendOtpBtn.disabled = !isValid;
      }

      handleSubmit() {
        const phoneGroup = document.getElementById("phoneGroup");
        const emailGroup = document.getElementById("emailGroup");
        const phoneInput = document.getElementById("phoneNumber");
        const emailInput = document.getElementById("emailAddress");
        const submitBtn = document.getElementById("sendOtpBtn");

        let isValid = false;
        let contactValue = "";

        if (phoneGroup.classList.contains("active")) {
          contactValue = phoneInput.value.trim();
          isValid = this.validatePhone(contactValue);
          this.currentContact = contactValue.replace(/\D/g, "");
        } else {
          contactValue = emailInput.value.trim();
          isValid = this.validateEmail(contactValue);
          this.currentContact = contactValue;
        }

        console.log("Form submission:", {
          contactValue,
          isValid,
          currentMethod: this.currentMethod,
        });

        if (!isValid) {
          console.log("Validation failed, stopping submission");
          return;
        }

        submitBtn.textContent = "Sending...";
        submitBtn.disabled = true;

        this.generatedOtp = this.generateOtp();
        console.log("Generated OTP:", this.generatedOtp); // For testing purposes

        setTimeout(() => {
          console.log("About to show OTP section");
          this.showOtpSection();
          submitBtn.textContent = "Send OTP";
          submitBtn.disabled = false;
        }, 2000);
      }

      generateOtp() {
        return Math.floor(100000 + Math.random() * 900000).toString();
      }

      showOtpSection() {
        console.log("showOtpSection called");
        const signInSection = document.getElementById("signInSection");
        const otpSection = document.getElementById("otpVerification");
        const otpSubtitle = document.getElementById("otpSubtitle");

        console.log("Elements found:", {
          signInSection,
          otpSection,
          otpSubtitle,
        });

        const contactDisplay =
          this.currentMethod === "phone"
            ? this.formatPhoneForDisplay(this.currentContact)
            : this.currentContact;

        console.log("Contact display:", contactDisplay);

        otpSubtitle.textContent = `We've sent a 6-digit code to your ${this.currentMethod === "phone" ? "phone number" : "email"
          } ${contactDisplay}`;

        signInSection.style.display = "none";
        otpSection.style.display = "block";

        console.log("OTP section should now be visible");

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

      resendOtp() {
        this.generatedOtp = this.generateOtp();
        console.log("New OTP:", this.generatedOtp); // For testing purposes

        const otpInput = document.getElementById("otpInput");
        otpInput.value = "";
        this.clearErrors();

        this.startResendTimer();

        // Show success message
        const otpError = document.getElementById("otpError");
        this.showError(otpError, "New OTP sent successfully!");
        setTimeout(() => {
          this.clearError(otpError);
        }, 3000);
      }

      verifyOtp() {
        const otpInput = document.getElementById("otpInput");
        const enteredOtp = otpInput.value.trim();
        const otpError = document.getElementById("otpError");
        const verifyBtn = document.getElementById("verifyOtpBtn");
        const loginBtn = document.getElementById("loginBtn");

        if (!this.validateOtp(enteredOtp)) {
          return;
        }

        verifyBtn.textContent = "Verifying...";
        verifyBtn.disabled = true;

        setTimeout(() => {
          if (enteredOtp === this.generatedOtp) {
            this.showError(otpError, "✓ OTP verified successfully!");
            otpError.style.color = "#4e7661";
            verifyBtn.style.display = "none";
            loginBtn.style.display = "block";

            if (this.resendTimer) {
              clearInterval(this.resendTimer);
            }
          } else {
            this.showError(otpError, "Invalid OTP. Please try again.");
            verifyBtn.textContent = "Verify OTP";
            verifyBtn.disabled = false;
          }
        }, 1500);
      }

      redirectToAccount() {
        const loginBtn = document.getElementById("loginBtn");
        loginBtn.textContent = "Redirecting...";
        loginBtn.disabled = true;

        setTimeout(() => {
          // In a real application, you would redirect to the actual account page
          alert("Login successful! Redirecting to My Account page...");
          // window.location.href = 'myaccount.html';
        }, 1500);
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      new SignInPage();
    });
  </script>
</body>

</html>