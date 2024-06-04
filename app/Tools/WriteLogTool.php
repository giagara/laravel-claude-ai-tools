<?php

namespace App\Tools;

use App\Interfaces\ToolInterface;
use Illuminate\Support\Facades\Log;

class WriteLogTool extends Tool{

    protected string $name = "write-log";
    
    protected string $description = "Writes log to the log files";
    
    protected array $inputs = [
        "type" => "object",
        "properties" => [
            "username" => [
                "type" => "string",
                "description" => "Username of the user to be logged",
            ],
            "score" => [
                "type" => "integer",
                "description" => "The score of the user",
            ]
        ]
    ];

    protected array $required = ["username"];


    public function run(...$arguments): void
    {
        $username = $arguments[0];
        $score = $arguments[1];

        Log::info("the username is: " . $username . " and the score is: " . $score);
    }
}