<?php
declare(strict_types=1);

namespace Acme\Application\Repositories;

use Acme\Domain\Entities\User;
use Illuminate\Database\Connection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $db)
    {
        $this->connection = $db;
    }

    public function find(int $id): ?array
    {
        $user = $this->connection->selectOne('SELECT * FROM users WHERE id = ?', [$id]);

        return $user ? (array)$user : null;
    }

    public function save(User $user): bool
    {
        return $this->connection->insert('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [
            $user->getName(),
            $user->getMail(),
            $user->getPassword()
        ]);
    }
}
