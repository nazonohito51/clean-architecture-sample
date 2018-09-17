<?php
declare(strict_types=1);

namespace Tests;

use Tests\Seeder\TestSeeder;

/**
 * @method artisan(string $command, array $parameters = []):int
 * @method seed(string $class = 'DatabaseSeeder')
 */
trait SetupDatabase
{
    protected static $databaseSetup = false;

    protected function setUpDatabase()
    {
        if (static::$databaseSetup) {
            return;
        }

        $this->artisan('migrate');
        $this->seed(TestSeeder::class);

        $seeder = __CLASS__ . 'Seeder';
        if (class_exists($seeder)) {
            $this->seed($seeder);
        }

//        static::$databaseSetup = true;
    }
}
