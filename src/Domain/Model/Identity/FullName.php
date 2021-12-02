<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

final class FullName
{
    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * @var LastName
     */
    private $lastName;

    public function __construct(FirstName $firstName, LastName $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function firstName(): FirstName
    {
        return $this->firstName;
    }

    public function lastName(): LastName
    {
        return $this->lastName;
    }

    public function withFirstName(FirstName $firstName): FullName
    {
        return new self($firstName, $this->lastName);
    }

    public function withLastName(LastName $lastName): FullName
    {
        return new self($this->firstName, $lastName);
    }

    public function equals(FullName $fullName): bool
    {
        return $this->firstName->toString() === $fullName->firstName->toString()
            && $this->lastName->toString() === $fullName->lastName->toString();
    }
}
