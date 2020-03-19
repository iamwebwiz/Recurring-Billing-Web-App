<?php

return [
    'paystack' => [
        'secret_key' => env('PAYSTACK_SECRET_KEY'),
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
        'base_url' => env('PAYSTACK_BASE_URL'),
        'plan_id' => env('PAYSTACK_PLAN_ID'),
    ],
    'status_codes' => [
        'success' => 200,
        'created' => 201,
        'validation_error' => 422,
        'server_error' => 500,
        'bad_request' => 400,
    ],
];
