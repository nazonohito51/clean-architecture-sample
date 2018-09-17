<?php
namespace Acme\Application\Requests;

interface GetUserRequestInterface
{
    public function getIdentifier(): int;
}
