<?php

namespace App\Interfaces;

interface PropertyInterface{

    public function name(): string;

    public function type(): string;

    public function description(): string;

    protected bool $required = true;


}