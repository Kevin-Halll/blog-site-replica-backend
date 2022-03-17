<?php

function success($data = [], $message = "success", $status = "ok")
{
    return response()->json(["message" => $message, "status" => $status, "data" => $data]);
}

function error($error = [], $message = "oops something went wrong", $status = "error")
{
    return response()->json(["message" => $message, "status" => $status, "error" => $error]);
}
