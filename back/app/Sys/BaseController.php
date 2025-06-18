<?php

namespace App\Sys;

class BaseController
{
    protected function respondJson(mixed $data)
    {
        $this->setGenericHeaders();
        header('Content-Type: application/json');

        echo json_encode($data);

        exit(0);
    }

    protected function setGenericHeaders()
    {
        header('Access-Control-Allow-Origin: 127.0.0.1:5173');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Expires: 0');
        header('Pragma: no-cache');
    }
}