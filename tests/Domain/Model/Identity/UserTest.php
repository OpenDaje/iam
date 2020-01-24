<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Domain\Model\Identity;

use OpenDaje\IdentityAccess\Domain\Model\Identity\EmailAddress;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FirstName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FullName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\LastName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\Person;
use OpenDaje\IdentityAccess\Domain\Model\Identity\User;
use OpenDaje\IdentityAccess\Domain\Model\Identity\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const FIRST_UUID    = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';
    private const SECOND_UUID   = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0'; // EQUAL TO THE FIRST
    private const THIRD_UUID    = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';


    private $userId;
    private $defaulUser;

    protected function setUp()
    {
        parent::setUp();

        $this->userId = UserId::generate();
        $this->defaulUser = new User(
            $this->userId,
            EmailAddress::fromString('example@example.com'),
            'default-password',
            new Person(
                $this->userId,
                new FullName(
                    FirstName::fromString('carlo'),
                    LastName::fromString('rossi')
                                    )
                                )
        );
    }

    /** @test */
    public function it_can_create_a_User(): void
    {
        $userId = UserId::fromString(self::FIRST_UUID);
        $email = EmailAddress::fromString('example@example.com');
        $password = 'xxx-xxx';
        $fullName = new FullName(
            FirstName::fromString('carlo'),
            LastName::fromString('rossi')
        );
        $person = new Person($userId, $fullName);

        $user = new User($userId, $email, $password, $person);

        self::assertInstanceOf(User::class, $user);
        self::assertEquals($userId, $user->userId());
        self::assertEquals($email, $user->email());
        self::assertEquals($password, $user->password());
        self::assertEquals($person, $user->person());
    }

    /** @test */
    public function it_can_change_password(): void
    {
        $newPassword = 'new-password';

        $this->defaulUser->changePassword($newPassword);

        self::assertEquals($newPassword, $this->defaulUser->password());
    }


    /** @test */
    public function it_can_change_personal_name(): void
    {
        $name = new FullName(
            FirstName::fromString('new firstName'),
            LastName::fromString('new lastName')
        );

        $this->defaulUser->changePersonalName($name);

        self::assertEquals($name, $this->defaulUser->person()->name());
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->userId = null;
        $this->defaulUser = null;
    }
}
