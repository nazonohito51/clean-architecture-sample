<?php
declare(strict_types=1);

namespace Acme\Application\Requests;

interface GetUserRequestInterface
{
    public function getIdentifier(): int;
}
