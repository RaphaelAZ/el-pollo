<?php

namespace App\Sys;

class Config
{
    private string $usersFileName = 'users.json';

    private string $jwtSecret = 'a8aaf7e3391320fec3cae68be741de84591ece8920fd0f1493b2e865c9a84d3f';

    // ---------------------------------------------------------------

    public function getUsersFileName(): string
    {
        return $this->usersFileName;
    }

    public function setUsersFileName(string $usersFileName): void
    {
        $this->usersFileName = $usersFileName;
    }

    public function getJwtSecret(): string
    {
        return $this->jwtSecret;
    }

    public function setJwtSecret(string $jwtSecret): void
    {
        $this->jwtSecret = $jwtSecret;
    }
}