<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class GroupId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    public static function generate(): GroupId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $groupId): GroupId
    {
        return new self(Uuid::fromString($groupId));
    }

    private function __construct(UuidInterface $groupId)
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
