<?php

namespace App\Sys;

use JetBrains\PhpStorm\NoReturn;

class BaseController
{
    #[NoReturn]
    protected function respondJson(mixed $data): void
    {
        $this->setGenericHeaders();
        header('Content-Type: application/json');

        echo json_encode($data);

        exit(0);
    }

    protected function setGenericHeaders(?int $responseCode = 200): void
    {
        header('Access-Control-Allow-Origin: 127.0.0.1:5173');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Expires: 0');
        header('Pragma: no-cache');

        if( null !== $responseCode ) {
            http_response_code($responseCode);
        }
    }

    protected function getJsonData(string $fileName, bool $associative = true): mixed
    {
        //get file contents
        $fileContents = file_get_contents(
            realpath(
                sprintf("%s/%s", DATA_DIR, $fileName)
            )
        );

        if( !$fileContents ) {
            throw new \RuntimeException(sprintf("Cannot get json file '%s'", $fileName));
        }

        //and decode the json
        return json_decode($fileContents, $associative, JSON_THROW_ON_ERROR);
    }

    #[NoReturn]
    protected function respond404(): void
    {
        $this->setGenericHeaders(404);
        exit(0);
    }

    protected function getConfig(): Config
    {
        return new Config();
    }
}