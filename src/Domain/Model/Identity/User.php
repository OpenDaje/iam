<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

class User
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var EmailAddress
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Person
     */
    private $person;

    public function __construct(UserId $userId, EmailAddress $email, string $password, Person $person)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->person = $person;
    }

    public function changePersonalName(FullName $aPersonalName): void
    {
        $this->person = $this->person()->changeName($aPersonalName);
    }

    public function changePassword(string $password): void
    {
        $this->password = $password;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): EmailAddress
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function person(): Person
    {
        return $this->person;
    }
}
