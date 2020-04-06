<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Afrinvest Recurring Billing API",
     *      description="API documentation for recurring billing api",
     *      @OA\Contact(
     *          email="iamwebwiz@gmail.com",
     *          name="Ezekiel Oladejo"
     *      )
     * )
     *
     * @OA\Tag(
     *     name="Recurring Billing",
     *     description="Endpoints in recurring billing app"
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
