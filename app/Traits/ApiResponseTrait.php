<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function parseGivenData(array $data = [], int $statusCode = 200, array $headers = [])
    {
        $responseStructure = [
            'success' => $data['success'] ?? false,
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];

        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }

        if (isset($data['status'])) {

            $statusCode = $data['status'];
        }
        
        if (isset($data['exception']) && ($data['exception'] instanceof \Error || $data['exception'] instanceof \Exception)) {

            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }

            if ($statusCode == 200) {
                $statusCode = 500;
            }

            if ($data['success'] == false) {
                if (isset($data['error_code'])) {
                    $responseStructure['error_code'] = $data['error_code'];
                } else {
                    $responseStructure['error_code'] = 1;
                }
            }
        }

        return ['content' => $responseStructure, 'statusCode' => $statusCode, 'headers' => $headers];
    }

    public function apiResponse(array $data = [], int $statusCode = 200, array $headers = [])
    {
        $result = $this->parseGivenData($data, $statusCode, $headers);

        return response()->json($result['content'], $result['statusCode'], $result['headers']);
    }


    public function sendSuccess(mixed $data, string $message = '')
    {
        return  $this->apiResponse(
            [
                'success' => true,
                'result' => $data,
                'message' => $message
            ]
        );
    }

    public function sendError(string $message = '', \Exception $exception = null, int $error_code = 1, int $statusCode = 400)
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $message,
                'error_code' => $error_code,
                'exception' => $exception
            ],
            $statusCode
        );
    }

 
}
