<?php
declare(strict_types=1);

namespace App\Presenters;

use Illuminate\Console\OutputStyle;
use Illuminate\Contracts\Support\Arrayable;

class ConsolePresenter
{
    /**
     * @var OutputStyle
     */
    private $output;

    public function __construct(OutputStyle $output)
    {
        $this->output = $output;
    }

    public function info(Arrayable $viewModel)
    {
        if ($this->isVector($viewModel->toArray())) {
            $str = implode(',', $viewModel->toArray());
        } else {
            $str = implode(',', $this->toVector($viewModel->toArray()));
        }

        $this->output->writeln($str);
    }

    private function isVector(array $arr)
    {
        return array_values($arr) === $arr;
    }

    private function toVector(array $arr)
    {
        return array_map(function ($key, $value) {
            return "{$key}:$value";
        }, array_keys($arr), array_values($arr));
    }
}
