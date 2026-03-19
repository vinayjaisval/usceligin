<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your CELIGIN Verification Code</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
        .otp-code {
            background-color: #bc4f38;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            letter-spacing: 8px;
            margin: 30px 0;
            font-family: 'Courier New', monospace;
        }
        .content {
            text-align: center;
            margin-bottom: 30px;
        }
        .content h1 {
            color: #bc4f38;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .content p {
            margin-bottom: 15px;
            font-size: 16px;
            line-height: 1.6;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            color: #bc4f38;
            text-decoration: none;
            margin: 0 10px;
        }
        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }
            .otp-code {
                font-size: 24px;
                letter-spacing: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="CELIGIN" class="logo">
        </div>

        <div class="content">
            <h1>Your Verification Code</h1>
            <p>Hello!</p>
            <p>We received a request to sign in to your CELIGIN account. Please use the verification code below to complete your sign-in:</p>

            <div class="otp-code">{{ $otp }}</div>

            <p><strong>This code will expire in 10 minutes.</strong></p>

            <div class="warning">
                <strong>Security Notice:</strong> Never share this code with anyone. CELIGIN will never ask for your verification code via phone, email, or text message.
            </div>

            <p>If you didn't request this code, please ignore this email or contact our support team if you have concerns about your account security.</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing CELIGIN!</p>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">Support</a> |
                <a href="#">Privacy Policy</a>
            </div>
            <p>
                &copy; {{ date('Y') }} CELIGIN Global. All rights reserved.<br>
                This is an automated message, please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>