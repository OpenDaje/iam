<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\FirstName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FullName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\LastName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\Person;
use OpenDaje\IdentityAccess\Domain\Model\Identity\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
class PersonTest extends TestCase
{
    private const USER_UUID         = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';
    private const FIXTURE_NAME      = 'joe';
    private const FIXTURE_LASTNAME  = 'doe';

    /** @test */
    public function it_can_create_Person(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $fullName = new FullName(
            FirstName::fromString(self::FIXTURE_NAME),
            LastName::fromString(self::FIXTURE_LASTNAME)
                    );

        $SUT = new Person($userId, $fullName);

        self::assertInstanceOf(Person::class, $SUT);
        self::assertEquals($userId, $SUT->userId());
        self::assertEquals($fullName, $SUT->name());
    }

    /** @test */
    public function it_can_change_name(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $fullName = new FullName(
            FirstName::fromString(self::FIXTURE_NAME),
            LastName::fromString(self::FIXTURE_LASTNAME)
        );

        $newFirstName = FirstName::fromString('new');
        $newLastName = LastName::fromString('new');
        $newFullName = new FullName($newFirstName, $newLastName);



        $SUT = new Person($userId, $fullName);
        $SUT = $SUT->changeName($newFullName);

        self::assertInstanceOf(Person::class, $SUT);
        self::assertEquals($newFirstName, $SUT->name()->firstName());
        //self::assertEquals($fullName, $SUT->name());
    }

    /** @test */
    public function it_can_change_userId(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $otherUserId = UserId::fromString(
            UserId::generate()->toString()
        );
        $fullName = new FullName(
            FirstName::fromString(self::FIXTURE_NAME),
            LastName::fromString(self::FIXTURE_LASTNAME)
        );
        $SUT = new Person($userId, $fullName);

        $SUT = $SUT->withUserId($otherUserId);

        self::assertInstanceOf(Person::class, $SUT);
        self::assertEquals($otherUserId, $SUT->userId());
    }

    /** @test */
    public function it_can_compare_Person_by_identity(): void
    {
        $firstId = UserId::generate();
        $secondId = UserId::generate();
        $copyOfFirstUserId = UserId::fromString($firstId->toString());
        $firstPerson = new Person(
            $firstId,
            new FullName(
                FirstName::fromString(self::FIXTURE_NAME),
                LastName::fromString(self::FIXTURE_LASTNAME)
            )
        );
        $secondPerson = new Person(
            $secondId,
            new FullName(
                FirstName::fromString(self::FIXTURE_NAME),
                LastName::fromString(self::FIXTURE_LASTNAME)
            )
        );
        $copyOfFirstPerson = new Person(
            $copyOfFirstUserId,
            new FullName(
                FirstName::fromString(self::FIXTURE_NAME),
                LastName::fromString(self::FIXTURE_LASTNAME)
            )
        );

        $this->assertFalse($firstPerson->sameIdentityAs($secondPerson));
        $this->assertTrue($firstPerson->sameIdentityAs($copyOfFirstPerson));
        $this->assertFalse($secondPerson->sameIdentityAs($copyOfFirstPerson));
    }
}
