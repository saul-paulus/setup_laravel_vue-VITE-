<?php

namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Throwable;

class ApiErrorResponse implements Responsable
{

    private $message,
            $code,
            $exception,
            $headers;

    public function __construct(string $message,?Throwable $exception = null, int $code = Response::HTTP_INTERNAL_SERVER_ERROR, array $header=[])
    {

    }
    public function toResponse($request)
    {
        $response = ['message' => $this->message];

        if (! is_null($this->exception) && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->exception->getMessage(),
                'file'    => $this->exception->getFile(),
                'line'    => $this->exception->getLine(),
                'trace'   => $this->exception->getTraceAsString()
            ];
        }

        return response()->json($response, $this->code, $this->headers);
    }
}
