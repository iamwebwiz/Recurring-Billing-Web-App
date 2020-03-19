<?php

namespace App\Http\Controllers;

use App\Http\Actions\Subscriptions\StoreSubscriptionAction;
use App\Http\Requests\Subscriptions\NewSubscriptionRequest;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Store a new subscription to the plan.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function store(Request $request): ?\Illuminate\Http\JsonResponse
    {
        return (new StoreSubscriptionAction())->execute(
            new NewSubscriptionRequest($request->all())
        );
    }
}
