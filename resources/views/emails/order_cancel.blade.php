<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>{{$subject}}</title>
  
  <style>
    /* ── Reset ── */
    body, table, td, a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }
    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }
    img {
      -ms-interpolation-mode: bicubic;
      border: 0; outline: none; text-decoration: none; display: block;
    }

    /* ── Responsive ── */
    @media only screen and (max-width: 600px) {

      .outer-td   { padding: 0 !important; }

      .email-card { width: 100% !important; max-width: 100% !important; }

      .header-td  { padding: 18px 20px !important; }

      .logo-img   { width: 96px !important; height: auto !important; }

      .content-td { padding: 24px 20px 28px 20px !important; }

      .headline   { font-size: 18px !important; }

      .body-copy  { font-size: 14px !important; }

      /* Order details card — tighten on mobile */
      .od-td { padding: 10px 14px !important; font-size: 12px !important; }

      /* OTP */
      .otp-code   { font-size: 28px !important; letter-spacing: 6px !important; }

      /* CTA */
      .cta-table  { width: 100% !important; }
      .cta-td     { text-align: center !important; }
      .cta-link   { display: block !important; text-align: center !important; padding: 15px 20px !important; }

      .footer-td  { padding: 18px 20px 22px 20px !important; }
    }
  </style>
</head>

