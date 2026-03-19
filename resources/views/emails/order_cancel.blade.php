<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>{{$subject}}</title>

  <style>
    /* ── Reset ── */
    body,
    table,
    td,
    a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      -ms-interpolation-mode: bicubic;
      border: 0;
      outline: none;
      text-decoration: none;
      display: block;
    }

    /* ── Responsive ── */
    @media only screen and (max-width: 600px) {

      /* Outer wrapper: remove side padding so card goes edge-to-edge */
      .outer-td {
        padding: 0 !important;
      }

      /* Card: full width, no side margin */
      .email-card {
        width: 100% !important;
        max-width: 100% !important;
      }

      /* Header: tighten padding */
      .header-td {
        padding: 20px 24px 18px 24px !important;
      }

      /* Logo image: scale down */
      .logo-img {
        width: 100px !important;
        height: auto !important;
      }

      /* Content area: reduce padding */
      .content-td {
        padding: 28px 24px 24px 24px !important;
      }

      /* Headline: smaller on mobile */
      .headline {
        font-size: 19px !important;
      }

      /* OTP code: slightly smaller on small screens */
      .otp-code {
        font-size: 30px !important;
        letter-spacing: 6px !important;
      }

      /* CTA: full-width button on mobile */
      .cta-table {
        width: 100% !important;
      }

      .cta-td {
        width: 100% !important;
        text-align: center !important;
      }

      .cta-link {
        display: block !important;
        text-align: center !important;
        padding: 16px 24px !important;
      }

      /* Footer: reduce padding */
      .footer-td {
        padding: 20px 24px 24px 24px !important;
      }
    }
  </style>
</head>

<body style="margin: 0; padding: 0; background-color: #F0F0F0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

  <!-- Preview text (hidden) -->
  <div style="display: none; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #F0F0F0;">
    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
  </div>

  <!-- Outer wrapper -->
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
    style="background-color: #F0F0F0;">
    <tr>
      <td class="outer-td" align="center" style="padding: 40px 16px;">

        <!-- Email card -->
        <table role="presentation" class="email-card" width="100%" cellpadding="0" cellspacing="0" border="0"
          style="max-width: 560px; background-color: #ffffff;">

          <!-- ── NAVY TOP ACCENT LINE ── -->
          <tr>
            <td style="background-color: #1C3057; height: 4px; font-size: 0; line-height: 0;">&nbsp;</td>
          </tr>

          <!-- ── HEADER: LOGO ── -->
          <tr>
            <td class="header-td" style="background-color: #ffffff; padding: 28px 40px 24px 40px;
                       border-bottom: 1px solid #EBEBEB;">
              <img class="logo-img"
                src="https://www.celiginglobal.com/assets/img/logo.png"
                alt="Celigin" width="120" height="auto"
                style="width: 120px; height: auto; display: block;" />
            </td>
          </tr>

          <!-- ── MAIN CONTENT ── -->
          <tr>
            <td class="content-td" style="padding: 40px 40px 32px 40px;">

              <!-- Headline -->
              <h1 class="headline" style="margin: 0 0 16px 0; font-size: 22px; font-weight: 700;
                          color: #111111; line-height: 1.3; letter-spacing: -0.2px;">
               Hi, {{$name}} <br>
               {{$headline}}
              </h1>

              <!-- Body copy -->
              <div style="font-size: 15px; line-height: 1.7; color: #555555; margin: 0 0 28px 0;">

              </div>

              <!-- ── OTP BLOCK (remove entire block if not OTP notification) ── -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                style="background-color: #F5F7FA; border-left: 3px solid #1C3057;
                            margin: 0 0 32px 0;">
                <tr>
                  <td style="padding: 22px 28px;">
                    <p style="margin: 0 0 8px 0; font-size: 11px; font-weight: 600;
                               color: #1C3057; text-transform: uppercase; letter-spacing: 1.2px;">
                      <!-- Your one-time code -->
                    </p>
                    <p class="otp-code" style="margin: 0; font-size: 38px; font-weight: 700;
                               color: #1C3057; letter-spacing: 10px;
                               font-variant-numeric: tabular-nums; font-family: 'Courier New', Courier, monospace;">
                 
                    Total:   {{$total}}
                    </p>
                    <p style="margin: 10px 0 0 0; font-size: 12px; color: #888888;">
                   If you didn't request this cancellation, please contact us right away.
                    </p>
                  </td>
                </tr>
              </table>
              <!-- ── END OTP BLOCK ── -->

              <!-- ── CTA BUTTON (remove entire block if no action needed) ── -->
              <table role="presentation" class="cta-table" cellpadding="0" cellspacing="0" border="0"
                style="margin: 0 0 8px 0;">
                <tr>
                  <td class="cta-td" style="background-color: #1C3057;">
                    <a href="{{$cta_url}}" class="cta-link"
                      style="display: inline-block; background-color: #1C3057;
                              color: #ffffff; font-size: 14px; font-weight: 600;
                              text-decoration: none; padding: 14px 32px;
                              letter-spacing: 0.8px; text-transform: uppercase;">
                      {{$cta_label}}
                    </a>
                  </td>
                </tr>
              </table>
              <!-- ── END CTA BUTTON ── -->

            </td>
          </tr>

          <!-- ── FOOTER ── -->
          <tr>
            <td class="footer-td" style="background-color: #F5F7FA; padding: 24px 40px 28px 40px;
                       border-top: 1px solid #EBEBEB;">

              <!-- Optional footer note -->
              <!-- <p style="margin: 0 0 14px 0; font-size: 12px; line-height: 1.6; color: #999999;">
               
              </p> -->

              <!-- Standard footer links -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
                    <p style="margin: 0 0 6px 0; font-size: 12px; color: #BBBBBB;">
                      <a href="https://celiginglobal.com/" style="color: #888888; text-decoration: none;">celigin.com</a>
                      &nbsp;&middot;&nbsp;
                      <a href="https://www.celiginglobal.com/privacy" style="color: #888888; text-decoration: none;">Privacy</a>
                    </p>
                    <p style="margin: 0; font-size: 11px; color: #CCCCCC;">
                      &copy; Celigin. All rights reserved.
                    </p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

        </table>
        <!-- ── END EMAIL CARD ── -->

      </td>
    </tr>
  </table>

</body>

</html>