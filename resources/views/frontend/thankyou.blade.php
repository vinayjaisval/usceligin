@extends('frontend.include.app')

@section('content')

<div class="min-h-screen   py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="http://localhost/celigin" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 dark:text-gray-100" aria-current="page">Thank You</span>
                </li>
            </ol>
        </nav>
        <div class="bg-white shadow-lg rounded-2xl p-8 text-center border-t-8 border-orange-700 ">
            <h2 class=" text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800">🎉 Thank You for Your Purchase!</h2>
            <p class=" mt-2 text-sm sm:text-base text-gray-600">We’ve emailed you the order details & tracking info.</p>

            <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
                <a href="#"
                    class="px-6 py-3 w-full sm:w-auto text-center bg-orange-600 text-white hover:bg-orange-700 transition">
                    Continue Shopping
                </a>
                <a href="#"
                    class="px-6 py-3 w-full sm:w-auto text-center bg-red-600 text-white hover:bg-red-700 transition">
                    Go to Dashboard
                </a>
            </div>
        </div>


        <div class="bg-white shadow-md rounded-2xl p-8 mt-10 mb-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                    Order# <span class="text-xl font-bold text-gray-900 dark:text-gray-100">uDYH1764928849</span>
                </h3>
                <p class=" dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium">Order Date: 05-Dec-2025</p>
            </div>


            <div class="mt-6">
                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Ordered Products</h4>
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-200 text-gray-600">
                            <tr>
                                <th class="p-3 text-left text-sm font-medium text-gray-900 dark:text-gray-100">Item</th>
                                <th class="p-3 text-center text-sm font-medium text-gray-900 dark:text-gray-100">Qty</th>
                                <th class="p-3 text-right text-sm font-medium text-gray-900 dark:text-gray-100">Price</th>
                                <th class="p-3 text-right text-sm font-medium text-gray-900 dark:text-gray-100">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-3 flex gap-3 items-center">
                                    <img src="your-product-img.png" class="h-14 rounded-lg shadow" alt="">
                                    <span class="font-medium text-gray-700">Product Name</span>
                                </td>
                                <td class="p-3 text-center  font-semibold text-gray-900 dark:text-gray-100">1</td>
                                <td class="p-3 font-semibold text-end text-gray-900 dark:text-gray-100">₹3,071</td>
                                <td class="p-3 text-right font-semibold text-gray-900 dark:text-gray-100">₹3,071</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                    <div class=" border rounded-xl p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">Billing Address</h4>
                        <p class="text-gray-600 dark:text-gray-400"><b>Name:</b> Nitesh kumar</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Email:</b> niteshkumar925960@gmail.com</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Phone:</b> 7065469499</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Country:</b> India</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>State:</b> Uttar Pradesh</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>City:</b> Gautam Buddha Nagar</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Address:</b> Mamura sector 66 Noida</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Zip:</b> 201301</p>
                    </div>

                    <div class=" border rounded-xl p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">Payment Information</h4>
                        <p class="text-gray-600 dark:text-gray-400"><b>Shipping Cost:</b> ₹76.02</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Discount Coupon:</b> ₹0</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Paid Amount:</b> ₹3,147.02</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Payment Method:</b> Razorpay</p>
                        <p class="text-gray-600 dark:text-gray-400"><b>Transaction ID:</b> pay_RntHA3fGK1pqiH</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    @endSection