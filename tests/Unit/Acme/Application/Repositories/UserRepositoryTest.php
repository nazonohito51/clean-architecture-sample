<?php
declare(strict_types=1);

namespace Tests\Unit\Acme\Application\Repository;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Application\Repositories\UserRepository;
use Acme\Domain\Entities\User;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testFind()
    {
        $id = $this->app->get(Connection::class)->table('users')->insertGetId([
            'name' => 'name',
            'email' => 'hoge@example.com',
            'password' => 'password'
        ]);
        $repository = new UserRepository($this->app->get(GatewayInterface::class));

        $user = $repository->find($id);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($id, $user->getId()->asInt());
        $this->assertEquals('name', $user->getName()->asString());
        $this->assertEquals('hoge@example.com', $user->getMail()->asString());
        $this->assertEquals('password', $user->getPassword()->asString());
    }

    public function testFind_WhenRecordNotFound()
    {
        $repository = new UserRepository($this->app->get(GatewayInterface::class));

        $user = $repository->find(1);

        $this->assertNull($user);
    }
}
