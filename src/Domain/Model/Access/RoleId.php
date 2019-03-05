<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

final class RoleId
{
    private $uuid;

    public static function generate(): RoleId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $roleId): RoleId
    {
        return new self(\Ramsey\Uuid\Uuid::fromString($roleId));
    }

    private function __construct(\Ramsey\Uuid\UuidInterface $roleId)
    {
        $this->uuid = $roleId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(RoleId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
