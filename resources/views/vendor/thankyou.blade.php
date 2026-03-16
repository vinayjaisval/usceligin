<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
        }
        .thank-box{
            margin-top:100px;
            background:white;
            padding:40px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
            text-align:center;
        }
        .success-icon{
            font-size:60px;
            color:green;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="thank-box">

                <div class="success-icon">
                    ✔
                </div>

                <h2 class="mt-3">Payment Successful</h2>

                <p class="text-muted">
                    Thank you for your order. Your payment has been successfully completed.
                </p>

                <!-- <h5 class="mt-3">
                    Order ID : #{{ $order->id ?? '' }}
                </h5> -->

                <a href="{{ url('/') }}" class="btn btn-primary mt-4">
                    Continue Shopping
                </a>

            </div>

        </div>
    </div>
</div>

</body>
</html>