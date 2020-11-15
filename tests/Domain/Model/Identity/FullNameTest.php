<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\FirstName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FullName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\LastName;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
class FullNameTest extends TestCase
{
    private const FIRST_FIRST_NAME      = 'joe';
    private const SECOND_FIRST_NAME     = 'jane';
    private const COPY_OF_FIRST_NAME    = 'joe';
    private const FIRST_LAST_NAME           = 'obama';
    private const SECOND_LAST_NAME          = 'nixon';
    private const COPY_OF_FIRST_LAST_NAME   = 'obama';

    /** @test */
    public function it_can_create_a_FullName(): void
    {
        $firstName = FirstName::fromString(self::FIRST_FIRST_NAME);
        $lastName = LastName::fromString(self::FIRST_LAST_NAME);

        $fullName = new FullName($firstName, $lastName);

        self::assertInstanceOf(FullName::class, $fullName);
        self::assertEquals(self::FIRST_FIRST_NAME, $fullName->firstName()->toString());
        self::assertEquals(self::FIRST_LAST_NAME, $fullName->lastName()->toString());
    }

    /** @test */
    public function it_returns_a_new_value_object_when_first_name_is_modified(): void
    {
        $firstName = FirstName::fromString(self::FIRST_FIRST_NAME);
        $lastName = LastName::fromString(self::FIRST_LAST_NAME);
        $fullName = new FullName($firstName, $lastName);

        $newFirstName = FirstName::fromString('bob');
        $newFullName = $fullName->withFirstName($newFirstName);

        self::assertInstanceOf(FullName::class, $newFullName);
        self::assertFalse($newFullName->equals($fullName));
        self::assertEquals($newFullName->firstName()->toString(), $newFirstName->toString());
    }

    /** @test */
    public function it_returns_a_new_value_object_when_last_name_is_modified(): void
    {
        $firstName = FirstName::fromString(self::FIRST_FIRST_NAME);
        $lastName = LastName::fromString(self::FIRST_LAST_NAME);
        $fullName = new FullName($firstName, $lastName);

        $newLastName = LastName::fromString('clinton');
        $newFullName = $fullName->withLastName($newLastName);

        self::assertInstanceOf(FullName::class, $newFullName);
        self::assertFalse($newFullName->equals($fullName));
        self::assertEquals($newFullName->lastName()->toString(), $newLastName->toString());
    }

    /** @test */
    public function it_can_be_compared(): void
    {
        $first = new FullName(
            FirstName::fromString(self::FIRST_FIRST_NAME),
            LastName::fromString(self::FIRST_LAST_NAME)
        );

        $second = new FullName(
            FirstName::fromString(self::SECOND_FIRST_NAME),
            LastName::fromString(self::SECOND_LAST_NAME)
        );

        $copyOfFirst = new FullName(
            FirstName::fromString(self::COPY_OF_FIRST_NAME),
            LastName::fromString(self::COPY_OF_FIRST_LAST_NAME)
        );

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($copyOfFirst));
        self::assertFalse($second->equals($copyOfFirst));
    }
}
