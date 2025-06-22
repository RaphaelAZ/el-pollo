<?php

namespace App\Sys;

class Config
{
    private string $passwordHashAlgo = PASSWORD_DEFAULT;

    // ---------------------------------------------------------------


    public function getJwtSecret(): string
    {
        return $_ENV["JWT_SECRET"];
    }

    public function getPasswordHashAlgo(): string
    {
        return $this->passwordHashAlgo;
    }
}