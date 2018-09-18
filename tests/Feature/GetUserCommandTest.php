<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GetUserCommandTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function testGetUser()
    {
        $id = $this->app->get(Connection::class)->table('users')->insertGetId([
            'name' => 'name',
            'email' => 'hoge@example.com',
            'password' => 'password'
        ]);

        $this->artisan('user:get', ['id' => $id])
            ->expectsOutput("id:{$id},name:name,email:hoge@example.com")
            ->assertExitCode(0);
    }
}
