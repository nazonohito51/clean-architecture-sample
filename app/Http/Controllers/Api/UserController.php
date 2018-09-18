<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Acme\Application\UseCases\GetUserInteractor;
use App\Http\Controllers\Controller;
use App\Presenters\HttpPresenter;
use App\UseCaseRequests\GetUserRequest;
use App\ViewModels\ViewModel;

class UserController extends Controller
{
    public function show(GetUserInteractor $useCase, HttpPresenter $presenter, $id)
    {
        $response = $useCase->handle(new GetUserRequest((int)$id));

        $viewModel = new ViewModel([
            'id' => $response->getUserId(),
            'name' => $response->getUserName(),
            'email' => $response->getMailAddress()
        ]);
        return $presenter->json($viewModel);
    }
}
