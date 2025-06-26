<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ApiException extends Exception
{

    public function __construct(string $message, int $code = 400, array $data = [])
    {
        parent::__construct($message, $code);
        $this->data = $data;
    }

    public function render(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'code' => $this->getCode()
        ], $this->getCode());
    }
}
