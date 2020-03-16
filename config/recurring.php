<?php

return [
    'paystack' => [
        'secret_key' => env('PAYSTACK_SECRET_KEY'),
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
        'base_url' => env('PAYSTACK_BASE_URL'),
        'plan_id' => env('PAYSTACK_PLAN_ID'),
    ]
];
