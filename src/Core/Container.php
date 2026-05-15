<?php

namespace App\Core;

class Container
{
    private array $services = [];

    public function set(
        string $key,
        callable $resolver
    ): void {
        $this->services[$key] = $resolver;
    }

    public function get(string $key)
    {
        return $this->services[$key]($this);
    }
}
