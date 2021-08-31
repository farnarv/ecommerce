<?php

namespace App\Infrastructure\Context;

use App\Application\UserContextInterface;
use App\Domain\Entity\User;

class LoggedOutUserContext implements UserContextInterface
{
    public function isLoggedIn(): bool
    {
        return false;
    }

    public function getCurrentUser(): ?User
    {
        return null;
    }
}
