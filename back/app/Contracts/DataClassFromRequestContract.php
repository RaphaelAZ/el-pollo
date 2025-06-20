<?php

namespace App\Contracts;

interface DataClassFromRequestContract
{

    /**
     * Sets it's own properties using $_GET and $_POST variables
     * @param array $get
     * @param array $post
     * @return mixed
     */
    public static  function fromRequest(array $get, array $post): static;
}