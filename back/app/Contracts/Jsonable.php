<?php

namespace App\Contracts;

interface Jsonable
{
    public static function fromJson(array $data): self;
}