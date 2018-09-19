<?php
declare(strict_types=1);

namespace Acme\Application\Repositories;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Domain\Entities\User;
use Acme\Domain\Repositories\UserRepositoryInterface;
use Acme\Domain\ValueObjects\Identifier;
use Acme\Domain\ValueObjects\MailAddress;
use Acme\Domain\ValueObjects\UserName;
use Acme\Domain\ValueObjects\UserPassword;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function find(int $id): ?User
    {
        $users = $this->gateway->select('SELECT * FROM users WHERE id = ?', [$id]);

        if (isset($users[0])) {
            return new User(
                Identifier::of($users[0]['id']),
                UserName::of($users[0]['name']),
                MailAddress::of($users[0]['email']),
                UserPassword::of($users[0]['password'])
            );
        } else {
            return null;
        }
    }

    public function save(User $user): bool
    {
        return $this->gateway->insert('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [
            $user->getName(),
            $user->getMail(),
            $user->getPassword()
        ]);
    }
}
