<?php

namespace App\Shared\ValueObject;

class Email implements \Stringable
{
    private readonly string $value;

    public function __construct(string $value)
    {
        $value = $this->normalize($value);
        $this->ensureEmailIsValid($value);

        $this->value = $value;
    }

    private function normalize(string $value): string
    {
        return trim($value);
    }

    private function ensureEmailIsValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('Value "%s" is not valid email', $value));
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
