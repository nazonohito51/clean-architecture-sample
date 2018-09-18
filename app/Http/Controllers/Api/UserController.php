<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Acme\Application\Repositories\UserRepository;
use Acme\Application\UseCases\GetUserInteractor;
use App\Http\Controllers\Controller;
use App\UseCaseRequests\GetUserRequest;
use Illuminate\Database\Connection;

class UserController extends Controller
{
    public function show(Connection $connection, $id)
    {
        $useCase = new GetUserInteractor(new UserRepository($connection));

        $response = $useCase->handle(new GetUserRequest((int)$id));

        return response()->json([
            'id' => $response->getUserId(),
            'name' => $response->getUserName(),
            'email' => $response->getMailAddress()
        ]);
    }
}
