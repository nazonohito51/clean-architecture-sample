<?php
declare(strict_types=1);

namespace Acme\Application\UseCases;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Application\Repositories\UserRepository;
use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\Responses\GetUserResponseInterface;

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
        $user = $repository->find($request->getIdentifier());

        return new GetUserResponse($user);
    }
}
