<?php
declare(strict_types=1);

namespace Acme\Application\Repositories;

interface UserRepositoryInterface
{
    public function find(int $id);
}
