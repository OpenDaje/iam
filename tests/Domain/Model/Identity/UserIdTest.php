<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class UserIdTest extends TestCase
{
    private const FIRST_UUID    = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';
    private const SECOND_UUID   = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0'; // EQUAL TO THE FIRST
    private const THIRD_UUID    = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /** @test */
    public function it_can_autogenerate_a_UserId(): void
    {
        $userId = UserId::generate();

        $this->assertInstanceOf(UserId::class, $userId);
        $this->assertIsString($userId->toString());
        $this->assertNotEmpty($userId->toString());
    }

    /** @test */
    public function it_can_generate_a_UserId_from_string(): void
    {
        $contestId = UserId::fromString(self::FIRST_UUID);

        $this->assertInstanceOf(UserId::class, $contestId);
        $this->assertSame(self::FIRST_UUID, $contestId->toString());
        $this->assertSame(self::FIRST_UUID, $contestId->__toString());
    }

    /**
     * @test
     * @depends  it_can_autogenerate_a_UserId
     */
    public function it_can_be_compared(): void
    {
        $first = UserId::fromString(self::FIRST_UUID);
        $second = UserId::fromString(self::SECOND_UUID);
        $third = UserId::fromString(self::THIRD_UUID);

        $this->assertTrue($first->equals($second));
        $this->assertFalse($first->equals($third));
        $this->assertFalse($third->equals($second));
    }
}
