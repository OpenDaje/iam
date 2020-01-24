<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\LastName;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class LastNameTest extends TestCase
{
    private const FIRST_LAST_NAME           = 'obama';
    private const SECOND_LAST_NAME          = 'nixon';
    private const COPY_OF_FIRST_LAST_NAME   = 'obama';

    /** @test */
    public function it_can_generate_a_LastName_from_string(): void
    {
        $lastName = LastName::fromString(self::FIRST_LAST_NAME);

        self::assertInstanceOf(LastName::class, $lastName);
        self::assertEquals(self::FIRST_LAST_NAME, $lastName->lastName());
        self::assertEquals(self::FIRST_LAST_NAME, $lastName->toString());
        self::assertEquals(self::FIRST_LAST_NAME, $lastName->__toString());
    }

    /** @test */
    public function it_returns_a_new_value_object_if_modified(): void
    {
        $lastName = LastName::fromString(self::FIRST_LAST_NAME);

        $newLastName = $lastName->withLastName('bob');

        self::assertInstanceOf(LastName::class, $newLastName);
        self::assertNotEquals($newLastName->lastName(), $lastName->lastName());
    }

    /** @test */
    public function it_can_be_compared(): void
    {
        $first = LastName::fromString(self::FIRST_LAST_NAME);
        $second = LastName::fromString(self::SECOND_LAST_NAME);
        $copyOfFirst = LastName::fromString(self::COPY_OF_FIRST_LAST_NAME);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function empty_lastName_should_throw_exception(): void
    {
        LastName::fromString('');
    }
}
