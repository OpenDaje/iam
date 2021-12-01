<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Access;

use OpenDaje\IdentityAccess\Domain\Model\Access\Role;
use OpenDaje\IdentityAccess\Domain\Model\Access\RoleId;
use OpenDaje\IdentityAccess\Domain\Model\Access\RoleName;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class RoleTest extends TestCase
{
    private const FIRST_UUID        = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';
    private const SECOND_UUID   = 'f2bfb4e2-b639-4e79-b546-5322dd03675d';
    private const COPY_OF_FIRST_UUID    = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';
    private const FIRST_ROLE_NAME   = 'ROLE_USER';

    private $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = new Role(RoleId::fromString(self::FIRST_UUID), RoleName::fromString(self::FIRST_ROLE_NAME));
    }

    /** @test */
    public function it_can_create_a_Role(): void
    {
        $role = new Role(RoleId::fromString(self::FIRST_UUID), RoleName::fromString(self::FIRST_ROLE_NAME));

        self::assertInstanceOf(Role::class, $role);
        self::assertEquals(self::FIRST_UUID, $role->roleId()->toString());
        self::assertEquals(self::FIRST_ROLE_NAME, $role->name()->toString());
    }

    /** @test */
    public function it_can_change_name(): void
    {
        $this->role->withName(RoleName::fromString('ROLE_OTHER'));

        self::assertEquals('ROLE_OTHER', $this->role->name()->toString());
    }

    /** @test */
    public function it_can_change_description(): void
    {
        $this->role->withDescription('new description');

        self::assertEquals('new description', $this->role->description());
    }

    /** @test */
    public function it_can_be_compared(): void
    {
        $first = new Role(RoleId::fromString(self::FIRST_UUID), RoleName::fromString(self::FIRST_ROLE_NAME));
        $second = new Role(RoleId::fromString(self::SECOND_UUID), RoleName::fromString('ROLE_SECOND'));
        $copyOfFirst = new Role(RoleId::fromString(self::COPY_OF_FIRST_UUID), RoleName::fromString('ROLE_THIRD'));

        self::assertFalse($first->sameIdentityAs($second));
        self::assertTrue($first->sameIdentityAs($copyOfFirst));
        self::assertFalse($second->sameIdentityAs($copyOfFirst));
    }
}
