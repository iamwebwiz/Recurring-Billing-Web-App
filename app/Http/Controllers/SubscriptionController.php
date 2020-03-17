<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubscriptionController extends Controller
{
    /**
     * Create a new subscription to plan.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'userId' => 'required',
            'reference' => 'required',
            'planId' => 'required',
        ]);

        $subscription = Subscription::create([
            'user_id' => $request->userId,
            'reference' => $request->reference,
            'plan_id' => $request->planId
        ]);

        if (! $subscription) {
            return Response::json([
                'status' => 'error',
                'message' => 'Unable to subscribe to this plan',
            ]);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'You are successfully subscribed to this plan.',
        ]);
    }
}
