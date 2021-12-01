<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

final class GroupName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException('Group name is required.');
        }

        if (strlen($name) < 5) {
            throw new \InvalidArgumentException('Group name must be min. 5 characters.');
        }

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function withName(string $name): GroupName
    {
        return new self($name);
    }

    public static function fromString(string $name): GroupName
    {
        return new self($name);
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function equals(GroupName $groupName): bool
    {
        return $this->name === $groupName->name;
    }
}
