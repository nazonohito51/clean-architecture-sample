<?php
declare(strict_types=1);

namespace Acme\Application\UseCases;

use Acme\Application\Exceptions\SaveEntityException;
use Acme\Application\Repositories\UserRepositoryInterface;
use Acme\Application\Requests\CreateUserRequestInterface;
use Acme\Application\Requests\GetUserRequestInterface;
use Acme\Application\Responses\CreateUserResponse;
use Acme\Application\Responses\GetUserResponse;
use Acme\Application\Responses\GetUserResponseInterface;
use Acme\Domain\Entities\User;
use Acme\Domain\ValueObjects\Identifier;
use Acme\Domain\ValueObjects\MailAddress;
use Acme\Domain\ValueObjects\UserName;
use Acme\Domain\ValueObjects\UserPassword;

class CreateUserInteractor
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateUserRequestInterface $request): GetUserResponseInterface
    {
        $entity = new User(
            null,
            UserName::of($request->getUserName()),
            MailAddress::of($request->getMailAddress()),
            UserPassword::of($request->getPassword())
        );
        if (!$this->repository->save($entity)) {
            throw new SaveEntityException();
        }

        return new CreateUserResponse($entity);
    }
}
