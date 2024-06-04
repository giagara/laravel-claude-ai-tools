<?php

namespace App\Interfaces;

interface ToolInterface
{
    public function name(): string;

    public function description(): string;

    public function inputs(): array;

    public function toJson(): array;

    public function run(...$arguments): void;

}