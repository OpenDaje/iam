<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Access;

use OpenDaje\IdentityAccess\Domain\Model\Access\GroupName;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class GroupNameTest extends TestCase
{
    private const FIRST_GROUP_NAME = 'CUSTOMERS';

    private const SECOND_GROUP_NAME = 'SALES';

    private const COPY_OF_FIRST_GROUP_NAME = 'CUSTOMERS';

    /** @test */
    public function it_can_generate_GroupName_from_string(): void
    {
        $groupName = GroupName::fromString(self::FIRST_GROUP_NAME);

        self::assertInstanceOf(GroupName::class, $groupName);
        self::assertEquals(self::FIRST_GROUP_NAME, $groupName->name());
        self::assertEquals(self::FIRST_GROUP_NAME, $groupName->toString());
        self::assertEquals(self::FIRST_GROUP_NAME, $groupName->__toString());
    }

    /** @test */
    public function it_returns_a_new_value_object_if_modified(): void
    {
        $groupName = GroupName::fromString(self::FIRST_GROUP_NAME);

        $groupName = $groupName->withName(self::SECOND_GROUP_NAME);

        self::assertInstanceOf(GroupName::class, $groupName);
        self::assertEquals(self::SECOND_GROUP_NAME, $groupName->name());
    }

    /** @test */
    public function it_can_be_compared(): void
    {
        $first = GroupName::fromString(self::FIRST_GROUP_NAME);
        $second = GroupName::fromString(self::SECOND_GROUP_NAME);
        $copyOfFirst = GroupName::fromString(self::COPY_OF_FIRST_GROUP_NAME);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function empty_group_name_should_throw_exception(): void
    {
        GroupName::fromString('');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function short_group_name_should_throw_exception(): void
    {
        GroupName::fromString('acme');
    }
}
