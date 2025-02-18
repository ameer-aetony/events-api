<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    public function render($request, Throwable $exception)
    {
       
       
        if ($request->expectsJson() || Str::contains($request->path(), 'api')) {
            Log::error($exception);


            if ($exception instanceof ValidationException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                return $this->apiResponse([
                    'message' => "Validation failed",
                    'success' => false,
                    'exception' => $exception,
                    'error_code' => $statusCode,
                    'errors' => $exception->errors(),
                ], $statusCode);
            }

            if ($exception instanceof RecordNotFound) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                return $this->sendError($exception->getMessage(),null,1, $statusCode);
            }

           


            if ($exception instanceof \Error) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                return $this->apiResponse([
                    'message' => "We could not handle your request, please try again later",
                    'success' => false,
                    'exception' => $exception,
                    'error_code' => $statusCode,
                ]);
            }
        }
        return parent::render($request, $exception);
    }
}
