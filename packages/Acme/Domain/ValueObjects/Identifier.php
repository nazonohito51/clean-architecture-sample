<?php
declare(strict_types=1);

namespace Acme\Domain\ValueObjects;

class Identifier
{
    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function of($value): self
    {
        if ($value instanceof self) {
            return $value;
        }

        return new self((int)$value);
    }

    public function asInt()
    {
        return $this->value;
    }
}
