<?php

namespace App\Contracts;

interface MiddlewareContract
{
    /**
     * This will be the entrypoint of the middleware
     * @return mixed
     */
    public function __invoke();
}