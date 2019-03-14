<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Domain\Model\Identity;

final class EmailAddress
{
    private $email;

    public function __construct(string $email)
    {
        if (!$email) {
            throw new \InvalidArgumentException('Email missing.');
        }
        $this->email = $this->sanitize($email);
    }

    public function email(): string
    {
        return $this->email;
    }

    public function withEmail(string $email): EmailAddress
    {
        return new self($email);
    }

    public static function fromString(string $email): EmailAddress
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function equals(EmailAddress $emailAddress): bool
    {
        return $this->email === $emailAddress->email;
    }

    private function sanitize(string $email): string
    {
        $email = strtolower(trim($email));

        return $email;
    }
}
