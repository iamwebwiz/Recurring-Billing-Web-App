<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

trait HasApiResponses
{
    /**
     * Success response.
     *
     * @param $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($message, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status_code' => config('recurring.status_codes.success'),
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return Response::json($response, config('recurring.status_codes.success'));
    }

    /**
     * The response for form validation.
     *
     * @param $errors
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function formValidationErrorResponse($errors, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status_code' => config('recurring.status_codes.validation_error'),
            'message' => 'Whoops. Validations failed.',
            'validation_errors' => $errors,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return Response::json($response, config('recurring.status_codes.validation_error'));
    }

    /**
     * Get the "server error" response.
     *
     * @param $message
     * @param Exception|null $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function serverErrorResponse($message, ?Exception $exception): \Illuminate\Http\JsonResponse
    {
        if ($exception !== null) {
            Log::error("{$exception->getMessage()} on line {$exception->getLine()} in {$exception->getFile()}");
        }

        $response = [
            'status_code' => config('recurring.status_codes.server_error'),
            'message' => $message,
        ];

        return Response::json($response, config('recurring.status_codes.server_error'));
    }
}
