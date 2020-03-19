<?php

namespace App\Http\Actions\Subscriptions;

use App\Http\Requests\Subscriptions\NewSubscriptionRequest;
use App\Subscription;
use App\Traits\HasApiResponses;
use Illuminate\Support\Facades\Validator;

class StoreSubscriptionAction
{
    use HasApiResponses;

    /**
     * Store a new subscription in the database.
     *
     * @param NewSubscriptionRequest $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function execute(NewSubscriptionRequest $request): ?\Illuminate\Http\JsonResponse
    {
        $validation = Validator::make($request->all(), $request->rules(), $request->messages());

        if ($validation->fails()) {
            return $this->formValidationErrorResponse($validation->errors());
        }

        try {
            $subscription = Subscription::create([
                'user_id' => $request->userId,
                'reference' => $request->reference,
                'plan_id' => $request->planId
            ]);

            return $this->successResponse('You are successfully subscribed to this plan.', [
                'subscription' => [
                    'plan_id' => $subscription->plan_id,
                    'reference' => $subscription->reference,
                ]
            ]);
        } catch (\Exception $exception) {
            return $this->serverErrorResponse('Failed to subscribe to this plan.', $exception);
        }
    }
}
