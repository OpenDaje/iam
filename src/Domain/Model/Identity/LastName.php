<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

final class LastName
{
    private $lastName;

    public function __construct(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function withLastName(string $lastName): LastName
    {
        return new self($lastName);
    }

    public static function fromString(string $lastName): LastName
    {
        return new self($lastName);
    }

    public function toString(): string
    {
        return $this->lastName;
    }

    public function __toString(): string
    {
        return $this->lastName;
    }

    public function equals(LastName $lastName): bool
    {
        return $this->lastName === $lastName->lastName;
    }
}
