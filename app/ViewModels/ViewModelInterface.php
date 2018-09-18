<?php
declare(strict_types=1);

namespace App\ViewModels;

interface ViewModelInterface
{
    public function toArray(): array;
}
