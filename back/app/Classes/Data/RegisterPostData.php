<?php

namespace App\Classes\Data;

use App\Contracts\DataClassFromRequestContract;

/**
 * Readonly class that represent infos from the front-end to login the current user
 */
readonly class RegisterPostData implements DataClassFromRequestContract
{
    public function __construct(
        public ?string $email,
        public ?string $password,
        public ?string $username,
    ) {
    }

    public static function fromRequest(array $get, array $post): static
    {
        return new RegisterPostData(
            $post['email'],
            $post['password'],
            $post['username'],
        );
    }
}