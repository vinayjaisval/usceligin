# Celigin — SMS & Email Notification Templates

> **SMS Rule**: Max 60 characters. Variables in `{curly_braces}`.
> **Tone**: Human, warm, brief. No jargon.
> **Brand in every SMS**: Every message must contain "Celigin" — either in the text body or as `-Celigin` sign-off at the end.

---

## Variables Reference

| Variable | Description |
|---|---|
| `{name}` | Recipient's first name |
| `{otp}` | One-time password code |
| `{order_id}` | Order number |
| `{amount}` | Currency amount (e.g. ₹499) |
| `{points}` | Loyalty points count |
| `{seller_name}` | Seller/vendor name |
| `{customer_name}` | Customer's name (used in seller-facing notifications) |
| `{tracking_url}` | Shipment tracking link |
| `{expiry}` | OTP expiry time (e.g. 10 mins) |

---

## 1. Login OTP

### SMS
```
Your Celigin OTP: {otp}. Valid {expiry}. -Celigin
```
*~49 chars*

### Email
**Subject**: Your login code is `{otp}`

**Body**:
> Hi {name},
>
> Here's your one-time login code:
>
> **{otp}**
>
> This code is valid for {expiry}. Don't share it with anyone — we'll never ask for it.
>
> If you didn't request this, you can safely ignore this email.

---

## 2. Login Resend OTP

### SMS
```
New OTP for Celigin: {otp}. Valid {expiry}.
```
*~44 chars*

### Email
**Subject**: Here's your new login code

**Body**:
> Hi {name},
>
> You asked for a new code. Here it is:
>
> **{otp}**
>
> Valid for {expiry}. If you keep having trouble signing in, reply to this email and we'll help.

---

## 3. Profile Change — Verify Number/Email (OTP)

### SMS
```
Celigin OTP: {otp} to update your profile.
```
*~43 chars*

### Email
**Subject**: Confirm your profile update — code `{otp}`

**Body**:
> Hi {name},
>
> We got a request to update your contact details. Use this code to confirm:
>
> **{otp}**
>
> Valid for {expiry}. If you didn't make this change, please secure your account immediately.

---

## 4. Order Placed

### SMS
```
Order #{order_id} confirmed! -Celigin
```
*~37 chars + order_id*

### Email
**Subject**: Order #{order_id} confirmed — thanks!

**Body**:
> Hi {name},
>
> Your order is confirmed and we're getting it ready.
>
> **Order ID**: #{order_id}
> **Total**: {amount}
>
> We'll let you know as soon as it ships. In the meantime, you can track your order in My Account.

---

## 5. Order Shipped

### SMS
```
Order #{order_id} is on its way! -Celigin
```
*~42 chars*

### Email
**Subject**: Your order #{order_id} has shipped!

**Body**:
> Hi {name},
>
> Great news — your order is on its way!
>
> **Order ID**: #{order_id}
> **Track it**: {tracking_url}
>
> Sit tight. Delivery usually takes 2–5 business days depending on your location.

---

## 6. Out for Delivery

### SMS
```
Order #{order_id} out for delivery today! -Celigin
```
*~50 chars + order_id*

### Email
**Subject**: Your order is arriving today!

**Body**:
> Hi {name},
>
> Your order is out for delivery and should reach you today.
>
> **Order ID**: #{order_id}
>
> Keep your phone handy — the delivery agent may call before arriving.

---

## 7. Delivered

### SMS
```
Order #{order_id} delivered. Enjoy! -Celigin
```
*~44 chars*

### Email
**Subject**: Your order has arrived!

**Body**:
> Hi {name},
>
> Your order has been delivered. Hope you love it!
>
> **Order ID**: #{order_id}
>
> If anything isn't right, reach out within 7 days and we'll make it good.

---

## 8. Order Cancelled

### SMS
```
Order #{order_id} cancelled. Refund 5-7 days. -Celigin
```
*~54 chars + order_id*

### Email
**Subject**: Order #{order_id} has been cancelled

**Body**:
> Hi {name},
>
> Your order #{order_id} has been cancelled as requested.
>
> **Refund of {amount}** will be credited back to your original payment method within 5–7 business days.
>
> If you didn't request this cancellation, please contact us right away.

---

## 9. Refund Requested

### SMS
```
Refund #{order_id} received. We'll update. -Celigin
```
*~51 chars + order_id*

### Email
**Subject**: We've received your refund request

**Body**:
> Hi {name},
>
> We've received your refund request for order #{order_id}.
>
> **Amount**: {amount}
> **Status**: Under review
>
> Our team will review it and get back to you within 2 business days. We'll keep you posted here.

---

## 10. Refund Under Review

### SMS
```
Refund #{order_id} under review. -Celigin
```
*~41 chars + order_id*

### Email
**Subject**: Your refund is being reviewed

**Body**:
> Hi {name},
>
> Your refund for order #{order_id} is currently under review by our team.
>
> **Amount**: {amount}
>
> We're working on it and will update you soon. Reviews typically complete within 1–2 business days.

---

## 11. Refund Processed

### SMS
```
Refund {amount} for #{order_id} done! -Celigin
```
*~46 chars + variables*

### Email
**Subject**: Your refund of {amount} has been processed

