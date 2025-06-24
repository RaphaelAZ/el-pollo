<?php

namespace App\Classes\Entity;

use App\Contracts\Arrayable;
use App\Contracts\Jsonable;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class User implements Arrayable, Jsonable
{
    public function __construct(
        private ?string $email = null,
        private ?string $password = null,
        private ?string $username = null,
        private ?ObjectId $id = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'username' => $this->username,
            'id' => (string) $this->id
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

    public static function fromBson(BSONDocument $document): User
    {
        return new User(
            email: $document->offsetGet("email"),
            password: $document->offsetGet('password'),
            username: $document->offsetGet('username'),
            id: $document->offsetGet('_id')
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

    public function getId(): ?ObjectId
    {
        return $this->id;
    }

    public function setId(?ObjectId $id): User
    {
        $this->id = $id;
        return $this;
    }
}