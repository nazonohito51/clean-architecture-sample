<?php
declare(strict_types=1);

namespace Acme\Application\Repositories;

use Acme\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?array;

    public function save(User $user): bool;
}
