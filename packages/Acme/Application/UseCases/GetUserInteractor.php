<?php
declare(strict_types=1);

namespace Acme\Application\UseCases;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Application\Exceptions\EntityNotFoundException;
use Acme\Application\Repositories\UserRepository;
use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\Responses\GetUserResponseInterface;
use Illuminate\Database\Connection;

class GetUserInteractor
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function handle(GetUserRequestInterface $request): GetUserResponseInterface
    {
        $repository = new UserRepository($this->gateway);
        if (is_null($user = $repository->find($request->getIdentifier()))) {
            throw new EntityNotFoundException();
        }

        return new GetUserResponse($user);
    }
}
