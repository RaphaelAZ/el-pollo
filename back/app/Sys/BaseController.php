<?php

namespace App\Sys;

use App\Classes\Entity\User;
use JetBrains\PhpStorm\NoReturn;

class BaseController
{
    #[NoReturn]
    protected function respondJson(mixed $data, int $code = 200): void
    {
        $this->setGenericHeaders($code);
        header('Content-Type: application/json');

        echo json_encode($data);

        exit(0);
    }

    protected function setGenericHeaders(?int $responseCode = 200): void
    {
        header('Access-Control-Allow-Origin: *');
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

    #[NoReturn]
    protected function respondOnlyCode(int $code)
    {
        $this->setGenericHeaders($code);
        exit(0);
    }

    protected function getConfig(): Config
    {
        return new Config();
    }

    /**
     * Creates a data file if it does not exist in the FS
     * @param string $name
     * @param string|null $contents
     * @return void
     */
    protected function createDataFileIfNotExists(string $name, string $contents = null): void
    {
        $filePath = sprintf("%s/%s", DATA_DIR, $name);

        if( !file_exists($filePath) ) {
            touch($filePath);
            chmod($filePath, 0777);
            file_put_contents($filePath, $contents);
        }
    }

    /**
     * @param array $users
     * @return User[]
     */
    protected function hydrateUsers(array $users): array
    {
        return array_map(function ($singleUser) {
            return User::fromJson($singleUser);
        }, $users);
    }

    protected function dumpDataFile(string $fileName, mixed $data): bool
    {
        try {
            file_put_contents(
                realpath(
                    sprintf("%s/%s", DATA_DIR, $fileName)
                ),
                $data
            );

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}