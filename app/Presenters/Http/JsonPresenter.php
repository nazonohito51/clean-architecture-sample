<?php
declare(strict_types=1);

namespace App\Presenters\Http;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

class JsonPresenter
{
    public function view(Arrayable $viewModel): JsonResponse
    {
        return response()->json($viewModel->toArray());
    }
}
