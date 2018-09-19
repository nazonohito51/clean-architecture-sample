<?php
declare(strict_types=1);

namespace Acme\Application\DataAccess\Database;

interface GatewayInterface
{
    public function select(string $query, array $bindings): array;

    public function insert(string $query, array $bindings): bool;
}
