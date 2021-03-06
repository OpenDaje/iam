<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

final class GroupId
{
    private $uuid;

    public static function generate(): GroupId
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $groupId): GroupId
    {
        return new self(\Ramsey\Uuid\Uuid::fromString($groupId));
    }

    private function __construct(\Ramsey\Uuid\UuidInterface $groupId)
    {
        $this->uuid = $groupId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(GroupId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
