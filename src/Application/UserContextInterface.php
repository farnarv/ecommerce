<?php

namespace App\Application;

use App\Domain\Entity\User;

interface UserContextInterface
{
    public function isLoggedIn(): bool;

    public function getCurrentUser(): ?User;
}
