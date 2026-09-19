<?php

namespace App\Helpers;

use App\{
    Models\Cart,
    Models\User,
    Models\Coupon,
    Models\Order,
    Models\Product,
    Models\Transaction,
    Models\VendorOrder,
    Models\Notification,
    Models\UserNotification
};
use App\Models\AffliateBonus;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderHelper
{
    public static function auth_check($data)
    {
        try {
            $resdata = array();
            $users = User::where('email', '=', $data['personal_email'])->get();
            if (count($users) == 0) {
                if ($data['personal_pass'] == $data['personal_confirm']) {
                    $user = new User;
                    $user->name = $data['personal_name'];
                    $user->email = $data['personal_email'];
                    $user->password = bcrypt($data['personal_pass']);
                    $token = md5(time() . $data['personal_name'] . $data['personal_email']);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($data['personal_name'] . $data['personal_email']);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::login($user);
                    $resdata['auth_success'] = true;
                } else {
                    $resdata['auth_success'] = false;
                    $resdata['error_message'] = __("Confirm Password Doesn't Match.");
                }
            } else {
                $resdata['auth_success'] = false;
                $resdata['error_message'] = __("This Email Already Exist.");
            }
            return $resdata;
        } catch (\Exception $e) {
        }
    }

    public static function license_check($cart)
    {

        foreach ($cart->items as $key => $prod) {
            if (!empty($prod['item']['license']) && !empty($prod['item']['license_qty'])) {
                foreach ($prod['item']['license_qty'] as $ttl => $dtl) {
                    if ($dtl != 0) {
                        $dtl--;
                        $produc = Product::find($prod['item']['id']);
                        $temp = $produc->license_qty;
                        $temp[$ttl] = $dtl;
                        $final = implode(',', $temp);
                        $produc->license_qty = $final;
                        $produc->update();
                        $temp =  $produc->license;
                        $license = $temp[$ttl];
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        // $cart = new Cart($oldCart);
                        $cart=$oldCart;
                        $cart->updateLicense($prod['item']['id'], $license);

                        Session::put('cart', $cart);
                        break;
                    }
                }
            }
        }
    }

    public static function product_affilate_check($cart)
{
    $affilate_users = [];
    $i = 0;

    if (!$cart || empty($cart->items)) {
        return $affilate_users;
    }

    $gs = \App\Models\Generalsetting::find(1);
    $percentage = $gs->affilate_charge / 100;

    foreach ($cart->items as $prod) {
        if (!empty($prod['affilate_user']) && $prod['affilate_user'] != 0) {
            if (Auth::id() != $prod['affilate_user']) {
                $affilate_users[$i]['user_id'] = $prod['affilate_user'];
                $affilate_users[$i]['product_id'] = $prod['item']['id'];
                $affilate_users[$i]['charge'] = $prod['price'] * $percentage;
                $i++;
            }
        }
    }

    return $affilate_users;
}



    public static function set_currency($new_value)
    {

        try {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            foreach ($cart->items as $key => $prod) {

                $cart->items[$key]['price'] = $cart->items[$key]['price'] * $new_value;
                $cart->items[$key]['item']['price'] = $cart->items[$key]['item']['price'] * $new_value;
            }
            Session::put('cart', $cart);
        } catch (\Exception $e) {
        }
    }


    public static function affilate_check($id, $sub, $dp)
    {
        try {
            $user = User::find($id);
            if ($dp == 1) {
                $affiliate_bonus = new AffliateBonus();
                $affiliate_bonus->refer_id = $user->id;
                $affiliate_bonus->bonus = $sub;
                $affiliate_bonus->type = 'Order';
                if (Auth::user()) {
                    $affiliate_bonus->refer_id = Auth::user()->id;
                }
                $affiliate_bonus->save();
                $user->affilate_income += $sub;
                $user->update();
            }
            return $user;
        } catch (\Exception $e) {
        }
    }

    public static function coupon_check($code)
    {
        try {
            $coupon = Coupon::where('code', $code)->first();
            if (!$coupon) {
                return;
            }
            $coupon->used++;
            if ($coupon->times != null) {
                $i = (int)$coupon->times;
                $i--;
                $coupon->times = (string)$i;
            }
            $coupon->update();
        } catch (\Exception $e) {
        }
    }

    /**
     * Recalculate every order total server-side from trusted sources (cart, Coupon
     * model, general settings, user wallet) instead of trusting client-submitted
     * hidden-field amounts. Mirrors the formulas used to render the checkout page
     * in Front\CheckoutController::checkout() and Front\CouponController::couponcheck().
     */
    public static function buildOrderTotals(Request $request, $cart, $user, $gs, $curr)
    {
        $subtotal = (float) $cart->totalPrice;

        // ---- Coupon discount: always re-derived from the Coupon model, never from the request ----
        $couponCode = trim((string) $request->coupon_code);
        $couponDiscount = 0;
        $appliedCouponCode = null;

        if ($couponCode !== '') {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', 1)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();

            $alreadyUsed = $coupon && $user
                ? Order::where('coupon_code', $couponCode)->where('user_id', $user->id)->exists()
                : false;

            if ($coupon && !$alreadyUsed) {
                if ((int) $coupon->type === 0) {
                    $percent = min(max((float) $coupon->price, 0), 100);
                    $couponDiscount = round($subtotal * $percent / 100, 2);
                } else {
                    $couponDiscount = round(min((float) $coupon->price * (float) $curr->value, $subtotal), 2);
                }
                $appliedCouponCode = $coupon->code;
            }
        }

        // ---- Referral discount: server-side rule, first order only ----
        $referralDiscount = 0;
        if ($user) {
            $orderCount = Order::where('user_id', $user->id)->count();
            if ($orderCount === 0 && $user->reffered_by) {
                $referralDiscount = round($subtotal * (($gs->referral_bonus ?? 0) / 100), 2);
            }
        }

        // ---- Shipping cost: same flat rule already used to render the checkout page ----
        $shippingCost = $subtotal >= ($gs->free_shipping_amount ?? 500)
            ? 0
            : ($gs->shipping_cost ?? 50);

        // ---- Tax ----
        $taxAmount = round($subtotal * 0.18, 2);

        // ---- Reward-points redemption, clamped to the user's actual wallet balance ----
        $pointsUsed = min(max((float) $request->points_used, 0), (float) ($user->current_balance ?? 0));

        $payAmount = max(0, $subtotal - $couponDiscount - $referralDiscount + $shippingCost + $taxAmount - $pointsUsed);

        return [
            'subtotal' => $subtotal,
            'coupon_code' => $appliedCouponCode,
            'coupon_discount' => $couponDiscount,
            'referral_discount' => $referralDiscount,
            'shipping_cost' => $shippingCost,
            'tax_amount' => $taxAmount,
            'points_used' => $pointsUsed,
            'pay_amount' => round($payAmount, 2),
        ];
    }

    public static function size_qty_check($cart)
    {
        try {
            foreach ($cart->items as $prod) {
                $x = (string)$prod['size_qty'];
                if (!empty($x)) {
                    $product = Product::find($prod['item']['id']);
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    $temp1 = implode(',', $temp);
                    $product->size_qty =  $temp1;
                    $product->update();
                }
            }
        } catch (\Exception $e) {
        }
    }

    public static function stock_check($cart)
    {
        try {
            foreach ($cart->items as $prod) {
                $x = (string)$prod['stock'];
                if ($x != null) {

                    $product = Product::find($prod['item']['id']);
                    $product->stock =  $prod['stock'];
                    $product->update();
                    if ($product->stock <= 5) {
                        $notification = new Notification;
                        $notification->product_id = $product->id;
                        $notification->save();
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }

    public static function vendor_order_check($cart, $order)
    {
  
        try {
            $notf = array();

            foreach ($cart->items as $prod) {
                if ($prod['item']['user_id'] != 0) {
                    $vorder =  new VendorOrder();
                    $vorder->order_id = $order->id;
                    $vorder->user_id = $prod['item']['user_id'];
                    $vorder->qty = $prod['qty'];
                    $vorder->price = $prod['price'];
                    $vorder->order_number = $order->order_number;
                    $vorder->save();
                    $notf[] = $prod['item']['user_id'];
                }
            }

            if (!empty($notf)) {
                $users = array_unique($notf);
                foreach ($users as $user) {
                    $notification = new UserNotification;
                    $notification->user_id = $user;
                    $notification->order_number = $order->order_number;
                    $notification->save();
                }
            }
        } catch (\Exception $e) {
        }
    }

    public static function add_to_transaction($data, $price)
    {
        try {
            $transaction = new Transaction;
            $transaction->txn_number = Str::random(3) . substr(time(), 6, 8) . Str::random(3);
            $transaction->user_id = $data->user_id;
            $transaction->amount = $price;
            $transaction->currency_sign = $data->currency_sign;
            $transaction->currency_code = $data->currency_name;
            $transaction->currency_value = $data->currency_value;
            $transaction->details = 'Payment Via Wallet';
            $transaction->type = 'minus';
            $transaction->save();
            $balance = $price;
            $user = $transaction->user;
            $user->balance = $user->balance - $balance;
            $user->update();
        } catch (\Exception $e) {
        }
    }

    public static function mollie_currencies()
    {
        return array(
            'AED',
            'AUD',
            'BGN',
            'BRL',
            'CAD',
            'CHF',
            'CZK',
            'DKK',
            'EUR',
            'GBP',
            'HKD',
            'HRK',
            'HUF',
            'ILS',
            'ISK',
            'JPY',
            'MXN',
            'MYR',
            'NOK',
            'NZD',
            'PHP',
            'PLN',
            'RON',
            'RUB',
            'SEK',
            'SGD',
            'THB',
            'TWD',
            'USD',
            'ZAR'
        );
    }

    public static function flutter_currencies()
    {
        return array(
            'BIF',
            'CAD',
            'CDF',
            'CVE',
            'EUR',
            'GBP',
            'GHS',
            'GMD',
            'GNF',
            'KES',
            'LRD',
            'MWK',
            'NGN',
            'RWF',
            'SLL',
            'STD',
            'TZS',
            'UGX',
            'USD',
            'XAF',
            'XOF',
            'ZMK',
            'ZMW',
            'ZWD'
        );
    }

    public static function mercadopago_currencies()
    {
        return array(
            'ARS',
            'BRL',
            'CLP',
            'MXN',
            'PEN',
            'UYU',
            'VEF'
        );
    }
}
