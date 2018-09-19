<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Acme\Application\UseCases\GetUserInteractor;
use App\Presenters\Http\HtmlPresenter;
use App\UseCaseRequests\GetUserRequest;
use App\ViewModels\ViewModel;

class UserController extends Controller
{
    public function show(GetUserInteractor $useCase, HtmlPresenter $presenter, $id)
    {
        $response = $useCase->handle(new GetUserRequest((int)$id));

        return $presenter->getUser($response->getUserId(), $response->getUserName(), $response->getMailAddress());
    }
}
