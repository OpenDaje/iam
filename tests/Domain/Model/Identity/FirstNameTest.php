<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\FirstName;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class FirstNameTest extends TestCase
{
    private const FIRST_FIRST_NAME      = 'joe';
    private const SECOND_FIRST_NAME     = 'jane';
    private const COPY_OF_FIRST_NAME    = 'joe';

    /** @test */
    public function it_can_generate_a_FirstName_from_string()
    {
        $firstName = FirstName::fromString(self::FIRST_FIRST_NAME);

        self::assertInstanceOf(FirstName::class, $firstName);
        self::assertEquals(self::FIRST_FIRST_NAME, $firstName->firstName());
        self::assertEquals(self::FIRST_FIRST_NAME, $firstName->toString());
        self::assertEquals(self::FIRST_FIRST_NAME, $firstName->__toString());
    }

    /** @test */
    public function it_returns_a_new_value_object_if_modified()
    {
        $firstName = FirstName::fromString(self::FIRST_FIRST_NAME);

        $newFirstName = $firstName->withFirstName('bob');

        self::assertInstanceOf(FirstName::class, $newFirstName);
        self::assertNotEquals($newFirstName->firstName(), $firstName->firstName());
    }

    /** @test */
    public function it_can_be_compared()
    {
        $first = FirstName::fromString(self::FIRST_FIRST_NAME);
        $second = FirstName::fromString(self::SECOND_FIRST_NAME);
        $copyOfFirst = FirstName::fromString(self::COPY_OF_FIRST_NAME);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }
}
