<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function renderResponseStructure($status = false, $message = '', $payload = null)
    {
       return [
            'status' => $status,
            'message' => $message,
            'payload' => $payload
        ];
    }

    public function respondWithError($data = null, $message = null)
    {
        $data = $this->getResponseStructure(STATUS_ERROR, $message, $data);
        $response = $this->respond($data);
        return $response;
    }

    public function respondWithSuccess($data = null, $message = null)
    {
        $data = $this->getResponseStructure(STATUS_SUCCESS, $message, $data);
        $response = $this->respond($data);
        return $response;
    }

    /**
     * Responds with JSON, status code and headers.
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    public function respond(array $data)
    {
        return response()->json($data);
    }
}
