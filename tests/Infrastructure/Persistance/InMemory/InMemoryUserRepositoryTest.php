<?php

declare(strict_types=1);

namespace OpenDaje\IdentityAccess\Tests\Infrastructure\Persistance\InMemory;

use OpenDaje\IdentityAccess\Domain\Model\Identity\EmailAddress;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FirstName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\FullName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\LastName;
use OpenDaje\IdentityAccess\Domain\Model\Identity\Person;
use OpenDaje\IdentityAccess\Domain\Model\Identity\User;
use OpenDaje\IdentityAccess\Domain\Model\Identity\UserId;
use OpenDaje\IdentityAccess\Infrastructure\Persistence\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

/** @group unit */
class InMemoryUserRepositoryTest extends TestCase
{
    /**
     * @var InMemoryUserRepository|null
     */
    private $repository;

    protected function setUp(): void
    {
        //parent::setUp(); // TODO: Change the autogenerated stub
        $this->repository = new InMemoryUserRepository();
    }

    /**
     * @test
     */
    public function it_can_create(): void
    {
        self::assertInstanceOf(InMemoryUserRepository::class, $this->repository);
    }

    private function defaultUser(): User
    {
        return new User(
            $userId = UserId::generate(),
            $email = EmailAddress::fromString('irrelevant@example.com'),
            $password = 'irrelevant-password',
            $person = new Person(
                $userId,
                new FullName(
                    FirstName::fromString('joe'),
                    LastName::fromString('doe')
                )
            )
        );
    }

    /**
     * @test
     */
    public function it_can_store_user(): void
    {
        $user = $this->defaultUser();

        $this->repository->store($user);

        self::assertInstanceOf(User::class, $this->repository->ofId($user->userId()));
    }

    /**
     * @test
     */
    public function it_can_retrieve_user_by_userId(): void
    {
        $user = $this->defaultUser();
        $this->repository->store($user);

        $result = $this->repository->ofId($user->userId());

        self::assertInstanceOf(User::class, $result);

        //TODO: add method sameIdentity in User
        //self::assertTrue($result->sameIdentiy($user));
    }

    protected function tearDown(): void
    {
        //parent::tearDown(); // TODO: Change the autogenerated stub
        $this->repository = null;
    }
}
