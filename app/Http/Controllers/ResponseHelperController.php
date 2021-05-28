<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ResponseHelperController extends Controller
{
    public static function returnSuccess($data, $attributes, string $message, int $status_code = Response::HTTP_OK): array
    {
        $response = array();

        $response['data'] = $data;
        $response['attributes'] = $attributes;
        $response['message'] = $message;
        $response['status_code'] = $status_code;
        return $response;
    }

    public static function returnQueryException($attributes, string $message, int $status_code = Response::HTTP_BAD_REQUEST): array
    {
        $response = array();
        $response['attributes'] = $attributes;

        $error = array();
        $error['message'] = 'Query exception occurred.';

        $response['error'] = $error;
        $response['message'] = $message;
        $response['status_code'] = $status_code;
        return $response;
    }

    public static function returnInternalException($attributes, string $message, int $status_code = Response::HTTP_INTERNAL_SERVER_ERROR): array
    {
        $response = array();
        $response['attributes'] = $attributes;

        $error = array();
        $error['message'] = 'Internal error occurred.';

        $response['error'] = $error;
        $response['message'] = $message;
        $response['status_code'] = $status_code;

        return $response;
    }

    public static function returnError($error, $attributes, string $message, int $status_code): array
    {
        $response = array();

        $response['error'] = $error;
        $response['attributes'] = $attributes;
        $response['message'] = $message;
        $response['status_code'] = $status_code;
        return $response;
    }
}
