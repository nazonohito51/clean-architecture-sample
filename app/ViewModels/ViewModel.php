<?php
declare(strict_types=1);

namespace App\ViewModels;

use Illuminate\Contracts\Support\Arrayable;

class ViewModel implements Arrayable
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
