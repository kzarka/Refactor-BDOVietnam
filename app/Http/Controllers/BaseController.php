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
            'data' => $payload
        ];
    }

    public function respondWithError($data = null, $message = null)
    {
        $data = $this->renderResponseStructure(STATUS_ERROR, $message, $data);
        $response = $this->respond($data);
        return $response;
    }

    public function respondWithSuccess($data = null, $message = null)
    {
        $data = $this->renderResponseStructure(STATUS_SUCCESS, $message, $data);
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
        return response()->json($data, 200);
    }

    public function saveSessionMessage($message, $type) {
        session()->flash('message', $message);
        session()->flash('type_message', $type);
    }

    public function saveSessionSuccessMessage($message) {
        $this->saveSessionMessage($message, 'success');
    }

    public function saveSessionErrorMessage($message) {
        $this->saveSessionMessage($message, 'error');
    }
}
