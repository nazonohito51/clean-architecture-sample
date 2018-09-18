<?php
declare(strict_types=1);

namespace Tests\Unit\UseCases;

use Acme\Application\Requests\CreateUserRequestInterface;
use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\CreateUserResponse;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\UseCases\CreateUserInteractor;
use Acme\Application\UseCases\GetUserInteractor;
use Acme\Application\Repositories\UserRepositoryInterface;
use Acme\Domain\Entities\User;
use Illuminate\Database\Connection;
use Tests\TestCase;

class CreateUserInteractorTest extends TestCase
{
    public function testHandle()
    {
        $useCase = new CreateUserInteractor(new class ($this->app->get(Connection::class)) implements UserRepositoryInterface {
            public function find(int $id): ?array
            {
                return [
                    'id' => $id,
                    'name' => 'name',
                    'mail' => 'hoge@example.com',
                    'password' => 'password',
                ];
            }

            public function save(User $user): bool
            {
                return true;
            }
        });

        $response = $useCase->handle(new class implements CreateUserRequestInterface {
            public function getUserName(): string
            {
                return 'name';
            }

            public function getMailAddress(): string
            {
                return 'hoge@example.com';
            }

            public function getPassword(): string
            {
                return 'password';
            }
        });

        $this->assertInstanceOf(CreateUserResponse::class, $response);
        $this->assertEquals('name', $response->getUserName());
        $this->assertEquals('hoge@example.com', $response->getMailAddress());
    }
}
