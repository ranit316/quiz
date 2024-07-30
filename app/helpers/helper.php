<?php

function responseData($data, $message = "", $status = true,)
{
    return [
        "success" => $status,
        "message" => $message,
        "data" => $data
    ];
}
