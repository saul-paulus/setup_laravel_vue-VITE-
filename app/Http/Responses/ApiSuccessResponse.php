<?php

namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{

    private $data, $message, $code, $headers;

    public function __construct(mixed $data, string $message, int $code = Response::HTTP_OK, array $header=[])
    {

    }
    public function toResponse($request)
    {
        return response()->json(
            [
                'data' => $this->data,
                'message' => $this->message,
            ],
            $this->code,
            $this->headers
        );
    }
}
