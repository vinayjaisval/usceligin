<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Refund Window (Days)
    |--------------------------------------------------------------------------
    | Number of days after delivery within which a refund request can be made.
    */
    'refund_window_days' => 5,

    /*
    |--------------------------------------------------------------------------
    | Order Status Steps
    |--------------------------------------------------------------------------
    | Ordered array of the 4 delivery stages shown in the status tracker.
    | 'statuses' lists which DB order.status values map to this step.
    */
    'status_steps' => [
        1 => [
            'label'    => 'Ordered',
            'statuses' => ['pending'],
            // Shopping bag icon
            'icon'     => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
        ],
        2 => [
            'label'    => 'Shipped',
            'statuses' => ['processing', 'shipped'],
            // 3-D package / cube icon
            'icon'     => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        ],
        3 => [
            'label'    => 'Out for Delivery',
            'statuses' => ['on delivery', 'out for delivery'],
            // Delivery truck icon
            'icon'     => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12',
        ],
        4 => [
            'label'    => 'Delivered',
            'statuses' => ['completed', 'refund_requested'],
            // Home / delivered-to-door icon
            'icon'     => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        ],
    ],

];
