<?php

namespace App\Interfaces;

interface InputInterface{

    public function name(): string;

    public function type(): string;

    public function properties(): array;

    public function required(): bool;

}