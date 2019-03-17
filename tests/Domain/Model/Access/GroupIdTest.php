<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Access;


use OpenDaje\IdentityAccess\Domain\Model\Access\GroupId;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class GroupIdTest extends TestCase
{
    private const FIRST_UUID    = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';
    private const SECOND_UUID   = 'f2bfb4e2-b639-4e79-b546-5322dd03675d';
    private const COPY_OF_FIRST_UUID    = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';

    /** @test */
    public function it_can_generate_a_GroupId()
    {
        $groupId = GroupId::generate();

        $this->assertInstanceOf(GroupId::class, $groupId);
        $this->assertIsString($groupId->toString());
        $this->assertNotEmpty($groupId->toString());
    }

    /** @test */
    public function it_can_generate_a_GroupId_from_string()
    {
        $groupId = GroupId::fromString(self::FIRST_UUID);

        $this->assertInstanceOf(GroupId::class, $groupId);
        $this->assertSame(self::FIRST_UUID, $groupId->toString());
        $this->assertSame(self::FIRST_UUID, $groupId->__toString());
    }

    /**
     * @test
     * @depends  it_can_generate_a_GroupId
     */
    public function it_can_be_compared()
    {
        $first = GroupId::fromString(self::FIRST_UUID);
        $second = GroupId::fromString(self::SECOND_UUID);
        $copyOfFirst = GroupId::fromString(self::COPY_OF_FIRST_UUID);

        $this->assertFalse($first->equals($second));
        $this->assertTrue($first->equals($copyOfFirst));
        $this->assertFalse($second->equals($copyOfFirst));
    }
}
