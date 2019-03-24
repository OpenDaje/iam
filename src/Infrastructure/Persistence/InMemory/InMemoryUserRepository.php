<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Infrastructure\Persistence\InMemory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use OpenDaje\IdentityAccess\Domain\Model\Identity\User;
use OpenDaje\IdentityAccess\Domain\Model\Identity\UserId;
use OpenDaje\IdentityAccess\Domain\Model\Identity\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    /** @var Collection  */
    private $users;

    /**
     * InMemoryUserRepository constructor.
     */
    public function __construct()
    {
        $this->users = new arrayCollection();
    }


    public function store(User $user): void
    {
        // TODO: Implement store() method.
        //$this->users->add($user);
        $this->users->set($user->userId()->toString(), $user);
    }

    public function ofId(UserId $userId): User
    {
        // TODO: Implement ofId() method.

        return $this->users->get($userId->toString());
    }

    private function containsKey($key): bool
    {
        return $this->users->containsKey($key);
    }
}
