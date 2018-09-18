<?php
declare(strict_types=1);

namespace App\Presenters;

use App\ViewModels\ViewModelInterface;
use Illuminate\Http\JsonResponse;

class HttpPresenter
{
    public function json(ViewModelInterface $viewModel): JsonResponse
    {
        return response()->json($viewModel->toArray());
    }
}
