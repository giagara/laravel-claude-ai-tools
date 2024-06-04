<?php

namespace App\Tools;

use App\Interfaces\ToolInterface;

abstract class Tool implements ToolInterface
{
    protected string $name = "";
    
    protected string $description = "";
    
    protected array $inputs = [];

    protected array $required = [];

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function inputs(): array
    {
        return $this->inputs;
    }

    public function required(): array
    {
        return $this->required;
    }

    public function toJson(): array{
        return [
            'name' => $this->name(),
            'description' => $this->description(),
            'input_schema' => array_merge($this->inputs(), ["required" => $this->required()]),
        ];
    }
}