**Body**:
> Hi {name},
>
> Good news — your refund has been processed!
>
> **Order ID**: #{order_id}
> **Amount**: {amount}
> **Credited to**: Your original payment method
>
> It may take 3–5 business days to reflect, depending on your bank. Thank you for your patience.

---

## 12. Loyalty Points Update

### SMS
```
You've got {points} pts on Celigin. Keep it up!
```
*~47 chars*

### Email
**Subject**: You have {points} loyalty points

**Body**:
> Hi {name},
>
> Just a heads up — you currently have **{points} points** in your Celigin account.
>
> Points can be redeemed on your next purchase at checkout. The more you shop, the more you earn.
>
> Happy shopping!

---

## 13. Celigin Club — Join as Affiliate

### SMS
```
Welcome, Celigin Affiliate! Start earning now.
```
*~46 chars*

### Email
**Subject**: You're now a Celigin Affiliate!

**Body**:
> Hi {name},
>
> Welcome to the Celigin Affiliate Program!
>
> Your affiliate account is active. Share your unique link and earn a commission on every sale you drive.
>
> Log in to your dashboard to get started — your link and earnings tracker are ready and waiting.

---

## 14. Celigin Club — Become a Seller

### SMS
```
Welcome, Seller! Your Celigin store is live.
```
*~44 chars*

### Email
**Subject**: Your Celigin seller account is live!

**Body**:
> Hi {name},
>
> Your seller account has been approved — welcome to Celigin!
>
> You can now add products, manage orders, and track your earnings from the Seller Dashboard.
>
> Let's get your first listing up. We're rooting for you!

---

## 15. POS — New Customer Welcome

*Sent to the customer when a seller adds them for the first time via POS.*

### SMS
```
Hi {name}! Welcome to Celigin. Your account is set.
```
*~51 chars*

### Email
**Subject**: Welcome to Celigin, {name}!

**Body**:
> Hi {name},
>
> Your Celigin account has been created by **{seller_name}**.
>
> You can now view your order history, track deliveries, and manage your account anytime.
>
> If you have any questions, your seller is the best first point of contact.

---

## 16. POS — Order Placed

### Customer SMS
```
Order #{order_id} placed via Celigin POS. Thanks!
```
*~49 chars + order_id*

### Customer Email
**Subject**: Your POS order #{order_id} is confirmed

**Body**:
> Hi {name},
>
> Your order has been placed through **{seller_name}** on Celigin POS.
>
> **Order ID**: #{order_id}
> **Total**: {amount}
>
> You'll receive an update once your order is ready.

---

### Seller SMS
```
New Celigin POS order #{order_id} received!
```
*~43 chars + order_id*

### Seller Email
**Subject**: New POS order received — #{order_id}

**Body**:
> Hi {name},
>
> A new order has been placed through your POS.
>
> **Order ID**: #{order_id}
> **Customer**: {customer_name}
> **Amount**: {amount}
>
> Log in to your seller dashboard to process it.

---

## 17. POS — Seller Withdrawal Request

### Seller SMS
```
Celigin withdrawal {amount} requested. Processing.
```
*~50 chars + amount*

### Seller Email
**Subject**: Withdrawal request of {amount} received

**Body**:
> Hi {name},
>
> We've received your withdrawal request.
>
> **Amount**: {amount}
> **Status**: Processing
>
> Withdrawals are typically processed within 3–5 business days. We'll notify you once the transfer is complete.

---

## 18. Celigin Club — Affiliate Activated / Deactivated

### Activated SMS
```
Your Celigin Affiliate account is now active!
```
*~45 chars*

### Activated Email
**Subject**: Your affiliate account is active

**Body**:
> Hi {name},
>
> Your Celigin Affiliate account has been **activated**.
>
> You can now access your dashboard, share your referral link, and start earning. Go get 'em!

---

### Deactivated SMS
```
Your Celigin Affiliate account is deactivated.
```
*~46 chars*

### Deactivated Email
**Subject**: Your affiliate account has been deactivated

**Body**:
> Hi {name},
>
> Your Celigin Affiliate account has been **deactivated**.
>
> If you think this is a mistake or would like to discuss reinstatement, please reach out to our support team.

---

## 19. Affiliate — Withdrawal Request

### SMS
```
Celigin affiliate withdrawal {amount} processing.
```
*~49 chars + amount*

### Email
**Subject**: Your affiliate withdrawal of {amount} is on its way

**Body**:
> Hi {name},
>
> We've received your affiliate withdrawal request.
>
> **Amount**: {amount}
> **Status**: Processing
>
> You'll receive the funds within 3–5 business days. Thanks for being part of the Celigin affiliate community!

---

## Notes for Developers

- All SMS must stay within **160 chars** (standard) but target **60 chars** as briefed.
- Every SMS must contain "Celigin" — in the body text or as `-Celigin` sign-off.
- OTP SMS must **not** include any URL (deliverability risk).
- Email template: use `email-template.html` as the base — swap `{{HEADLINE}}`, `{{BODY_HTML}}`, `{{CTA_LABEL}}`, `{{CTA_URL}}` per notification.
- Emails without a CTA (e.g. OTP, info-only) — hide the button block entirely.
- Always send OTP via the method the user is currently using (phone → SMS, email → email).
