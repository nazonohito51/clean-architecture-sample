<?php
declare(strict_types=1);

namespace Acme\Domain\ValueObjects;

class UserName
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function of($value): self
    {
        if ($value instanceof self) {
            return $value;
        }

        return new self($value);
    }

    public function asString()
    {
        return $this->value;
    }
}
