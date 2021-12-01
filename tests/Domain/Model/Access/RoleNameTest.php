<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Access;

use OpenDaje\IdentityAccess\Domain\Model\Access\RoleName;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class RoleNameTest extends TestCase
{
    private const FIRST_ROLE_NAME = 'ROLE_USER';

    private const SECOND_ROLE_NAME = 'ROLE_CUSTOMER';

    private const COPY_OF_FIRST_ROLE_NAME = 'ROLE_USER';

    /**
     * @test
     */
    public function it_can_generate_RoleName_from_string(): void
    {
        $roleName = RoleName::fromString(self::FIRST_ROLE_NAME);

        self::assertInstanceOf(RoleName::class, $roleName);
        self::assertEquals(self::FIRST_ROLE_NAME, $roleName->roleName());
        self::assertEquals(self::FIRST_ROLE_NAME, $roleName->toString());
        self::assertEquals(self::FIRST_ROLE_NAME, $roleName->__toString());
    }

    /**
     * @test
     */
    public function it_returns_a_new_value_object_if_modified(): void
    {
        $roleName = RoleName::fromString(self::FIRST_ROLE_NAME);

        $roleName = $roleName->withRoleName(self::SECOND_ROLE_NAME);

        self::assertInstanceOf(RoleName::class, $roleName);
        self::assertEquals(self::SECOND_ROLE_NAME, $roleName->roleName());
    }

    /**
     * @test
     */
    public function it_can_be_compared(): void
    {
        $first = RoleName::fromString(self::FIRST_ROLE_NAME);
        $second = RoleName::fromString(self::SECOND_ROLE_NAME);
        $copyOfFirst = RoleName::fromString(self::COPY_OF_FIRST_ROLE_NAME);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function empty_role_name_should_throw_exception(): void
    {
        RoleName::fromString('');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function short_role_name_should_throw_exception(): void
    {
        RoleName::fromString('ROLE_A');
    }
}
