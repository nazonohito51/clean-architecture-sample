<?php
declare(strict_types=1);

namespace Tests\Unit\Acme\Application\UseCases;

use Acme\Application\Repositories\UserRepositoryInterface;
use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\Responses\GetUserResponseInterface;
use Acme\Application\UseCases\GetUserInteractor;
use Acme\Domain\Entities\User;
use Illuminate\Database\Connection;
use Tests\TestCase;

class GetUserInteractorTest extends TestCase
{
    public function testHandle()
    {
        $useCase = new GetUserInteractor(new class ($this->app->get(Connection::class)) implements UserRepositoryInterface {
            public function find(int $id): ?array
            {
                return [
                    'id' => $id,
                    'name' => 'name',
                    'email' => 'hoge@example.com',
                    'password' => 'password',
                ];
            }

            public function save(User $user): bool
            {
                throw new \RuntimeException();
            }
        });

        $response = $useCase->handle(new class implements GetUserRequestInterface {
            public function getIdentifier(): int
            {
                return 1;
            }
        });

        $this->assertInstanceOf(GetUserResponseInterface::class, $response);
        $this->assertEquals(1, $response->getUserId());
        $this->assertEquals('name', $response->getUserName());
        $this->assertEquals('hoge@example.com', $response->getMailAddress());
    }
}
