<?php

namespace App\Domain\Entity;

class User
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isEqual(self $user): bool
    {
        return $this->email === $user->getEmail();
    }
}
