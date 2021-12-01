<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Access;

final class Role
{
    private $roleId;

    private $name;

    /**
     * @var null|string
     */
    private $description;

    public function __construct(RoleId $roleId, RoleName $name)
    {
        $this->roleId = $roleId;
        $this->name = $name;
    }

    public function roleId(): RoleId
    {
        return $this->roleId;
    }

    public function name(): RoleName
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function withName(RoleName $name): void
    {
        $this->name = $name;
    }

    public function withDescription(string $description): void
    {
        $this->description = $description;
    }

    public function sameIdentityAs(self $other): bool
    {
        return get_class($this) === get_class($other) && $this->roleId->equals($other->roleId);
    }
}
