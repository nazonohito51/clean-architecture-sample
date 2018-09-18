<?php
declare(strict_types=1);

namespace Acme\Application\Responses;

interface GetUserResponseInterface
{
    public function getUserId(): int;

    public function getUserName(): string;

    public function getMailAddress(): string;
}
