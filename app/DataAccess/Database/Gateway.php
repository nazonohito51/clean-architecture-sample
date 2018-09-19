<?php
declare(strict_types=1);

namespace App\DataAccess\Database;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Illuminate\Database\Connection;

class Gateway implements GatewayInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function select(string $query, array $bindings = []): array
    {
        $records = $this->connection->select($query, $bindings);

        return array_map(function ($record) {
            return (array)$record;
        }, $records);
    }

    public function insert(string $query, array $bindings): bool
    {
        return $this->connection->insert($query, $bindings);
    }
}
