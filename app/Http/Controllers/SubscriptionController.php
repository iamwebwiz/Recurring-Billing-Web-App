<?php

namespace App\Http\Controllers;

use App\Http\Actions\Subscriptions\StoreSubscriptionAction;
use App\Http\Requests\Subscriptions\NewSubscriptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubscriptionController extends Controller
{
    /**
     * Get info about the API
     *
     * @OA\Get(
     *     path="/api/",
     *     tags={"Recurring Billing"},
     *     @OA\Response(response="200", description="Welcome")
     * )
     */
    public function index()
    {
        return Response::json([
            'api' => 'Afrinvest Recurring Billing API',
            'version' => '1.0.0',
        ]);
    }

    /**
     * Store a new subscription to the plan.
     *
     * @OA\Post(
     *     path="/api/subscriptions/store",
     *     tags={"Recurring Billing"},
     *     @OA\Parameter(
     *          name="token",
     *          in="query",
     *          description="The authenticated user's token",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          description="The authenticated user's id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              default=1
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="reference",
     *          in="query",
     *          description="The reference for this subscription",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="planId",
     *          in="query",
     *          description="The subscription plan id on paystack",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              default=PAYSTACK_PLAN_ID
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successfully created a subscription"
     *      )
     * )
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
