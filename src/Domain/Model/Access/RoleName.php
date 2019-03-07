<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

final class RoleName
{
    private $roleName;

    public function __construct(string $roleName)
    {
        if (strlen($roleName) === 0) {
            throw new \InvalidArgumentException('Role name is required.');
        }

        if (strlen($roleName) < 9) {
            throw new \InvalidArgumentException('Role name must be min. 9 characters.');
        }

        $this->roleName = $roleName;
    }

    public function roleName(): string
    {
        return $this->roleName;
    }

    public function withRoleName(string $roleName): RoleName
    {
        return new self($roleName);
    }

    public static function fromString(string $roleName): RoleName
    {
        return new self($roleName);
    }

    public function toString(): string
    {
        return $this->roleName;
    }

    public function __toString(): string
    {
        return $this->roleName;
    }

    public function equals(RoleName $roleName): bool
    {
        return $this->roleName === $roleName->roleName;
    }
}
