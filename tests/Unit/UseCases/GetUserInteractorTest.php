<?php
declare(strict_types=1);

namespace Tests\Unit\UseCases;

use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\UseCases\GetUserInteractor;
use Acme\Application\Repositories\UserRepository;
use Illuminate\Database\Connection;
use Tests\TestCase;

class GetUserInteractorTest extends TestCase
{
    public function testHandle()
    {
        $useCase = new GetUserInteractor(new class ($this->app->get(Connection::class)) extends UserRepository {
            public function find(int $id)
            {
                return [
                    'id' => $id,
                    'name' => 'name',
                    'email' => 'hoge@example.com',
                    'password' => 'password',
                ];
            }
        });

        $response = $useCase->handle(new class implements GetUserRequestInterface {
            public function getIdentifier(): int
            {
                return 1;
            }
        });

        $this->assertInstanceOf(GetUserResponse::class, $response);
        $this->assertEquals(1, $response->getUserId());
        $this->assertEquals('name', $response->getUserName());
        $this->assertEquals('hoge@example.com', $response->getMailAddress());
    }
}
