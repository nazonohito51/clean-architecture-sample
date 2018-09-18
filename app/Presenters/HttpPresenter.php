<?php
declare(strict_types=1);

namespace App\Presenters;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

class HttpPresenter
{
    public function json(Arrayable $viewModel): JsonResponse
    {
        return response()->json($viewModel->toArray());
    }
}
