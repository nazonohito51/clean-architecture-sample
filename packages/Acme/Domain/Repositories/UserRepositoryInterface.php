<?php
declare(strict_types=1);

namespace Acme\Domain\Repositories;

use Acme\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;

    public function save(User $user): bool;
}
