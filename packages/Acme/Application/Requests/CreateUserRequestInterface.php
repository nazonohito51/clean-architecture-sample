<?php
declare(strict_types=1);

namespace Acme\Application\Requests;

interface CreateUserRequestInterface
{
    public function getUserName(): string;

    public function getMailAddress(): string;

    public function getPassword(): string;
}
