<?php
declare(strict_types=1);

namespace Acme\Application\UseCases;

use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\Responses\GetUserResponseInterface;
use Acme\Domain\Entities\User;
use Acme\Domain\ValueObjects\Identifier;
use Acme\Domain\ValueObjects\MailAddress;
use Acme\Domain\ValueObjects\UserName;
use Acme\Domain\ValueObjects\UserPassword;
use Acme\Application\Repositories\UserRepository;

class GetUserInteractor
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(GetUserRequestInterface $request): GetUserResponseInterface
    {
        $user = $this->repository->find($request->getIdentifier());

        return new GetUserResponse(new User(
            Identifier::of($user['id']),
            UserName::of($user['name']),
            MailAddress::of($user['email']),
            UserPassword::of($user['password']))
        );
    }
}
