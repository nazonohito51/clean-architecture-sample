<?php
declare(strict_types=1);

namespace App\Presenters\Http;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

class HtmlPresenter
{
    public function getUser(int $id, string $name, string $email)
    {
        return view('user', [
            'id' => $id,
            'name' => $name,
            'email' => $email,
        ]);
    }
}
