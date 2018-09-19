<?php
declare(strict_types=1);

namespace Tests\Unit\Acme\Application\UseCases;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Application\Requests\CreateUserRequestInterface;
use Acme\Application\Responses\CreateUserResponse;
use Acme\Application\UseCases\CreateUserInteractor;
use Tests\TestCase;

class CreateUserInteractorTest extends TestCase
{
    public function testHandle()
    {
        $gateway = new class implements GatewayInterface {
            public function select(string $query, array $bindings = []): array
            {
                throw new \RuntimeException();
            }

            public function insert(string $query, array $bindings): bool
            {
                return true;
            }
        };
        $request = new class implements CreateUserRequestInterface {
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
        };
        $useCase = new CreateUserInteractor($gateway);

        $response = $useCase->handle($request);

        $this->assertInstanceOf(CreateUserResponse::class, $response);
        $this->assertEquals('name', $response->getUserName());
        $this->assertEquals('hoge@example.com', $response->getMailAddress());
    }
}
