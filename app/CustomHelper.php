<?php

function success($data = [], $message = "success", $status = 200)
{
    return response(["message" => $message, "status" => $status, "data" => $data], $status);
}

function error($error = [], $message = "oops something went wrong", $status = 404)
{
    return response(["message" => $message, "status" => $status, "error" => $error], $status);
}
