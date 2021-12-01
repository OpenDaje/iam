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
    /**
     * @var Collection
     */
    private $users;

    public function __construct()
    {
        $this->users = new arrayCollection();
    }

    public function store(User $user): void
    {
        $this->users->set($user->userId()->toString(), $user);
    }

    public function ofId(UserId $userId): User
    {
        return $this->users->get($userId->toString());
    }

//    private function containsKey(string $key): bool
//    {
//        return $this->users->containsKey($key);
//    }
}
