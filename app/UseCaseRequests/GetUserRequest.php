<?php
declare(strict_types=1);

namespace App\UseCaseRequests;

use Acme\Application\Requests\GetUserRequestInterface;

class GetUserRequest implements GetUserRequestInterface
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getIdentifier(): int
    {
        return $this->id;
    }
}
