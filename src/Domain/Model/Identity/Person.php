<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

final class Person
{
    private $userId;

    private $name;

    public function __construct(UserId $userId, FullName $name)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function name(): FullName
    {
        return $this->name;
    }

    public function withUserId(UserId $userId): Person
    {
        return new self($userId, $this->name);
    }

    public function changeName(FullName $name): Person
    {
        return new self($this->userId, $name);
    }

    public function sameIdentityAs(self $other): bool
    {
        return $this->userId->equals($other->userId);
    }
}