<body style="margin:0; padding:0; background-color:#F0F0F0;
             font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

  <!-- Hidden preview text -->
  <div style="display:none; max-height:0; overflow:hidden; font-size:1px; line-height:1px; color:#F0F0F0;">
   &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
  </div>

  <!-- ════════════════════════════════════════
       OUTER WRAPPER
  ════════════════════════════════════════ -->
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
         style="background-color:#F0F0F0;">
    <tr>
      <td class="outer-td" align="center" style="padding:40px 16px;">

        <!-- ══ EMAIL CARD ══ -->
        <table role="presentation" class="email-card" width="100%" cellpadding="0" cellspacing="0" border="0"
               style="max-width:560px; background-color:#ffffff;">

          <!-- Navy top accent -->
          <tr>
            <td style="background-color:#1C3057; height:4px; font-size:0; line-height:0;">&nbsp;</td>
          </tr>

          <!-- ─────────────────────────────────
               HEADER — Logo
          ───────────────────────────────── -->
          <tr>
            <td class="header-td"
                style="background-color:#ffffff; padding:24px 40px 20px 40px; border-bottom:1px solid #EBEBEB;">
              <img class="logo-img"
                   src="https://www.celiginglobal.com/public/assets/images/173312170817321071811721843042celigin-logopngpngpng.png"
                   alt="Celigin" width="120" height="auto"
                   style="width:120px; height:auto; display:block;" />
            </td>
          </tr>

          <!-- ─────────────────────────────────
               MAIN CONTENT
          ───────────────────────────────── -->
          <tr>
            <td class="content-td" style="padding:36px 40px 36px 40px;">

              <!-- Headline -->
              <h1 class="headline"
                  style="margin:0 0 16px 0; font-size:22px; font-weight:700;
                         color:#111111; line-height:1.35; letter-spacing:-0.2px;">
                Hi, {{$name}}
              </h1>

              <!-- Body copy — consistent 16px gap between each block -->
              <div class="body-copy"
                   style="font-size:15px; line-height:1.75; color:#444444; margin:0 0 32px 0;">

                <!-- Plain paragraph -->
                <p style="margin:0 0 16px 0;">  {{$headline}}</p>


              </div>

              <!-- ═══════════════════════════════════════
                   ORDER DETAILS CARD
                   Remove this entire table if not needed
              ════════════════════════════════════════ -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="border-collapse:collapse; border:1px solid #DCDCDC; margin:0 0 32px 0;">

                <!-- Card title -->
                <tr>
                  <td colspan="2"
                      style="padding:16px 20px 14px 20px; border-bottom:1px solid #DCDCDC;">
                    <p style="margin:0; font-size:15px; font-weight:700; color:#111111; line-height:1;">
                      Order Details
                    </p>
                  </td>
                </tr>

                <!-- Order Number -->
                <tr>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             width:38%; font-size:13px; color:#5F6B7A;
                             vertical-align:middle; white-space:nowrap;">
                    Order #
                  </td>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             font-size:13px; font-weight:700; color:#1C3057;
                             vertical-align:middle;">
                  {{$order_id}}
                  </td>
                </tr>
                <tr>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             width:38%; font-size:13px; color:#5F6B7A;
                             vertical-align:middle; white-space:nowrap;">
                    Total #
                  </td>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             font-size:13px; font-weight:700; color:#1C3057;
                             vertical-align:middle;">
                  {{$total}}
                  </td>
                </tr>

                <!-- Order Date -->
                <tr>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             width:38%; font-size:13px; color:#5F6B7A;
                             vertical-align:middle; white-space:nowrap;">
                    Placed on
                  </td>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             font-size:13px; font-weight:500; color:#333333;
                             vertical-align:middle;">
                    {{$order_date}}
                  </td>
                </tr>

                <!-- Status -->
                <tr>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             width:38%; font-size:13px; color:#5F6B7A;
                             vertical-align:middle; white-space:nowrap;">
                    Status
                  </td>
                  <td style="padding:13px 20px; border-bottom:1px solid #EBEBEB;
                             vertical-align:middle;">
                    <span style="display:inline-block; padding:3px 10px;
                                 font-size:11px; font-weight:700; letter-spacing:0.4px;
                                 text-transform:uppercase; background-color:#D1FAE5;
                                 color:#065F46;">
                      {{$status}}
                    </span>
                  </td>
                </tr>

                <!-- Payment -->
                <tr>
                  <td style="padding:13px 20px;
                             width:38%; font-size:13px; color:#5F6B7A;
                             vertical-align:middle; white-space:nowrap;">
                    Payment
                  </td>
                  <td style="padding:13px 20px;
                             font-size:13px; font-weight:500; color:#333333;
                             vertical-align:middle;">
                    {{$payment_method}}
                  </td>
                </tr>

              </table>
                 <p style="margin: 10px 0 0 0; font-size: 12px; color: #888888;">
                     If you didn't request this cancellation, please contact us right away.
                    </p>
             
              <table role="presentation" class="cta-table" width="100%"
                     cellpadding="0" cellspacing="0" border="0"
                     style="margin:0;">
                <tr>
                  <td class="cta-td" align="center"
                      style="background-color:#1C3057;">
                    <a href="{{$cta_url}}" class="cta-link"
                       style="display:block; background-color:#1C3057;
                              color:#ffffff; font-size:14px; font-weight:700;
                              text-decoration:none; padding:16px 40px;
                              letter-spacing:1px; text-transform:uppercase;
                              text-align:center;">
                  {{$cta_label}}
                    </a>
                  </td>
                </tr>
              </table>
              <!-- ── END CTA BUTTON ── -->

            </td>
          </tr>

          <!-- ─────────────────────────────────
               FOOTER
          ───────────────────────────────── -->
          <tr>
            <td class="footer-td"
                style="background-color:#F5F7FA; padding:20px 40px 24px 40px;
                       border-top:1px solid #EBEBEB;">

             
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
                    <p style="margin:0 0 6px 0; font-size:12px; line-height:1.5;">
                      <a href="https://celiginglobal.com/"
                         style="color:#555555; text-decoration:none;">celigin.com</a>
                      &nbsp;&middot;&nbsp;
                      <a href="https://www.celiginglobal.com/privacy"
                         style="color:#555555; text-decoration:none;">Privacy</a>
                    </p>
                    <p style="margin:0; font-size:11px; color:#5F6B7A; line-height:1.5;">
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
