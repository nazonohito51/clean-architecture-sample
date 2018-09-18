<?php
declare(strict_types=1);

namespace Acme\Application\Repositories;

use Illuminate\Database\Connection;

class UserRepository
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $db)
    {
        $this->connection = $db;
    }

    public function find(int $id)
    {
        $user = $this->connection->selectOne('SELECT * FROM users WHERE id = ?', [$id]);

        return $user ? (array)$user : null;
    }
}
