<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

interface UserRepositoryInterface
{
    public function store(User $user): void;

    public function ofId(UserId $userId): User;
}
