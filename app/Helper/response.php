<?php

function responseError($msg, $code = '', $status = 'error')
{
    return response([
        'status' => $status,
        'code' => $code,
        'message' => $msg
    ], $code != '' ? $code : 400);
}

function responseSuccess($data = [], $msg = '', $code = '', $status = 'success')
{
    return response([
        'status' => $status,
        'message' => $msg,
        'data' => $data,
    ], $code != '' ? $code : 200);
}

function responseSuccessMsg($msg = "", $code = "", $status = 'success')
{
    return response([
        'status' => $status,
        'message' => $msg,
    ], $code != '' ? $code : 200);
}
