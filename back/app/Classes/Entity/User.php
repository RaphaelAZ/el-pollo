<?php

namespace App\Classes\Entity;

use App\Contracts\Arrayable;
use App\Contracts\Jsonable;

class User implements Arrayable, Jsonable
{
    public function __construct(
        private ?string $email = null,
        private ?string $password = null,
        private ?string $username = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'username' => $this->username,
        ];
    }

    public static function fromJson(array $data): User
    {
        return new User(
            $data['email'] ?? null,
            $data['password'] ?? null,
            $data['username'] ?? null,
        );
    }

    // ----------------------------------------------

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }
}