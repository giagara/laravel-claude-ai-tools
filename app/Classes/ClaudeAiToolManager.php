<?php

namespace App\Classes;

use App\Tools\Tool;
use Illuminate\Support\Facades\Http;

class ClaudeAiToolManager{

    protected $tools = [];

    protected function client(){
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => config('claude3.apikey'),
            'anthropic-version' => '2023-06-01',
        ]);
    }

    public function addTool(string $tool){
        
        $instance = new $tool;

        if(! $instance instanceof Tool){
            throw new \Exception('Tool must be an instance of Tool');
        }   
        
        $this->tools[] = $instance;

        return $this;
    }

    public function run(array $messages){

        $response = $this->client()->post("https://api.anthropic.com/v1/messages", [
            'model' => 'claude-3-opus-20240229',
            'max_tokens' => 1024,
            'tools' => collect($this->tools)->map(fn(Tool $tool) => $tool->toJson())->toArray(),
            'messages' => $messages
        ])
        ->json();

        dump($response);

        if($response["type"] === "error"){
            dd("ERROR");
        }

        if($response['stop_reason'] === 'tool_use') {

            collect($response["content"])->filter(fn($item) => $item["type"] === "tool_use")->each(function($ai_tool){

                $tool_instance_to_be_used = collect($this->tools)->first(fn(Tool $tool) => $tool->name() === $ai_tool['name']);

                $tool_instance_to_be_used->run(...array_values($ai_tool["input"]));

            });


        }else{
            dd("no stop reason");
        }
    }
}