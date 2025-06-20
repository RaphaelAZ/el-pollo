<?php

namespace App\Classes\Data;

use App\Contracts\DataClassFromRequestContract;

/**
 * Readonly class that represent infos from the front-end to login the current user
 */
readonly class LoginPostData implements DataClassFromRequestContract
{
    public function __construct(
        public ?string $email,
        public ?string $password,
    ) {
    }

    public static function fromRequest(array $get, array $post): static
    {
        return new LoginPostData(
            $post['email'], $post['password']
        );
    }
}