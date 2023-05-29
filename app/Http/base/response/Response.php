<?php

namespace App\Http\base\response;

use App\Http\base\response\HTTPCode;
use Illuminate\Http\JsonResponse;
use function response;


trait Response
{
    /**
     * Data is returned to the application from here only.
     *
     * @param array $result
     * @param int $responseStatus
     * @return JsonResponse
     */
    private function result(array $result = [], int $responseStatus = HTTPCode::Success): JsonResponse
    {
        return response()->json(
            $result,
            $responseStatus,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Set JSON Response
     *
     * @param string|null $message
     * @param  $data
     * @param  $errors
     * @param int $statusCode
     *
     * @return JsonResponse
     */
    private function response(string $message = null, $data = null, $errors = null, int $statusCode = HTTPCode::Success): JsonResponse
    {
        $result = ["statusCode" => $statusCode];

        if ($message) $result["message"] = $message;
        if ($data) $result["data"] = $data;
        if ($errors) $result["errors"] = $errors;

        return $this->result($result, $statusCode);
    }
}
