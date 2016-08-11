<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function responseNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->responseError($message);
    }

    private function responseError($message)
    {
        return $this->response([
            'status' => 'failed',
            'errors' => [
                'status_code' => $this->getStatusCode(),
                'message' => $message
            ]
        ]);
    }

    public function response($data)
    {
        return \Response::json($data,$this->getStatusCode());
    }
}
