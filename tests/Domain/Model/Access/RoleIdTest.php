<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Access;

use OpenDaje\IdentityAccess\Domain\Model\Access\RoleId;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class RoleIdTest extends TestCase
{
    private const FIRST_UUID    = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';
    private const SECOND_UUID   = 'f2bfb4e2-b639-4e79-b546-5322dd03675d';
    private const COPY_OF_FIRST_UUID    = 'ade9885e-cd39-422e-8d13-a4edbc0eb245';

    /** @test */
    public function it_can_generate_a_RoleId(): void
    {
        $roleId = RoleId::generate();

        $this->assertInstanceOf(RoleId::class, $roleId);
        $this->assertIsString($roleId->toString());
        $this->assertNotEmpty($roleId->toString());
    }

    /** @test */
    public function it_can_generate_a_RoleId_from_string(): void
    {
        $roleId = RoleId::fromString(self::FIRST_UUID);

        $this->assertInstanceOf(RoleId::class, $roleId);
        $this->assertSame(self::FIRST_UUID, $roleId->toString());
        $this->assertSame(self::FIRST_UUID, $roleId->__toString());
    }

    /**
     * @test
     * @depends  it_can_generate_a_RoleId
     */
    public function it_can_be_compared(): void
    {
        $first = RoleId::fromString(self::FIRST_UUID);
        $second = RoleId::fromString(self::SECOND_UUID);
        $copyOfFirst = RoleId::fromString(self::COPY_OF_FIRST_UUID);

        $this->assertFalse($first->equals($second));
        $this->assertTrue($first->equals($copyOfFirst));
        $this->assertFalse($second->equals($copyOfFirst));
    }
}
