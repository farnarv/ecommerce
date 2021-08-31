<?php

namespace App\Infrastructure\Context;

use App\Application\UserContextInterface;
use App\Domain\Entity\User;

class LoggedInUserContext implements UserContextInterface
{
    public function isLoggedIn(): bool
    {
        return true;
    }

    public function getCurrentUser(): ?User
    {
        return new User('test@mail.com');
    }
}
