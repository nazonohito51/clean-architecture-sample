<?php
declare(strict_types=1);

namespace Tests\Unit\Acme\Application\Repository;

use Acme\Application\Repositories\UserRepository;
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
        $repository = new UserRepository($this->app->get(Connection::class));

        $user = $repository->find($id);

        $this->assertNotNull($user);
        $this->assertArraySubset([
            'name' => 'name',
            'email' => 'hoge@example.com',
            'password' => 'password'
        ], $user);
    }

    public function testFind_WhenRecordNotFound()
    {
        $repository = new UserRepository($this->app->get(Connection::class));

        $user = $repository->find(1);

        $this->assertNull($user);
    }
}
